<?php
class MyMovieHelper
{
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
	
	private function getImage($original, $newFileName)
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