<?php

class NzbController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
					'classMap'=>array(
			                    'NzbResponse'=>'NzbResponse',  // or simply 'Post'	
								'NzbStateRequest'=>'NzbStateRequest',
								'TransactionResponse'=>'TransactionResponse',
								'RippedRequest'=>'RippedRequest',
								'RippedResponse'=>'RippedResponse',
								'LogRequest'=>'LogRequest',
								'LogResponse'=>'LogResponse',
		),
		),
		);
	}
	
	
	/**
	* Get ripped by customer (feedback to client)
	* @param string idDevice
	* @return RippedResponse[]
	* @soap
	*/
	public function getRipped($idDevice)
	{
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.Id_device = "'. $idDevice.'"');
	
		$arrayRipped = RippedCustomer::model()->findAll($criteria);
		$arrayResponse = array();
	
		foreach ($arrayRipped as $model)
		{
			$rippedResponse = new RippedResponse();
			$rippedResponse->Id_my_movie_disc = $model->Id_my_movie_disc;
			$rippedResponse->Id_device = $model->Id_device;
			$arrayResponse[]=$rippedResponse;
		}
	
		return $arrayResponse;
	}
	
	/**
	 * Returns new and updated nzbs
	 * @param string Id_device
	 * @return NzbResponse[]
	 * @soap
	 */
	public function getNewNzbs($Id_device)
	{
				
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_device where Id_device = "'. $Id_device.'" and need_update = 0)');
		$criteria->addCondition('t.is_draft = 0');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();
		 
		foreach ($arrayNbz as $modelNbz)
		{
			$nzbResponse = new NzbResponse();
			$nzbResponse->nzb->setAttributes($modelNbz);
			$nzbResponse->myMovieDisc->setAttributes($modelNbz->myMovieDiscNzb);
			$nzbResponse->myMovie->setAttributes($modelNbz->myMovieDiscNzb->myMovieNzb);
			$nzbResponse->myMovie->myMovieSerieHeader = self::getSerie($modelNbz->myMovieDiscNzb);

			//set audio track
			$relAudioTracks = MyMovieNzbAudioTrack::model()->findAllByAttributes(array('Id_my_movie_nzb'=>$modelNbz->myMovieDiscNzb->Id_my_movie_nzb));
			foreach($relAudioTracks as $relAudioTrack)
			{
				$audioTrackSOAP = new MyMovieAudioTrackSOAP();
				$audioTrackSOAP->setAttributes($relAudioTrack->audioTrack);
				$nzbResponse->myMovie->AudioTrack[] = $audioTrackSOAP;
			}
			
			//set subtitle
			$relSubtitles = MyMovieNzbSubtitle::model()->findAllByAttributes(array('Id_my_movie_nzb'=>$modelNbz->myMovieDiscNzb->Id_my_movie_nzb));
			foreach($relSubtitles as $relSubtitle)
			{
				$subtitleSOAP = new MyMovieSubtitleSOAP();
				$subtitleSOAP->setAttributes($relSubtitle->subtitle);
				$nzbResponse->myMovie->Subtitle[] = $subtitleSOAP;
			}
			
			//set subtitle
			$relPersons = MyMovieNzbPerson::model()->findAllByAttributes(array('Id_my_movie_nzb'=>$modelNbz->myMovieDiscNzb->Id_my_movie_nzb));
			foreach($relPersons as $relPerson)
			{
				$personSOAP = new MyMoviePersonSOAP();
				$personSOAP->setAttributes($relPerson->person);
				$nzbResponse->myMovie->Person[] = $personSOAP;
			}
			
			$arrayResponse[]=$nzbResponse;
				
			$nzbDeviceDB = NzbDevice::model()->findByAttributes(array('Id_nzb'=>$modelNbz->Id, 'Id_device'=>$Id_device));
			if($nzbDeviceDB != null)
			{
				$nzbDeviceDB->need_update = 1;
				$nzbDeviceDB->save();
			}
			else
			{
				$modelNzbDevice = new NzbDevice();

				$modelNzbDevice->attributes = array(
												'Id_nzb'=>$modelNbz->Id,
												'Id_device'=>$Id_device,
												'need_update'=> 1,
				);
				$modelNzbDevice->save();
			}
		}

		return $arrayResponse;
	}

	private function getSerie($modelMyMovieDiscNzb)
	{
		if(isset($modelMyMovieDiscNzb->myMovieNzb->myMovieSerieHeader))
		{
			$modelSerieHeader = new MyMovieSerieHeaderSOAP();
			$modelSerieHeader->setAttributes($modelMyMovieDiscNzb->myMovieNzb->myMovieSerieHeader);
				
			$discEpisodesNzb = MyMovieDiscNzbMyMovieEpisode::model()->findAllByAttributes(array('Id_my_movie_disc_nzb'=>$modelMyMovieDiscNzb->Id));
			$setSeason = true;
			foreach($discEpisodesNzb as $item)
			{
				if($setSeason)
				{
					$modelSeason = MyMovieSeason::model()->findByPk($item->myMovieEpisode->Id_my_movie_season);
					$modelSerieHeader->myMovieSeason->setAttributes($modelSeason);
					$setSeason = false;
				}
	
				$episodeSOAP = new MyMovieEpisodeSOAP();
				$episodeSOAP->setAttributes($item->myMovieEpisode);
				$modelSerieHeader->myMovieSeason->Episode[] = $episodeSOAP;
			}
				
			return $modelSerieHeader;
		}
	
		return null;
	}
	
	/**
	*
	* Sincronize log from customer (from client to server)
	* @param LogRequest[]
	* @return LogResponse[]
	* @soap
	*/
	public function setLog($logRequest )
	{
		$arrayResponse = array();
		try {
			foreach($logRequest as $item)
			{
				$model = new Log();
				$model->description = $item->description;
				$model->username = $item->username;
				$model->log_date = $item->log_date;
				$model->Id_log_type = $item->Id_log_type;
				$model->Id_customer = $item->Id_customer;
				$model->Id_log_customer = $item->Id_log_customer;
				if($model->save())
				{
					$logResponse = new LogResponse();
					$logResponse->Id_log_customer = $item->Id_log_customer;
					$arrayResponse[]=$logResponse;
				}
				
			}
		} catch (Exception $e) {
		}
		return $arrayResponse;
	}
	
	/**
	*
	* Sincronize ripped videos from customer (from client to server)
	* @param RippedRequest[]
	* @return boolean
	* @soap
	*/
	public function setRipped($rippedRequest )
	{
		try {			
			foreach($rippedRequest as $item)
			{

				$idSeason = null;
				
				//si es serie guardo la serie y la temporada
				if(isset($item->myMovie->myMovieSerieHeader))
				{
					//grabo serie
					$modelMyMovieSerieHeaderDB = MyMovieSerieHeader::model()->findByPk($item->myMovie->myMovieSerieHeader->Id);
					if(!isset($modelMyMovieSerieHeaderDB))
					{
						$modelMyMovieSerieHeader = new MyMovieSerieHeader();
						$modelMyMovieSerieHeader->setAttributesByArray($item->myMovie->myMovieSerieHeader);
						$modelMyMovieSerieHeader->poster = MyMovieHelper::getImage($modelMyMovieSerieHeader->poster_original, $modelMyMovieSerieHeader->Id);
						$modelMyMovieSerieHeader->save();
					}
					
					//grabo temporada
					$modelMyMovieSeasonDB = MyMovieSeason::model()->findByAttributes(array(
										'Id_my_movie_serie_header'=>$item->myMovie->myMovieSerieHeader->Id,
										'season_number'=>$item->myMovie->myMovieSerieHeader->myMovieSeason->season_number,
										));
						
					if(!isset($modelMyMovieSeasonDB))
					{
						$modelMyMovieSeason = new MyMovieSeason();
						$modelMyMovieSeason->setAttributesByArray($item->myMovie->myMovieSerieHeader->myMovieSeason);
						$modelMyMovieSeason->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
						$newFileName = $modelMyMovieSeason->Id_my_movie_serie_header .'_'.$modelMyMovieSeason->season_number;
						$modelMyMovieSeason->banner = MyMovieHelper::getImage($modelMyMovieSeason->banner_original, $newFileName);
						$modelMyMovieSeason->save();
						$idSeason = $modelMyMovieSeason->Id; 
					}
					else
						$idSeason = $modelMyMovieSeasonDB->Id;
					
				}
				
				//grabo la info de la caja (my movie)
				$modelMyMovieDB = MyMovie::model()->findByPk($item->myMovie->Id);		
				if(!isset($modelMyMovieDB))
				{
					$modelMyMovie = new MyMovie();
					$modelMyMovie->setAttributesByArray($item->myMovie);
					$modelMyMovie->poster = MyMovieHelper::getImage($modelMyMovie->poster_original, $modelMyMovie->Id);
					$modelMyMovie->backdrop = MyMovieHelper::getImage($modelMyMovie->backdrop_original, $modelMyMovie->Id . '_bd');
					$modelMyMovie->save();
				}
				
				//grabo el disco
				$idDisc = null;
				$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($item->myMovieDisc->Id);
				if(!isset($modelMyMovieDiscDB))
				{
					$modelMyMovieDisc = new MyMovieDisc();
					$modelMyMovieDisc->setAttributesByArray($item->myMovieDisc);
					$modelMyMovieDisc->save();
					$idDisc = $modelMyMovieDisc->Id;
				}
				else
					$idDisc = $modelMyMovieDiscDB->Id;
			
				//si es serie genero relacion con los episodios y el disco
				//y grabo el id de header en la tabla myMovie
				if(isset($idSeason) && isset($idDisc))
				{

					$modelMyMovieDB = MyMovie::model()->findByPk($item->myMovie->Id);
					$modelMyMovieDB->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
					$modelMyMovieDB->is_serie = 1;
					$modelMyMovieDB->save();
					
					//grabo episodios
					$episodes = $item->myMovie->myMovieSerieHeader->myMovieSeason->Episode;
					foreach($episodes as $episode)
					{
						$modelMyMovieEpisodeDB = MyMovieEpisode::model()->findByAttributes(array(
																		'Id_my_movie_season'=>$idSeason,
																		'episode_number'=>$episode->episode_number,
						));
						
						$idEpisode = null;
						if(!isset($modelMyMovieEpisodeDB))
						{
							$modelMyMovieEpisode = new MyMovieEpisode();
							$modelMyMovieEpisode->setAttributesByArray($episode);
							$modelMyMovieEpisode->Id_my_movie_season = $idSeason;
							$modelMyMovieEpisode->save();
							$idEpisode = $modelMyMovieEpisode->Id; 
						}
						else
							$idEpisode = $modelMyMovieEpisodeDB->Id;
						
						if(isset($idEpisode))
						{
							$modelDiscEpisodeDB = MyMovieDiscMyMovieEpisode::model()->findByAttributes(array(
														'Id_my_movie_episode'=>$idEpisode,
														'Id_my_movie_disc'=>$idDisc,
														));
							
							if(!isset($modelDiscEpisodeDB))
							{
								$modelDiscEpisode = new MyMovieDiscMyMovieEpisode();
								$modelDiscEpisode->Id_my_movie_disc = $idDisc;
								$modelDiscEpisode->Id_my_movie_episode = $idEpisode;
								$modelDiscEpisode->save();
							}
						}
						
					}
				}
				
				//grabo que device rippio el disco
				$modelRippedCustomerDB = RippedCustomer::model()->findByAttributes(array(
														'Id_my_movie_disc'=>$item->myMovieDisc->Id,
														'Id_device'=>$item->Id_device,
				));
				if(!isset($modelRippedCustomerDB))
				{
					$modelRippedCustomer = new RippedCustomer();
					$modelRippedCustomer->Id_device = $item->Id_device;
					$modelRippedCustomer->Id_my_movie_disc = $item->myMovieDisc->Id;
					$modelRippedCustomer->ripped_date = $item->ripped_date;
					$modelRippedCustomer->save();
				}
				
				//grabo los audiotrack del disco rippeado
				foreach($item->myMovie->AudioTrack as $audio)
				{
					$modelAudio = AudioTrack::model()->findByAttributes(array(
														'language'=>$audio->language,
														'type'=>$audio->type,
														'chanel'=>$audio->chanel,
															));
					if(!isset($modelAudio))
					{
						$modelAudio = new AudioTrack();
						$modelAudio->language = $audio->language;
						$modelAudio->type = $audio->type;
						$modelAudio->chanel = $audio->chanel;
						$modelAudio->save();
					}
					
					$myMovieAudioTrack = MyMovieAudioTrack::model()->findByAttributes(array(
																	'Id_my_movie'=>$item->myMovie->Id,
																	'Id_audio_track'=>$modelAudio->Id,
																	));
					if(!isset($myMovieAudioTrack))
					{
						$myMovieAudioTrack = new MyMovieAudioTrack();
						$myMovieAudioTrack->Id_audio_track = $modelAudio->Id;
						$myMovieAudioTrack->Id_my_movie = $item->myMovie->Id;
						$myMovieAudioTrack->save();
					}
					
				}
			
				//grabo los subtitulos del disco rippeado
				foreach($item->myMovie->Subtitle as $sub)
				{
					$modelSub = Subtitle::model()->findByAttributes(array(
																		'language'=>$sub->language,																		
																	));
					if(!isset($modelSub))
					{
						$modelSub = new Subtitle();
						$modelSub->language = $sub->language;
						$modelSub->save();
					}
						
					$myMovieSubtitle = MyMovieSubtitle::model()->findByAttributes(array(
																	'Id_my_movie'=>$item->myMovie->Id,
																	'Id_subtitle'=>$modelSub->Id,
															));
					if(!isset($myMovieSubtitle))
					{
						$myMovieSubtitle = new MyMovieSubtitle();
						$myMovieSubtitle->Id_subtitle = $modelSub->Id;
						$myMovieSubtitle->Id_my_movie = $item->myMovie->Id;
						$myMovieSubtitle->save();
					}
						
				}
				
				//grabo las personas del disco rippeado
				foreach($item->myMovie->Person as $person)
				{
					$modelPerson = Person::model()->findByAttributes(array(
																		'name'=>$person->name,
																		'type'=>$person->type,
																		'role'=>$person->role,
					));
					if(!isset($modelPerson))
					{
						$modelPerson = new Person();
						$modelPerson->name = $person->name;
						$modelPerson->type = $person->type;
						$modelPerson->role = $person->role;
						$modelPerson->photo_original = $person->photo_original;
						$modelPerson->save();
					}
						
					$myMoviePerson = MyMoviePerson::model()->findByAttributes(array(
															'Id_my_movie'=>$item->myMovie->Id,
															'Id_person'=>$modelPerson->Id,
					));
					if(!isset($myMoviePerson))
					{
						$myMoviePerson = new MyMoviePerson();
						$myMoviePerson->Id_person = $modelPerson->Id;
						$myMoviePerson->Id_my_movie = $item->myMovie->Id;
						$myMoviePerson->save();
					}
						
				}
			}
	
		} catch (Exception $e) {
			return false;
		}
		return true;
	
	}
	
	
	/**
	 *
	 * Change nzb status in relation device/nzb
	 * @param NzbStateRequest[]
	 * @return boolean
	 * @soap
	 */
	public function setNzbState($nzbStateRequest )
	{
		// 		Yii::trace('date param: '. $date, 'webService');
		// 		Yii::trace('idCustomer param: '. $idCustomer, 'webService');
		// 		Yii::trace('idMovie param: '. $idMovie, 'webService');
		// 		Yii::trace('idState param: '. $idState, 'webService');
		
		try {

			foreach($nzbStateRequest as $item)
			{
				$model = NzbDevice::model()->findByAttributes(array('Id_device'=>$item->Id_device, 'Id_nzb'=>$item->Id_nzb));
			
				if(isset($model))
				{
					$model->Id_nzb_state = $item->Id_state;
					switch ($item->Id_state) {
						case 1:
							$model->date_sent = date("Y-m-d H:i:s",$item->change_state_date);
							break;
						case 2:
							$model->date_downloading = date("Y-m-d H:i:s",$item->change_state_date);
							//$this->doTransaction($item->Id_nzb, $item->Id_device);
							break;
						case 3:
							$model->date_downloaded = date("Y-m-d H:i:s",$item->change_state_date);
							break;
					}
					$model->need_update = 0;
					$model->save();
				}
			}
			
			
		} catch (Exception $e) {
			return false;
		}
		return true;

	}


	/**
	*
	* get customer points
	* @param integer idCustomer
	* @param integer idTransaction
	* @return TransactionResponse[]
	* @soap
	*/
	public function getPoints($idCustomer, $idTransaction)
	{
		$criteria=new CDbCriteria;
		
		if($idTransaction != 0)
			$criteria->addCondition('t.Id > '. $idTransaction);
		
		//$criteria->addCondition('t.Id_nzb is null');
		$criteria->addCondition('t.Id_customer = '. $idCustomer);
		
		$arrayResponse = array();
		
		$arrayTransaction = CustomerTransaction::model()->findAll($criteria);
		
		foreach($arrayTransaction as $modelTrans)
		{
			$transResponse = new TransactionResponse;
			$transResponse->setAttributes($modelTrans);
			$arrayResponse[]=$transResponse;
		}		
		
		
		return $arrayResponse;
	}
	
	/***
	 * Make a debit transaction with the nzb and customer
	 */
	private function doTransaction($idNzb, $idCustomer)
	{
		$modelNzb =  Nzb::model()->findByPk($idNzb);
		if(isset($modelNzb))
		{
			$model = new CustomerTransaction;
			$model->attributes = array('Id_nzb'=>$idNzb,
										'Id_customer'=>$idCustomer,
										'points'=>$modelNzb->points,
										'Id_transaction_type'=>1, //Debit
										'description'=>'Extraccion automatica por consumo');
			$model->save();
			
			
			//customer points decrement
			$modelCustomer = Customer::model()->findByPk($idCustomer);
			$modelCustomer->current_points = $modelCustomer->current_points - $model->points;
			$modelCustomer->save();
		}
	}
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		array('allow',
				'users'=>array('*'),
		),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionViewTv($id)
	{
		$model = $this->loadModel($id);
		$modelDiscEpisodes = new MyMovieDiscNzbMyMovieEpisode('search');
		$modelDiscEpisodes->unsetAttributes();  // clear any default values
		$modelDiscEpisodes->Id_my_movie_disc_nzb = $model->Id_my_movie_disc_nzb;
		
		if(isset($_GET['MyMovieDiscNzbMyMovieEpisode']))
			$modelDiscEpisodes->attributes=$_GET['MyMovieDiscNzbMyMovieEpisode'];
		
		$this->render('viewTv',array(
					'model'=>$model,
					'modelDiscEpisodes'=>$modelDiscEpisodes,
		));
	}
	
	public function actionViewReseller($id)
	{
		$this->render('viewReseller',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewTvReseller($id)
	{
		$model = $this->loadModel($id);
		$modelDiscEpisodes = new MyMovieDiscNzbMyMovieEpisode('search');
		$modelDiscEpisodes->unsetAttributes();  // clear any default values
		$modelDiscEpisodes->Id_my_movie_disc_nzb = $model->Id_my_movie_disc_nzb;
	
		if(isset($_GET['MyMovieDiscNzbMyMovieEpisode']))
		$modelDiscEpisodes->attributes=$_GET['MyMovieDiscNzbMyMovieEpisode'];
	
		$this->render('viewTvReseller',array(
						'model'=>$model,
						'modelDiscEpisodes'=>$modelDiscEpisodes,
		));
	}
	
	public function actionViewEpisodeReseller($id)
	{
		$this->render('viewEpisodeReseller',array(
					'model'=>$this->loadModel($id),
		));
	}
	

	public function actionUploadError()
	{
		$this->render('uploadError');
	}

	public function actionAjaxDownloadFile($fileName, $root)
	{
		$myfile = Yii::app()->file->set('./'.$root.'/'.$fileName, true);
		echo $myfile->send();
	}

	private function findImdbID($id, $stack) {
		foreach ($stack as $k => $v) {
			if ($v->ID == $id) {
					return true;
				}
		}
	
		// Return false since there was nothing found
		return false;
	}
	
	public function actionCreate()
	{	
		
		$this->render('create');
	}


	public function actionAjaxPublishNzb()
	{
		$id = $_POST['nzbId'];
		if($id)
		{
			$model=$this->loadModel($id);
			$model->is_draft = 0;
			$model->save();
			$nzbCreationState = new NzbCreationState();
			$nzbCreationState->Id_creation_state = 5;
			$nzbCreationState->Id_nzb = $id;
			$nzbCreationState->user_username = Yii::app()->user->name;
			$nzbCreationState->save();
				
		}
	}
	
	public function actionAjaxFillSeason()
	{
		$id = $_POST['ImdbdataTv']['Id_parent'];

		//please enter current controller name because yii send multi dim array
		$data = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));

		$data = CHtml::listData($data,'season','season');
		foreach($data as $value=>$name)
		{
			$ddlSeason .= CHtml::tag('option',
			array('value'=>$value),CHtml::encode($name),true);
		}

		$data = Season::model()->findByAttributes(array('Id_imdbdata_tv'=>$id, 'season'=>1));
		$index = 1;
		if($data->episodes != null)
		{
			while ($index <= $data->episodes) {
				$ddlEpisode .= CHtml::tag('option',
				array('value'=>$index),CHtml::encode($index),true);
				$index = $index + 1;
			}
		}

		echo CJSON::encode(array(
		  'season'=>$ddlSeason,
		  'episode'=>$ddlEpisode
		));
	}

	public function actionAjaxFillEpisodes()
	{
		//please enter current controller name because yii send multi dim array
		$id = $_POST['ImdbdataTv']['Id_parent'];
		$season = $_POST['ImdbdataTv']['Season'];
		$data = Season::model()->findByAttributes(array('Id_imdbdata_tv'=>$id, 'season'=>$season));
		$index = 1;
		if($data->episodes != null)
		{
			while ($index <= $data->episodes) {
				echo CHtml::tag('option',
				array('value'=>$index),CHtml::encode($index),true);
				$index = $index + 1;
			}
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateMovie()
	{
		$model=new Nzb;		
		$modelMyMovieAPIRequest = new MyMovieAPIRequest;
		
		$ddlRsrcType = ResourceType::model()->findAll();

		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];

		if(isset($_POST['hiddenTitleId']))
		{			
			$idTitle = $_POST['hiddenTitleId'];			
				
			if(!empty($idTitle))
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
															
					$model->file_original_name = uniqid() . '.nzb';
					
					//dejo la clave solo de 9 caracteres xq sino el sabnzb no descomprime el .rar
					$pwd = uniqid();
					$model->file_password = substr($pwd, -9);
					
					$model->Id_my_movie_disc_nzb = MyMovieHelper::saveMyMovieData($idTitle);

					$model->final_content_path = $this->createFileFinalPath($model);
					
					if($model->save()){
						$transaction->commit();
						$this->redirect(array('updateNzb','id'=>$model->Id));
					}
						
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}

		$rawData = array();
		
		if(isset($_GET['MyMovieAPIRequest']))
		{
			$modelMyMovieAPIRequest->setAttributes($_GET['MyMovieAPIRequest']);
			
			if($_GET['rbnSearchField'] == 'title')
				$rawData = MyMovieHelper::searchTitles($modelMyMovieAPIRequest->Title, $modelMyMovieAPIRequest->Country);
			else
				$rawData = MyMovieHelper::searchTitlesByIMDBId($modelMyMovieAPIRequest->Title, $modelMyMovieAPIRequest->Country);
			
		}
		
		
		$arrayDataProvider=new CArrayDataProvider($rawData, array(
				    'id'=>'id',
				 	'sort'=>array(
						'attributes'=>array('year', 'type', 'country'),
					),
		
				          'pagination'=>array('pageSize'=>10),
		
		));
		
		$this->render('createMovie',array(
			'model'=>$model,			
			'ddlRsrcType'=>$ddlRsrcType,
			'arrayDataProvider'=>$arrayDataProvider,
			'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,
		));
	}

	private function createFileFinalPath($model)
	{
		$finalPath = "";
		$fileName = str_replace('.nzb','',$model->file_original_name);
		
		if($model->Id_resource_type > 2)
		{
			$ext = '.'.strtolower($model->resourceType->description);
			$finalPath = $fileName . $ext;
		}
		else
			$finalPath = $fileName;
		
		return $finalPath;
	}
	
	public function actionCreateMovieManually()
	{
		$model=new Nzb;		
		$modelMyMovieNzb = new MyMovieNzb();
	
		$ddlParentalControl = ParentalControl::model()->findAll();
		$ddlRsrcType = ResourceType::model()->findAll();
	
		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];
	
		if(isset($_POST['MyMovieNzb']))
		{			
			$modelMyMovieNzb->attributes = $_POST['MyMovieNzb'];
	
			$transaction = $model->dbConnection->beginTransaction();
			try {

				$model->file_original_name = uniqid() . '.nzb';
				
				$model->file_password = uniqid();
			
				$model->final_content_path = $this->createFileFinalPath($model);
					
				$model->Id_my_movie_disc_nzb = MyMovieHelper::saveMyMovieDataByModel($modelMyMovieNzb);

				if($model->save()){
					$transaction->commit();
					$this->redirect(array('updateNzb','id'=>$model->Id));
				}

			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	
		$this->render('createMovieManually',array(
				'model'=>$model,				
				'ddlRsrcType'=>$ddlRsrcType,
				'ddlParentalControl'=>$ddlParentalControl,
				'modelMyMovieNzb'=>$modelMyMovieNzb,
		));
	}
	
	public function actionSelectSpecification($id,$redirectActionPage)
	{
		$model = Nzb::model()->findByPk($id);
		
		$modelSubtitle = new Subtitle('search');
		$modelSubtitle->unsetAttributes();  // clear any default values
		
		$modelAudioTrack = new AudioTrack('search');
		$modelAudioTrack->unsetAttributes();  // clear any default values
		
		$modelPerson = new Person('search');
		$modelPerson->unsetAttributes();  // clear any default values
		
		$modelNzbSubtitle = new MyMovieNzbSubtitle('search');
		$modelNzbSubtitle->unsetAttributes();  // clear any default values
		$modelNzbSubtitle->Id_my_movie_nzb = $model->myMovieDiscNzb->Id_my_movie_nzb;
		
		$modelNzbAudioTrack = new MyMovieNzbAudioTrack('search');
		$modelNzbAudioTrack->unsetAttributes();  // clear any default values
		$modelNzbAudioTrack->Id_my_movie_nzb = $model->myMovieDiscNzb->Id_my_movie_nzb;
		
		$modelNzbPerson = new MyMovieNzbPerson('search');
		$modelNzbPerson->unsetAttributes();  // clear any default values
		$modelNzbPerson->Id_my_movie_nzb = $model->myMovieDiscNzb->Id_my_movie_nzb;
		
		if(isset($_GET['Subtitle']))
			$modelSubtitle->attributes=$_GET['Subtitle'];
		
		if(isset($_GET['AudioTrack']))
			$modelAudioTrack->attributes=$_GET['AudioTrack'];
		
		if(isset($_GET['Person']))
			$modelPerson->attributes=$_GET['Person'];
		
		if(isset($_GET['MyMovieNzbSubtitle']))
			$modelNzbSubtitle->attributes=$_GET['MyMovieNzbSubtitle'];
		
		if(isset($_GET['MyMovieNzbAudioTrack']))
			$modelNzbAudioTrack->attributes=$_GET['MyMovieNzbAudioTrack'];
		
		if(isset($_GET['MyMovieNzbPerson']))
			$modelNzbPerson->attributes=$_GET['MyMovieNzbPerson'];
		
		$this->render('selectSpecification',array(
						'model'=>$model,
						'modelSubtitle'=>$modelSubtitle,
						'modelAudioTrack'=>$modelAudioTrack,
						'modelPerson'=>$modelPerson,
						'modelNzbSubtitle'=>$modelNzbSubtitle,
						'modelNzbAudioTrack'=>$modelNzbAudioTrack,
						'modelNzbPerson'=>$modelNzbPerson,
						'redirectActionPage'=>$redirectActionPage,
		));
	}
	
	public function actionUpdateSpecification($id)
	{
		$model = MyMovieNzb::model()->findByPk($id);
	
		$modelSubtitle = new Subtitle('search');
		$modelSubtitle->unsetAttributes();  // clear any default values
	
		$modelAudioTrack = new AudioTrack('search');
		$modelAudioTrack->unsetAttributes();  // clear any default values
	
		$modelPerson = new Person('search');
		$modelPerson->unsetAttributes();  // clear any default values
		
		$modelNzbSubtitle = new MyMovieNzbSubtitle('search');
		$modelNzbSubtitle->unsetAttributes();  // clear any default values
		$modelNzbSubtitle->Id_my_movie_nzb = $id;
	
		$modelNzbAudioTrack = new MyMovieNzbAudioTrack('search');
		$modelNzbAudioTrack->unsetAttributes();  // clear any default values
		$modelNzbAudioTrack->Id_my_movie_nzb = $id;
			
		$modelNzbPerson = new MyMovieNzbPerson('search');
		$modelNzbPerson->unsetAttributes();  // clear any default values
		$modelNzbPerson->Id_my_movie_nzb = $id;
		
		if(isset($_GET['Subtitle']))
			$modelSubtitle->attributes=$_GET['Subtitle'];
	
		if(isset($_GET['AudioTrack']))
			$modelAudioTrack->attributes=$_GET['AudioTrack'];
	
		if(isset($_GET['MyMovieNzbSubtitle']))
			$modelNzbSubtitle->attributes=$_GET['MyMovieNzbSubtitle'];
	
		if(isset($_GET['MyMovieNzbAudioTrack']))
			$modelNzbAudioTrack->attributes=$_GET['MyMovieNzbAudioTrack'];
	
		if(isset($_GET['MyMovieNzbPerson']))
			$modelNzbPerson->attributes=$_GET['MyMovieNzbPerson'];
		
		$this->render('updateSpecification',array(
							'model'=>$model,
							'modelSubtitle'=>$modelSubtitle,
							'modelAudioTrack'=>$modelAudioTrack,
							'modelPerson'=>$modelPerson,
							'modelNzbSubtitle'=>$modelNzbSubtitle,
							'modelNzbAudioTrack'=>$modelNzbAudioTrack,
							'modelNzbPerson'=>$modelNzbPerson,
		));
	}
	
	public function actionCreateBox()
	{
		$model=new Nzb;
		$modelMyMovieDiscNzb = new MyMovieDiscNzb();
		$modelMyMovieNzb = new MyMovieNzb('search');
		$modelMyMovieNzb->unsetAttributes();  // clear any default values
	
		if(isset($_GET['MyMovieNzb']))
			$modelMyMovieNzb->attributes=$_GET['MyMovieNzb'];
	
		$ddlRsrcType = ResourceType::model()->findAll();
	
		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];
	
		if(isset($_POST['hiddenMyMovieNzbId']))
		{			
			$modelMyMovieDiscNzb->attributes = $_POST['MyMovieDiscNzb'];
			
			$idMyMovieNzb = $_POST['hiddenMyMovieNzbId'];			
	
			if(!empty($idMyMovieNzb))
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					
					$model->file_original_name = uniqid() . '.nzb';
						
					$model->file_password = uniqid();
					
					$model->final_content_path = $this->createFileFinalPath($model);
	
					$modelMyMovieDiscNzb->Id_my_movie_nzb = $idMyMovieNzb;
					
					$model->Id_my_movie_disc_nzb = MyMovieHelper::createDisc($modelMyMovieDiscNzb);
	
					if($model->save()){
						$transaction->commit();
						
						$myMovieNzb = MyMovieNzb::model()->findByPk($idMyMovieNzb);
						
						if(isset($myMovieNzb->Id_my_movie_serie_header))
							$this->redirect(array('selectSeason','id'=>$model->Id));
						else
							$this->redirect(array('selectSerie','id'=>$model->Id));
					}
	
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}
	
		$this->render('selectBox',array(
					'model'=>$model,					
					'ddlRsrcType'=>$ddlRsrcType,
					'modelMyMovieNzb'=>$modelMyMovieNzb,
					'modelMyMovieDiscNzb'=>$modelMyMovieDiscNzb,
		));
	}
	
	public function actionSelectSerie($id)
	{
		$model = Nzb::model()->findByPk($id);
		$modelMyMovieSerieHeader = new MyMovieSerieHeader('search');
		$modelMyMovieSerieHeader->unsetAttributes();  // clear any default values
		
		
		if(isset($_GET['MyMovieSerieHeader']))
			$modelMyMovieSerieHeader->attributes=$_GET['MyMovieSerieHeader'];
		
		if(isset($_POST['hiddenSerieId']))
		{
			$idSerie = $_POST['hiddenSerieId'];
	
			if(!empty($idSerie))
			{
				try {
					$myMovieNzb = MyMovieNzb::model()->findByPk($model->myMovieDiscNzb->Id_my_movie_nzb); 
					$myMovieNzb->Id_my_movie_serie_header = $idSerie;
			
					if($myMovieNzb->save()){
						$this->redirect(array('selectSeason','id'=>$model->Id));
					}
	
				} catch (Exception $e) {
				}
			}
		}
	
		$this->render('selectSerie',array(
				'model'=>$model,
				'modelMyMovieSerieHeader'=>$modelMyMovieSerieHeader,
		));
	}
	
	public function actionSelectSeason($id)
	{
		$model = Nzb::model()->findByPk($id);
		$modelMyMovieSeason = new MyMovieSeason('search');
		$modelMyMovieSeason->unsetAttributes();  // clear any default values
		$modelMyMovieSeason->Id_my_movie_serie_header = $model->myMovieDiscNzb->myMovieNzb->Id_my_movie_serie_header;
		
	
		if(isset($_GET['MyMovieSeason']))
			$modelMyMovieSeason->attributes=$_GET['MyMovieSeason'];
	
		if(isset($_POST['hiddenSeasonId']))
		{
			$idSeason = $_POST['hiddenSeasonId'];
	
			if(!empty($idSeason))
			{
				$this->getEpisodes($modelMyMovieSeason->Id_my_movie_serie_header, $idSeason);
				$this->redirect(array('selectEpisode','id'=>$model->Id, 'idSeason'=>$idSeason, 'fromSeason'=>true));
			}
		}
	
		$this->render('selectSeason',array(
					'model'=>$model,
					'modelMyMovieSeason'=>$modelMyMovieSeason,
		));
	}
	
	private function getEpisodes($idSerie, $idSeason)
	{
		$modelSeason = MyMovieSeason::model()->findByPk($idSeason);
		
		$criteria=new CDbCriteria;
		
		$criteria->select = 'max(episode_number) max_episode';
		$criteria->addCondition('t.Id_my_movie_season = "'. $idSeason.'"');
		
		
		$modelEpisodeDB = MyMovieEpisode::model()->find($criteria);
		
		if(isset($modelEpisodeDB))
			$newEpisodeNumber = $modelEpisodeDB->max_episode;
		else 
			$newEpisodeNumber = 0;
		
		$findNext = true;
		while ($findNext) 
		{
			$newEpisodeNumber++;
			$model = MyMovieHelper::searchEpisode( $idSerie,
												   $modelSeason->season_number,
												   $newEpisodeNumber,
												   ''
													);
			if(isset($model))
			{
				$model->Id_my_movie_season = $idSeason;
				$model->save();
			}
			else
				$findNext = false;
		}
		
	}
	
	public function actionSelectEpisode($id, $idSeason, $fromSeason = false)
	{
		if(empty($idSeason))
			$this->redirect(array('selectSeason','id'=>$id));
		
		$model = Nzb::model()->findByPk($id);
		
		$modelDiscEpisodes = new MyMovieDiscNzbMyMovieEpisode('search');
		$modelDiscEpisodes->unsetAttributes();  // clear any default values
		$modelDiscEpisodes->Id_my_movie_disc_nzb = $model->Id_my_movie_disc_nzb;
		
		$modelMyMovieEpisode = new MyMovieEpisode('search');
		$modelMyMovieEpisode->unsetAttributes();  // clear any default values
		
		$modelMyMovieEpisode->Id_my_movie_season = $idSeason;
	
		if(isset($_GET['MyMovieEpisode']))
			$modelMyMovieEpisode->attributes=$_GET['MyMovieEpisode'];
		
		if(isset($_GET['MyMovieDiscNzbMyMovieEpisode']))
			$modelDiscEpisodes->attributes=$_GET['MyMovieDiscNzbMyMovieEpisode'];
	
		$redirectActionPage = 'viewTv';
		if($fromSeason)
			$redirectActionPage = 'updateNzb';
		
		$this->render('selectEpisode',array(
						'model'=>$model,
						'modelMyMovieEpisode'=>$modelMyMovieEpisode,
						'modelDiscEpisodes'=>$modelDiscEpisodes,
						'redirectActionPage'=>$redirectActionPage,
		));
	}
	
	public function actionAjaxSearchEpisode()
	{
		if(isset($_POST['MyMovieAPIRequest']))
		{
			$model = MyMovieHelper::searchEpisode( $_POST['MyMovieAPIRequest']['SerieGuid'], 
														$_POST['MyMovieAPIRequest']['Seasonnumber'],
														$_POST['MyMovieAPIRequest']['Episodenumber'],
														$_POST['MyMovieAPIRequest']['Country']
													);
	
			if(isset($model))
				echo json_encode($model->attributes);
		}
	}
	
	public function actionAjaxSaveEpisode()
	{
		$model = new MyMovieEpisode();
		if(isset($_POST['MyMovieEpisode']))
		{
			$model->attributes = $_POST['MyMovieEpisode'];
				
			$modelMyMovieEpisodeDB = MyMovieEpisode::model()->findByAttributes(array(
											'Id_my_movie_season'=>$model->Id_my_movie_season,
											'episode_number'=>$model->episode_number,
			));
				
			if(!isset($modelMyMovieEpisodeDB))
			{
				$model->save();
			}
		}
	}
	
	public function actionAjaxSaveBox()
	{
		$model = new MyMovieNzb();
		if(isset($_POST['MyMovieNzb']))
		{
			$model->attributes = $_POST['MyMovieNzb'];
	
			$modelMyMovieNzbDB = MyMovieNzb::model()->findByAttributes(array(
												'original_title'=>$model->original_title,
												'production_year'=>$model->production_year,
			));
	
			if(!isset($modelMyMovieNzbDB))
			{
				$model->Id = uniqid();
				$model->poster = MyMovieHelper::getImage($model->poster_original, $model->Id);
				$model->backdrop = MyMovieHelper::getImage($model->backdrop_original, $model->Id . '_bd');
				$model->is_serie = 1;
				$model->save();
				return $model->Id; 
			}
		}
	}
	
	public function actionAjaxSaveAudioTrack()
	{
		$model = new AudioTrack();
		if(isset($_POST['AudioTrack']))
		{
			$model->attributes = $_POST['AudioTrack'];
	
			$modelAudioTrackDB = AudioTrack::model()->findByAttributes(array(
													'language'=>$model->language,
													'type'=>$model->type,
													'chanel'=>$model->chanel,
			));
	
			if(!isset($modelAudioTrackDB))
			{
				$model->save();
			}
		}
	}

	public function actionAjaxSaveSubtitle()
	{
		$model = new Subtitle();
		if(isset($_POST['Subtitle']))
		{
			$model->attributes = $_POST['Subtitle'];
	
			$modelSubtitleDB = Subtitle::model()->findByAttributes(array(
														'language'=>$model->language,
			));
	
			if(!isset($modelSubtitleDB))
			{
				$model->save();
			}
		}
	}
	
	public function actionAjaxSavePerson()
	{
		$model = new Person();
		if(isset($_POST['Person']))
		{
			$model->attributes = $_POST['Person'];
	
			$modelPersonDB = Person::model()->findByAttributes(array(
															'name'=>$model->name,
															'type'=>$model->type,
															'role'=>$model->role,
			));
	
			if(!isset($modelPersonDB))
			{
				$model->save();
			}
		}
	}
	
	public function actionAjaxSearchSeason()
	{
		if(isset($_POST['MyMovieAPIRequest']))
		{
			$model = MyMovieHelper::searchSeasonBanner($_POST['MyMovieAPIRequest']['Id'], $_POST['MyMovieAPIRequest']['Seasonnumber']);
				
			if(isset($model))
				echo json_encode($model->attributes);
		}
	}
	
	public function actionAjaxSaveSeason()
	{
		$model = new MyMovieSeason();
		if(isset($_POST['MyMovieSeason']))
		{
			$model->attributes = $_POST['MyMovieSeason'];
			
			$modelMyMovieSeasonDB = MyMovieSeason::model()->findByAttributes(array(
													'Id_my_movie_serie_header'=>$model->Id_my_movie_serie_header,
													'season_number'=>$model->season_number,
			));
			
			if(!isset($modelMyMovieSeasonDB))
			{
				$newFileName = $model->Id_my_movie_serie_header .'_'.$model->season_number;
				$model->banner = MyMovieHelper::getImage($model->banner_original, $newFileName);
				
				$model->save();
			}
		}
	}
	
	public function actionAjaxSearchSerieHeader()
	{
		if(isset($_POST['MyMovieAPIRequest']))
		{
			if($_POST['rbnSearchField'] == 'title')
				$model = MyMovieHelper::searchSerieByTitle($_POST['MyMovieAPIRequest']['Title'], $_POST['MyMovieAPIRequest']['Country']);
			else
				$model = MyMovieHelper::searchSerieByIMDBId($_POST['MyMovieAPIRequest']['Title'], $_POST['MyMovieAPIRequest']['Country']);
			
			if(isset($model))
				echo json_encode($model->attributes);
		}
	}
	
	public function actionAjaxSaveSerieHeader()
	{
		$model = new MyMovieSerieHeader();
		if(isset($_POST['MyMovieSerieHeader']))
		{
			$model->attributes = $_POST['MyMovieSerieHeader'];
			
			//si el id es null. El alta es manual
			if(!isset($model->Id))
				$model->Id = uniqid();
			
			$modelMyMovieSerieDB = MyMovieSerieHeader::model()->findByPk($model->Id);
			
			if(!isset($modelMyMovieSerieDB))
			{
				$model->poster = MyMovieHelper::getImage($model->poster_original, $model->Id);
				$model->save();
			}
		}
	}
	
	public function actionAjaxAddAudioTrack()
	{
		$idAudioTrack = isset($_GET['idAudioTrack'][0])?$_GET['idAudioTrack'][0]:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idAudioTrack)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbAudioTrack::model()->findByPk(array(
											'Id_audio_track'=>(int) $idAudioTrack,
											'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(!isset($relationDB))
			{
				$model=new MyMovieNzbAudioTrack();
				$model->attributes = array('Id_audio_track'=>$idAudioTrack,'Id_my_movie_nzb'=>$idMyMovieNzb);
				$model->save();
			}
		}
	}
	
	public function actionAjaxAddSubtitle()
	{
		$idSubtitle = isset($_GET['idSubtitle'][0])?$_GET['idSubtitle'][0]:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idSubtitle)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbSubtitle::model()->findByPk(array(
												'Id_subtitle'=>(int) $idSubtitle,
												'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(!isset($relationDB))
			{
				$model=new MyMovieNzbSubtitle();
				$model->attributes = array('Id_subtitle'=>$idSubtitle,'Id_my_movie_nzb'=>$idMyMovieNzb);
				$model->save();
			}
		}
	}
	
	public function actionAjaxAddPerson()
	{
		$idPerson = isset($_GET['idPerson'][0])?$_GET['idPerson'][0]:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idPerson)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbPerson::model()->findByPk(array(
													'Id_person'=>(int) $idPerson,
													'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(!isset($relationDB))
			{
				$model=new MyMovieNzbPerson();
				$model->attributes = array('Id_person'=>$idPerson,'Id_my_movie_nzb'=>$idMyMovieNzb);
				$model->save();
			}
		}
	}
	
	public function actionAjaxAddDiscEpisode()
	{
		$idEpisode = isset($_GET['idEpisode'][0])?$_GET['idEpisode'][0]:'';
		$idDisc = isset($_GET['idDisc'])?$_GET['idDisc']:'';
			
		if(!empty($idEpisode)&&!empty($idDisc))
		{
			$relationDB = MyMovieDiscNzbMyMovieEpisode::model()->findByPk(array('Id_my_movie_episode'=>(int) $idEpisode,'Id_my_movie_disc_nzb'=>$idDisc));
			if(!isset($relationDB))
			{
				$model=new MyMovieDiscNzbMyMovieEpisode();
				$model->attributes = array('Id_my_movie_episode'=>$idEpisode,'Id_my_movie_disc_nzb'=>$idDisc);
				$model->save();
			}
		}
	}
	
	public function actionAjaxRemoveDiscEpisode()
	{
		$idEpisode = isset($_GET['idEpisode'])?$_GET['idEpisode']:'';
		$idDisc = isset($_GET['idDisc'])?$_GET['idDisc']:'';
			
		if(!empty($idEpisode)&&!empty($idDisc))
		{
			$relationDB = MyMovieDiscNzbMyMovieEpisode::model()->findByPk(array('Id_my_movie_episode'=>(int) $idEpisode,'Id_my_movie_disc_nzb'=>$idDisc));
			if(isset($relationDB))
			{
				$relationDB->delete();
			}
		}
	}
	
	public function actionAjaxRemoveAudioTrack()
	{
		$idAudioTrack = isset($_GET['idAudioTrack'])?$_GET['idAudioTrack']:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idAudioTrack)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbAudioTrack::model()->findByPk(array('Id_audio_track'=>(int) $idAudioTrack,'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(isset($relationDB))
			{
				$relationDB->delete();
			}
		}
	}
	
	public function actionAjaxRemoveSubtitle()
	{
		$idSubtitle = isset($_GET['idSubtitle'])?$_GET['idSubtitle']:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idSubtitle)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbSubtitle::model()->findByPk(array('Id_subtitle'=>(int) $idSubtitle,'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(isset($relationDB))
			{
				$relationDB->delete();
			}
		}
	}
	
	public function actionAjaxRemovePerson()
	{
		$idPerson = isset($_GET['idPerson'])?$_GET['idPerson']:'';
		$idMyMovieNzb = isset($_GET['idMyMovieNzb'])?$_GET['idMyMovieNzb']:'';
			
		if(!empty($idPerson)&&!empty($idMyMovieNzb))
		{
			$relationDB = MyMovieNzbPerson::model()->findByPk(array('Id_person'=>(int) $idPerson,'Id_my_movie_nzb'=>$idMyMovieNzb));
			if(isset($relationDB))
			{
				$relationDB->delete();
			}
		}
	}
	
	
	public function actionAjaxGetMovieMoreInfo()
	{
		$idTitle = isset($_POST['titleId'])?$_POST['titleId']:null;
		
		if(isset($idTitle))
		{
			$model = MyMovieHelper::getMyMovieData($idTitle,false);		
			echo $this->renderPartial('_viewInfo', array(
														'model'=>$model,
				));
		}
	}
	

	private function saveFile($file, $root, $name)
	{
		if($file != null)
		{
			if(! $file->saveAs('./'.$root.'/'.$name))
			{
				$this->redirect(array('uploadError'));
			}
		}
	}
	
	public function actionUpdateNzb($id)
	{
		$model=$this->loadModel($id);
		$modelUpload=new Upload;
		$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($model->Id_my_movie_disc_nzb);
		$ddlRsrcType = ResourceType::model()->findAll();
		$hasChanged = false;

		if(isset($_POST['Nzb']))
		{
			$hasChanged = true;
			if(isset($_POST['Nzb']['Id_resource_type'])&& $_POST['Nzb']['Id_resource_type'] != $model->Id_resource_type )
			{
				$hasChanged = true;
				$model->Id_resource_type = $_POST['Nzb']['Id_resource_type']; 
				$model->final_content_path = $this->createFileFinalPath($model);
			}
				
			if(isset($_POST['Nzb']['points'])&& $_POST['Nzb']['points'] != $model->points )
				$hasChanged = true;
			
			if(isset($_POST['Nzb']['is_draft'])&& $_POST['Nzb']['is_draft'] != $model->is_draft )
				$hasChanged = true;
			
			if(isset($_POST['Nzb']['final_content_path'])&& $_POST['Nzb']['final_content_path'] != $model->final_content_path )
				$hasChanged = true;
				
			$model->attributes = $_POST['Nzb'];
		}

		if(isset($_POST['MyMovieDiscNzb']))
		{
			if(isset($_POST['MyMovieDiscNzb']['name'])&& $_POST['MyMovieDiscNzb']['name'] != $modelMyMovieDiscNzb->name )
				$hasChanged = true;
			
			$modelMyMovieDiscNzb->attributes = $_POST['MyMovieDiscNzb'];
		}
		
		if(isset($_POST['Upload']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			if($file!=null)
			{
				if($modelUpload->validate())
				{										
					
					$fileOriginalName = str_replace('.nzb','',$model->file_original_name);
					$fileName = $fileOriginalName. '.nzb'; 
					
					$model->url = '/nzb/'.$fileName;
					$model->file_name = $fileName;
					
					$this->saveFile($file, 'nzb', $fileName);
					
					$modelMyMovieDiscNzb->save();
					
					$nzbCreationState = new NzbCreationState();
					$nzbCreationState->Id_creation_state = 2;
					$nzbCreationState->Id_nzb = $model->Id;						
					$nzbCreationState->user_username = Yii::app()->user->name;
					$nzbCreationState->save();
									
					$this->saveUpdatedModel($model, $id);
				}
			}
			else
			{
				if($hasChanged){
					$modelMyMovieDiscNzb->save();
					$this->saveUpdatedModel($model, $id);
				}
				else
					$this->redirect(array('view','id'=>$model->Id));
			}
		}
		else
		{
			if($hasChanged){
				$modelMyMovieDiscNzb->save();
				$this->saveUpdatedModel($model, $id);
			}
		}
		if(isset($_POST['Nzb'])||isset($_POST['Upload'])||isset($_POST['MyMovieDiscNzb']))
		{
			$this->redirect(array('view','id'=>$model->Id));				
		}
		

		$this->render('updateNzb',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelMyMovieDiscNzb'=>$modelMyMovieDiscNzb,
			'ddlRsrcType'=>$ddlRsrcType,
		));
	}

	private function saveUpdatedModel($model, $id)
	{
		$transaction = $model->dbConnection->beginTransaction();
		try {
			if($model->save()){
				$this->updateRelation($id);
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->Id));
			}
		
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	private function updateRelation($id)
	{
		$modelRelation = NzbDevice::model()->findAllByAttributes(array('Id_nzb'=>$id));
		
		if(!empty($modelRelation) )
		{
			foreach ($modelRelation as $modelRel){
				$modelRel->need_update = 1;
				$modelRel->save();
			}
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);

			$transaction = $model->dbConnection->beginTransaction();
			try {

				$this->updateRelation($id);
				
				if($model->deleted == 1)
					$model->deleted = 0;
				else
					$model->deleted = 1;
				
				$model->save();
				
				$transaction->commit();
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDeleteEpisode($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
	
			$transaction = $model->dbConnection->beginTransaction();
			try {
	
				$this->updateRelation($id);
	
				if($model->deleted == 1)
					$model->deleted = 0;
				else
					$model->deleted = 1;
	
				$model->save();
	
				$transaction->commit();
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminEpisode'));
	
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	
	public function actionReCreateHeader($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			
			$model = $this->loadModel($id);
			
			$modelHeader = ImdbdataTv::model()->findByPk($model->imdbDataTv->Id_parent);
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
	
				$this->updateHeaderRelation($model->imdbDataTv->Id_parent);
	
				if($modelHeader->Deleted_serie == 1)
					$modelHeader->Deleted_serie = 0;
				else
					$modelHeader->Deleted_serie = 1;
	
				//check if item is deleted
				if($model->deleted == 1)
				{
					$this->updateRelation($id);
					$model->deleted = 0;
					$model->save();
				}
	
				$modelHeader->save();
	
				$transaction->commit();
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminEpisode'));
	
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	private function updateHeaderRelation($id)
	{
		$modelRelation = ImdbdataTvCustomer::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));
	
		if(isset($modelRelation) )
		{
			foreach ($modelRelation as $modelRel){
				$modelRel->need_update = 1;
				$modelRel->save();
			}
		}
	}
	
	/**
	 * Find subtitle.
	 */
	public function actionFindSubtitle($id)
	{
		$model = new Osubtitle('search');
		$modelNzb = Nzb::model()->findByPk($id);

		$model->attributes = array('query'=>str_replace('.nzb','',$modelNzb->file_original_name));

		if(isset($_POST['selectedRow']) && $_POST['selectedRow'] != "")
		{
			$this->downloadSubtitle($_POST['selectedRow'], $id);
			$this->redirect(array('view','id'=>$id));
		}

		$modelOpenSubtitle = new OpenSubtitle('search');
		$modelOpenSubtitle->unsetAttributes();
		
		if(isset($_GET['OpenSubtitle']))
		{
			$modelOpenSubtitle->attributes = $_GET['OpenSubtitle'];
		}
		
			
		$this->render('findSubtitle',array(
				'model'=>$model,
				'modelOpenSubtitle'=>$modelOpenSubtitle,
				'modelNzb'=>$modelNzb
		));
	}

	
	public function actionAjaxChangeCreationState()
	{
		if(isset($_POST['Id_nzb'])&&$_POST['Id_creation_state'])
		{
			$nzbCreationState = new NzbCreationState();
			$nzbCreationState->Id_creation_state = $_POST['Id_creation_state'];
			$nzbCreationState->Id_nzb = $_POST['Id_nzb'];
			$nzbCreationState->user_username = Yii::app()->user->name;
			$nzbCreationState->save();
		}
		
	}
	
	public function actionAjaxDoSearchSubtitle()
	{
		$model = new Osubtitle('search');
		
		if($_POST['Osubtitle'] )
		{
			
			$model->attributes = $_POST['Osubtitle'];
			try {
				$model->searchSubtitle();
			} catch (Exception $e) {
				throw new CHttpException('Searching Subtitle','Invalid request. The OpenSubtitle API is not working. Please try again');
					
			}
		}
	}
	
	public function actionUploadSubtitle($id)
	{

		$model=new Upload;
		$modelNzb = Nzb::model()->findByPk($id);
			
		if(isset($_POST['Upload']))
		{
			$model->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($model,'file');

			if($model->validate())
			{
				$modelRelation = NzbDevice::model()->findAllByAttributes(array('Id_nzb'=>$id));

				$transaction = $modelNzb->dbConnection->beginTransaction();
				try {
						
					$subtFileName = str_replace('.nzb','',$modelNzb->file_name) . '.srt';
						
					$modelNzb->subt_url = '/subtitles/'.rawurlencode($subtFileName);
					$modelNzb->subt_file_name = $subtFileName;
					$modelNzb->subt_original_name = $file->getName();
						
					$this->saveFile($file, 'subtitles', $subtFileName);

					if($modelNzb->save()){
						if(!empty($modelRelation) )
						{
							foreach ($modelRelation as $modelRel){
								$modelRel->need_update = 1;
								$modelRel->save();
							}
						}
						$transaction->commit();
						$this->redirect(array('view','id'=>$id));
					}
						
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}

		$this->render('uploadSubtitle',array(
					'model'=>$model,
					'modelNzb'=>$modelNzb
		));
	}

	public function downloadSubtitle($idOpenSubtitle, $idNzb)
	{
		$openSubtitle = OpenSubtitle::model()->findByPk($idOpenSubtitle);

		try {
			$zip = Osubtitle::downloadSubtitle($openSubtitle->IDSubtitleFile);
		} catch (Exception $e) {
			throw new CHttpException('Downloading subtitle','Invalid request. The OpenSubtitle API is not working. Please '. CHtml::link('try again',Yii::app()->request->getUrl()) .'.');
		}

		$nzb = Nzb::model()->findByPk($idNzb);
		$subtFileName = str_replace('.nzb','',$nzb->file_name) . '.srt';
		try {
			$file = fopen('./subtitles/'.$subtFileName,'w+');
			fwrite($file,gzinflate(substr(base64_decode($zip),10)));
			fclose($file);
		} catch (Exception $e) {
			throw new CHttpException('','There was an error saving the file '. $openSubtitle->SubFileName);
		}


		$nzb->subt_url = '/subtitles/'.rawurlencode($subtFileName);
		$nzb->subt_file_name = $subtFileName;
		$nzb->subt_original_name = $openSubtitle->SubFileName;

		$transaction = $nzb->dbConnection->beginTransaction();
		try {
			$nzb->save();
				
			$modelRelation = NzbDevice::model()->findAllByAttributes(array('Id_nzb'=>$idNzb));
			if(!empty($modelRelation) )
			{
				foreach ($modelRelation as $modelRel){
					$modelRel->need_update = 1;
					$modelRel->save();
				}
			}
				
			OpenSubtitle::model()->deleteAllByAttributes(array('Id_user'=>Yii::app()->user->id));
				
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw new CHttpException('DB','There was an error saving the file '. $openSubtitle->SubFileName);
		}

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Nzb();
		$dataProvider= $model->searchMovie();
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionIndexTv()
	{
		$model = new Nzb();
		$dataProvider= $model->searchTv();
		
		$this->render('indexTv',array(
					'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionIndexReseller()
	{
		$model = new Nzb();
		$dataProvider= $model->searchMovieReseller();
		
		$this->render('indexReseller',array(
					'dataProvider'=>$dataProvider,
		));		
	}
	
	public function actionIndexTvReseller()
	{
		$model = new Nzb();
		$dataProvider= $model->searchTvReseller();
		
		$this->render('indexTvReseller',array(
							'dataProvider'=>$dataProvider,
		));		
	}

	public function actionIndexEpisodeReseller()
	{
		$dataProvider=new CActiveDataProvider('Nzb',array('criteria'=>array('order'=>'Id DESC','condition'=>'Id_imdbdata is null')));
		$this->render('indexEpisodeReseller',array(
					'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Nzb('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Nzb']))
			$model->attributes=$_GET['Nzb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminTv()
	{
		$model=new Nzb('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['Nzb']))
			$model->attributes=$_GET['Nzb'];
	
		$this->render('adminTv',array(
				'model'=>$model,
		));
	}
	
	public function actionAdminBox()
	{
		$model=new MyMovieNzb('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['MyMovieNzb']))
			$model->attributes=$_GET['MyMovieNzb'];
	
		$this->render('adminBox',array(
					'model'=>$model,
		));
	}
	
	public function actionAdminSerie()
	{
		$model=new MyMovieSerieHeader('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['MyMovieSerieHeader']))
			$model->attributes=$_GET['MyMovieSerieHeader'];
	
		$this->render('adminSerie',array(
				'model'=>$model,
		));
	}
	
	public function actionAdminSeason()
	{
		$model=new MyMovieSeason('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['MyMovieSeason']))
			$model->attributes=$_GET['MyMovieSeason'];
	
		$this->render('adminSeason',array(
				'model'=>$model,
		));
	}
	
	public function actionAdminEpisode()
	{
		$model=new MyMovieEpisode('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['MyMovieEpisode']))
			$model->attributes=$_GET['MyMovieEpisode'];
	
		$this->render('adminEpisode',array(
				'model'=>$model,
		));
	}
	
	public function actionUpdateBox($id)
	{
		$model = MyMovieNzb::model()->findByPk($id);
		$ddlParentalControl = ParentalControl::model()->findAll();
		$getPoster = false;
		$getBackdrop = false;
	
		if(isset($_POST['MyMovieNzb']))
		{
			if($_POST['MyMovieNzb']['poster_original'] != $model->poster_original)
				$getPoster = true;
				
			if($_POST['MyMovieNzb']['backdrop_original'] != $model->backdrop_original)
				$getBackdrop = true;
			
			$model->attributes = $_POST['MyMovieNzb'];
				
			if($getPoster)
				$model->poster = MyMovieHelper::getImage($model->poster_original, $model->Id);
			
			if($getBackdrop)
				$model->backdrop = MyMovieHelper::getImage($model->backdrop_original, $model->Id.'_bd');
			
			if($model->save())
			{
				foreach($model->myMovieDiscNzbs as $discs)
				{
					foreach($discs->nzbs as $nzb)
						$this->updateRelation($nzb->Id);
				}				
				$this->redirect(array('adminBox'));
			}
		}
	
		$this->render('updateBox',array(
							'model'=>$model,
							'ddlParentalControl'=>$ddlParentalControl,
		));
	}
	
	public function actionUpdateSerie($id)
	{
		$model = MyMovieSerieHeader::model()->findByPk($id);
		$getPoster = false;
		
		if(isset($_POST['MyMovieSerieHeader']))
		{
			if($_POST['MyMovieSerieHeader']['poster_original'] != $model->poster_original)
				$getPoster = true;
			
			$model->attributes = $_POST['MyMovieSerieHeader'];
			
			if($getPoster)
				$model->poster = MyMovieHelper::getImage($model->poster_original, $model->Id);
			
			if($model->save())
				$this->redirect(array('adminSerie'));
		}
		
		$this->render('updateSerie',array(
						'model'=>$model,
		));
	}
	
	public function actionUpdateSeason($id)
	{
		$model = MyMovieSeason::model()->findByPk($id);
		$getBanner = false;
		
		if(isset($_POST['MyMovieSeason']))
		{
			if($_POST['MyMovieSeason']['banner_original'] != $model->banner_original)
				$getBanner = true;
			
			$model->attributes = $_POST['MyMovieSeason'];
			
			if($getPoster)
				$model->banner = MyMovieHelper::getImage($model->banner_original, $model->Id);
			
			if($model->save())
				$this->redirect(array('adminSeason'));
		}
	
		$this->render('updateSeason',array(
							'model'=>$model,
		));
	}
	
	public function actionUpdateEpisode($id)
	{
		$model = MyMovieEpisode::model()->findByPk($id);
	
		if(isset($_POST['MyMovieEpisode']))
		{
			$model->attributes = $_POST['MyMovieEpisode'];
			if($model->save())
				$this->redirect(array('adminEpisode'));
		}
	
		$this->render('updateEpisode',array(
								'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Nzb::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='nzb-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}