<?php
class AutoRipperHelper
{
	static public function generateNzbs($id)
	{
		$modelAutoRipper = AutoRipper::model()->findByPk($id);
		if(isset($modelAutoRipper))
		{
			$autoRipperFiles = AutoRipperFile::model()->findAllByAttributes(array('Id_auto_ripper'=>$id));
			$isFirst = true;
			$idNzbParent = null;
			foreach($autoRipperFiles as $autoRipperFile)
			{
				$fileName = $autoRipperFile->name . '.nzb';
				
				$modelNzb = new Nzb();
				
				$modelNzb->Id_resource_type = 1; //por defecto es BLURAY						
				$modelNzb->Id_nzb_type = 5; //por defecto todos son NO ENVIAR
				$modelNzb->Id_creation_state = 1; //por defecto va a BORRADOR
				$modelNzb->Id_auto_ripper_file = $autoRipperFile->Id;
				
				$modelNzb->file_name =  $fileName;
				$modelNzb->file_original_name =  $fileName;
				$modelNzb->url = '/nzb/'.$fileName;
				
				if($isFirst)
				{
					$isFirst = false;
					$modelNzb->save();
					$idNzbParent = $modelNzb->Id;
				}
				else 
				{
					$modelNzb->Id_nzb = $idNzbParent;
					$modelNzb->save();
				}
			}					
			
			$modelAutoRipper->Id_nzb = $idNzbParent;
			$modelAutoRipper->save();
		}
	}
	
	static public function findVideoInfo($id)
	{
		$modelAutoRipper = AutoRipper::model()->findByPk($id);
		if(isset($modelAutoRipper) && isset($modelAutoRipper->Id_nzb))
		{
			$modelNzb = Nzb::model()->findByPk($modelAutoRipper->Id_nzb);
			if(isset($modelNzb))
			{
				$db = TMDBApi::getInstance();
				$db->adult = true;  // return adult content
				$db->paged = false; // merges all paged results into a single result automatically
				$results = $db->search('movie', array('query'=>$modelAutoRipper->name));
				$idMovie = null;
				
				foreach($results as $item)
				{
					$idMovie = $item->id;
					break;
				}
				
				if(isset($idMovie))
				{
					$transaction=Yii::app()->db->beginTransaction();
					try
					{
						$movie = new TMDBMovie($idMovie);
						$persons = $movie->casts();
						$poster = $movie->poster('342');
						$bigPoster = $movie->poster('500');
						$backdrop = $movie->backdrop('original');
						
						var_dump(TMDBHelper::downloadAndLinkImages($movie->id,$modelNzb->Id,$poster,$bigPoster,$backdrop));
						
						$myMovieNzb = new MyMovieNzb();
						
						$myMovieNzb->Id = uniqid ("cust_");
						$myMovieNzb->Id_parental_control = 1; //UNRATED
						$myMovieNzb->original_title = $movie->original_title;
						$myMovieNzb->adult = $movie->adult?1:0;
						$myMovieNzb->release_date = $movie->release_date;
						$date = date_parse($movie->release_date);
						$myMovieNzb->production_year = $date['year'];
						$myMovieNzb->running_time = $movie->runtime;
						$myMovieNzb->description = $movie->overview;
						$myMovieNzb->local_title = $movie->title;
						$myMovieNzb->sort_title= $movie->title;
						$myMovieNzb->imdb= $movie->imdb_id;
						$myMovieNzb->rating= (int)$movie->vote_average;
						
						$myMovieNzb->poster_original = $poster;
						$myMovieNzb->big_poster_original = $bigPoster;
						$myMovieNzb->backdrop_original = $backdrop;
						
						$genres = $movie->genres;
						$myMovieNzb->genre="";
						$first = true;
						foreach($genres as $genre)
						{
							if($first)
							{
								$first = false;
								$myMovieNzb->genre = $genre->name;
							}
							else
							{
								$myMovieNzb->genre = $myMovieNzb->genre.", ".$genre->name;
							}
						}
						
						$companies = $movie->production_companies;
						$myMovieNzb->studio = "";
						$first = true;
						foreach($companies as $companie)
						{
							if($first)
							{
								$first = false;
								$myMovieNzb->studio = $companie->name;
							}
							else
							{
								$myMovieNzb->studio = $myMovieNzb->studio.", ".$companie->name;
							}
						}
						
						if($myMovieNzb->save())
						{
							$casts =isset($persons['cast'])?$persons['cast']:array();
						
							$relations = MyMovieNzbPerson::model()->findAllByAttributes(array('Id_my_movie_nzb'=>$myMovieNzb->Id));
							$personsToDelete = array();
							foreach ($relations as $relation)
							{
								$personsToDelete[] = $relation->person;
							}
							MyMovieNzbPerson::model()->deleteAllByAttributes(array('Id_my_movie_nzb'=>$myMovieNzb->Id));
							foreach ($personsToDelete as $toDelete)
							{
								$toDelete->delete();
							}
							foreach($casts as $cast)
							{
								$person = new Person();
								$person->name= $cast->name;
								$person->type = "Actor";
								$person->role = $cast->character;
								$person->photo_original = $cast->profile();
								if($person->save())
								{
									$myMoviePerson = new MyMovieNzbPerson();
									$myMoviePerson->Id_my_movie_nzb = $myMovieNzb->Id;
									$myMoviePerson->Id_person = $person->Id;
									$myMoviePerson->save();
								}
							}
							$crews =isset($persons['crew'])?$persons['crew']:array();
							foreach($crews as $crew)
							{
								$person = new Person();
								$person->name= $crew->name;
								$person->type = $crew->job;
								$person->photo_original = $crew->profile();
								if($person->save())
								{
									$myMoviePerson =  new MyMovieNzbPerson();
									$myMoviePerson->Id_my_movie_nzb = $myMovieNzb->Id;
									$myMoviePerson->Id_person = $person->Id;
									$myMoviePerson->save();
								}
							}
							
							$myMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($modelAutoRipper->Id_disc);
							if(!isset($myMovieDiscNzb))
							{
								$myMovieDiscNzb = new MyMovieDiscNzb();
								$myMovieDiscNzb->Id = $modelAutoRipper->Id_disc;
							}
							$myMovieDiscNzb->name = $modelAutoRipper->name;
							$myMovieDiscNzb->Id_my_movie_nzb = $myMovieNzb->Id;
						
							if($myMovieDiscNzb->save())
							{
								$nzb = Nzb::model()->findByPk($modelNzb->Id);
								$nzb->Id_my_movie_disc_nzb = $myMovieDiscNzb->Id;
								$nzb->save();
								$transaction->commit();
							}
						}
					}
					catch (Exception $e) {
						$transaction->rollBack();
						var_dump($e);
					}
					
				}
			}
		}
	}
	
}