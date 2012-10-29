<?php
class MyMovieHelper
{
	static public function createDisc($idMyMovieNzb)
	{
		if(!empty($idMyMovieNzb))
		{	
			$model = new MyMovieDiscNzb();
			$model->Id_my_movie_nzb = $idMyMovieNzb;
			$model->Id = uniqid();
			if($model->save())
				return $model->Id; 
		}
		
		return null;	
	}
	
	/*
	* Si encuentra algo en la api con ese con parametros de entrada, 
	* devuelve el modelo
	* season, sino devuelve null
	*/
	static public function searchEpisode($idSerie, $seasonNumber, $episodeNumber, $country)
	{
	
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->LoadEpisodeBySeriesID($idSerie, $seasonNumber, $episodeNumber, $country);
	
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			if(!empty($response->Episode))
				$data = $response->Episode;
			else
				return null;
			
			$description = (string)$data['Description'];
			$name = (string)$data['EpisodeName'];
			
			$modelMyMovieEpisode = new MyMovieEpisode;
			$modelMyMovieEpisode->description = (!empty($description)) ? $description :(string)$data->EnglishPart['Description'];
			$modelMyMovieEpisode->name = (!empty($name)) ? $name : (string)$data->EnglishPart['Name'];
			$modelMyMovieEpisode->episode_number = (string)$data['EpisodeNumber'];
			return $modelMyMovieEpisode;
		}
		return null;
	}
	
	/*
	* Si encuentra algo en la api con ese id de serie y ese numero de
	* temporada, devuelve el modelo
	* season, sino devuelve null
	*/
	static public function searchSeasonBanner($id, $seasonNumber)
	{
	
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->LoadSeasonBanners($id, $seasonNumber);
	
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			if(!empty($response->Banners))
				$data = $response->Banners;
			else
				return null;
			
			foreach($data->children() as $item)
			{
				if((string)$item['Number'] == "1")
				{
					$modelMyMovieSeason = new MyMovieSeason;
					$modelMyMovieSeason->Id_my_movie_serie_header =  $id;
					$modelMyMovieSeason->season_number = (string)$item['SeasonNumber'];
			
					//banner
					$modelMyMovieSeason->banner_original = (string)$item['File'];
					return $modelMyMovieSeason;
				}
			}
		}
		return null;
	}
	
	/*
	 * Si encuentra algo en la api con ese titulo y es serie, devuelve el modelo
	 * serie header, sino devuelve null
	 */
	static public function searchSerieByTitle($title, $country)
	{
	
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->LoadDiscTitleByTitle($title, $country);
	 
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			
			if(!empty($response->Title))
				$data = $response->Title;
			else
				return null;
			
			$idSerie = !empty($data->TVSeriesID)?(string)$data->TVSeriesID:'';
			
			if(!empty($idSerie))
			{
				return self::getSerie($idSerie, $country);
		
			}
		}
		return null;
	}
	
	/*
	* Si encuentra algo en la api con ese idImdb y es serie, devuelve el modelo
	* serie header, sino devuelve null
	*/
	static public function searchSerieByIMDBId($idImdb, $country)
	{
	
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->LoadDiscTitleByIMDBId($idImdb, $country);
	
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
				
			if(!empty($response->Title))
				$data = $response->Title;
			else
				return null;
				
			$idSerie = !empty($data->TVSeriesID)?(string)$data->TVSeriesID:'';
				
			if(!empty($idSerie))
			{
				return self::getSerie($idSerie, $country);
			}
		}
		return null;
	}
	
	static public function searchTitles($title, $country)
	{
		$titlesResponse = array();
		
		$myMoviesAPI = new MyMoviesAPI();			
		$response = $myMoviesAPI->SearchDiscTitleByTitle($title, $country);
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			$titles = $response->Titles;
				
			foreach($titles->children() as $title)
			{
				$model = new SearchDiscResponse();
				$model->setAttributes($title);
				$titlesResponse[] = $model;
			}
		}
		return $titlesResponse;
	}
	
	/*
	 * Save and return my_movie_disc_nzb id
	 */
	static public function saveMyMovieData($idTitle)
	{
		$modelMyMovieNzb = self::getMyMovieData($idTitle);
		if(isset($modelMyMovieNzb))
		{
			$modelMyMovieNzb->save();
			$modelMyMovieDiscNzb = new MyMovieDiscNzb();
			$modelMyMovieDiscNzb->Id = uniqid();
			$modelMyMovieDiscNzb->name = $modelMyMovieNzb->local_title; 
			$modelMyMovieDiscNzb->Id_my_movie_nzb = $idTitle;
			if($modelMyMovieDiscNzb->save())
				return $modelMyMovieDiscNzb->Id; 
		}
		
		return null;
	}
	
	
	static function getMyMovieData($idTitle, $saveImage=true)
	{	
		if(!empty($idTitle))
		{	
			$modelMyMovieNzbDB = MyMovieNzb::model()->findByPk($idTitle);
			
			if(!isset($modelMyMovieNzbDB))
			{
				try {
					
					$myMoviesAPI = new MyMoviesAPI();
					
					$response = $myMoviesAPI->LoadDiscTitleById($idTitle);
					if(!empty($response) && (string)$response['status'] == 'ok')
					{
						if(!empty($response->Title))
							$data = $response->Title;
						else
							return null;
						
						$modelMyMovieNzb = new MyMovieNzb();
							
						$modelMyMovieNzb->Id = $idTitle;
						$modelMyMovieNzb->type = (string)$data->Type;
						$modelMyMovieNzb->media_type = (string)$data->MediaType;
						$modelMyMovieNzb->bar_code = (string)$data->Barcode;
						$modelMyMovieNzb->country = (string)$data->Country;						
						$modelMyMovieNzb->local_title = (string)$data->LocalTitle;
						$modelMyMovieNzb->original_title = (string)$data->OriginalTitle;
						$modelMyMovieNzb->sort_title = (string)$data->SortTitle;						
						$modelMyMovieNzb->aspect_ratio = (string)$data->AspectRatio;
						$modelMyMovieNzb->video_standard = (string)$data->VideoStandard;
						$modelMyMovieNzb->production_year = (string)$data->ProductionYear;
						$modelMyMovieNzb->release_date = (string)$data->ReleaseDate;
						$modelMyMovieNzb->running_time = (string)$data->RunningTime;
						$modelMyMovieNzb->description = (string)$data->Description;
						$modelMyMovieNzb->extra_features = (string)$data->ExtraFeatures;
						$modelMyMovieNzb->imdb = (string)$data->IMDB;
						$modelMyMovieNzb->rating = (string)$data->Rating;
						$modelMyMovieNzb->data_changed = (string)$data->DataChanged;
						$modelMyMovieNzb->covers_changed = (string)$data->CoversChanged;
							
						$modelMyMovieNzb->parental_rating_desc = (!empty($data->ParentalRating)?(string)$data->ParentalRating->Description:"");
							
						$modelMyMovieNzb->Id_parental_control = self::getParentalControlId($data);
							
						$modelMyMovieNzb->adult = self::getAdult($data);
							
						//Obtengo la lista de los generos
						$modelMyMovieNzb->genre = implode(", ",self::xmlToArray($data->Genres));
							
						//Obtengo la lista de los estudios
						$modelMyMovieNzb->studio =  implode(", ",self::xmlToArray($data->Studios));
							
						//Poster
						$modelMyMovieNzb->poster_original = self::getPoster($data->MovieData);
						
						//Backdrop
						$modelMyMovieNzb->backdrop_original = self::getBackdrop($data->MovieData);
						
						if($saveImage)
						{
							$modelMyMovieNzb->poster = self::getImage($modelMyMovieNzb->poster_original, $modelMyMovieNzb->Id);
							$modelMyMovieNzb->backdrop = self::getImage($modelMyMovieNzb->backdrop_original, $modelMyMovieNzb->Id . '_bd');
						}
						
						return $modelMyMovieNzb;
					}
					
				} catch (Exception $e) {
					return null;
				}
			}
			return $modelMyMovieNzbDB;
		}
		return null;
			
	}

	private function getSerie($idSerie, $country)
	{
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->LoadSeries($idSerie, $country);
		
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			if(!empty($response->Serie))
				$data = $response->Serie;
			else
				return null;
		
			$description = (string)$data['Description'];
			$name = (string)$data['EpisodeName'];
		
			$modelMyMovieSerieHeader = new MyMovieSerieHeader();
			$modelMyMovieSerieHeader->Id = (string)$data['Id'];
			$modelMyMovieSerieHeader->original_network = (string)$data['OriginalNetwork'];
			$modelMyMovieSerieHeader->original_status = (string)$data['OriginalStatus'];
			$modelMyMovieSerieHeader->rating = (string)$data['Rating'];
			$modelMyMovieSerieHeader->description = (!empty($description)) ? $description :(string)$data->EnglishPart['Description'];
			$modelMyMovieSerieHeader->name = (!empty($name)) ? $name : (string)$data->EnglishPart['Name'];
			$modelMyMovieSerieHeader->sort_name = (string)$data->EnglishPart['SortName'];
			$modelMyMovieSerieHeader->genre = self::getSerieGenre($data);
		
			//Poster
			$modelMyMovieSerieHeader->poster_original = self::getPoster($data);
		
			return $modelMyMovieSerieHeader;
		}
		
		return null;
	}
	
	/*
	* Obtiene la lista de generos de la serie
	* @param xml $xml es la estructura que devuelve la API de MyMovies (LoadSeries->Serie)
	*/
	private function getSerieGenre($xml)
	{
		if(!empty($xml->Genres))
		{
			$xmlArr = array();
			$index = 0;
			foreach($xml->Genres->children() as $item)
			{
				$xmlArr[$index] = (string)$item['Name'];
				$index ++;
			}
			if(count($xmlArr) > 0 )
			return implode(',',$xmlArr);
		}
		return "";
	}
	
	private function getParentalControlId($xml)
	{
		if(!empty($xml->ParentalRating))
		{
			$model = ParentalControl::model()->findByAttributes(array('value'=>$xml->ParentalRating->Value));
				
			if(isset($model))
			{
				return $model->Id;
			}
	
		}
		return 1;
	}
	
	private function getAdult($xml)
	{
		if(!empty($xml->ParentalRating))
		{
			if($xml->ParentalRating['Adult'] == 'True')
				return 1;
		}
		return 0;
	}
	
	private function getPoster($xml)
	{
		if(!empty($xml->Posters))
		{
			foreach($xml->Posters->children() as $item)
			{
				return (string)$item['File'];
			}
	
		}
		return "";
	}
	
	private function getBackdrop($xml)
	{
		if(!empty($xml->Backdrops))
		{
			foreach($xml->Backdrops->children() as $item)
			{
				return (string)$item['File720P'];
			}
	
		}
		return "";
	}
	
	private function xmlToArray($xml)
	{
		$xmlArr = array();
		$index = 0;
		foreach($xml->children() as $item)
		{
			$xmlArr[$index] = (string)$item;
			$index ++;
		}
		return $xmlArr;
	}
	
	static public function getImage($original, $newFileName)
	{
		$validator = new CUrlValidator();
		$imagesPath = './images';
		
		$name = 'no_poster.jpg';
		if($original!='' && $validator->validateValue($original))
		{
			try {
				$content = @file_get_contents($original);
				if ($content !== false) {
					$file = fopen($imagesPath."/".$newFileName.".jpg", 'w');
					fwrite($file,$content);
					fclose($file);
					$name = $newFileName.".jpg";
				} else {
					// an error happened
				}
			} catch (Exception $e) {
				throw $e;
				// an error happened
			}
		}
		
		return $name;
		
	}
	
	private function saveAudioTrack($xml)
	{
	
		$idMyMovie = (string)$xml->ID;
	
		foreach($xml->AudioTracks->children() as $item)
		{
			$language = (string)$item['Language'];
			$type = (string)$item['Type'];
			$chanels = (string)$item['Channels'];
				
			$modelAudioTrackDB = AudioTrack::model()->findByAttributes(array(
														'language'=>$language,
														'type'=>$type,
														'chanel'=>$chanels,));
				
			$modelMyMovieAudioTrack = new MyMovieAudioTrack();
			$modelMyMovieAudioTrack->Id_my_movie = $idMyMovie;
				
			if(isset($modelAudioTrackDB))
			{
				$modelMyMovieAudioTrack->Id_audio_track = $modelAudioTrackDB->Id;
			}
			else
			{
				$modelAudioTrack = new AudioTrack();
				$modelAudioTrack->language = $language;
				$modelAudioTrack->type = $type;
				$modelAudioTrack->chanel = $chanels;
				$modelAudioTrack->save();
	
				$modelMyMovieAudioTrack->Id_audio_track = $modelAudioTrack->Id;
			}
				
			$model = MyMovieAudioTrack::model()->findByAttributes(array(
														'Id_my_movie'=>$idMyMovie, 
														'Id_audio_track'=>$modelMyMovieAudioTrack->Id_audio_track));
			if(!isset($model))
			$modelMyMovieAudioTrack->save();
	
		}
	}
	
	private function saveSubtitle($xml)
	{
	
		$idMyMovie = (string)$xml->ID;
	
		foreach($xml->Subtitles->children() as $item)
		{
			$language = (string)$item['Language'];
	
			$modelSubtitleDB = Subtitle::model()->findByAttributes(array(
															'language'=>$language,
			));
	
			$modelMyMovieSubtitle = new MyMovieSubtitle();
			$modelMyMovieSubtitle->Id_my_movie = $idMyMovie;
	
			if(isset($modelSubtitleDB))
			{
				$modelMyMovieSubtitle->Id_subtitle = $modelSubtitleDB->Id;
			}
			else
			{
				$modelSubtitle = new Subtitle();
				$modelSubtitle->language = $language;
				$modelSubtitle->save();
	
				$modelMyMovieSubtitle->Id_subtitle = $modelSubtitle->Id;
			}
	
			$model = MyMovieSubtitle::model()->findByAttributes(array(
															'Id_my_movie'=>$idMyMovie, 
															'Id_subtitle'=>$modelMyMovieSubtitle->Id_subtitle));
			if(!isset($model))
			$modelMyMovieSubtitle->save();
	
		}
	}
}