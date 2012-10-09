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
			                    'MovieResponse'=>'MovieResponse',  // or simply 'Post'
								'SerieResponse'=>'SerieResponse',  // or simply 'Post'
								'SeasonResponse'=>'SeasonResponse',
								'SerieStateRequest'=>'SerieStateRequest',
								'MovieStateRequest'=>'MovieStateRequest',
								'TransactionResponse'=>'TransactionResponse',
								'UserResponse'=>'UserResponse',
								'UserStateRequest'=>'UserStateRequest',
								'RippedRequest'=>'RippedRequest',
								'RippedResponse'=>'RippedResponse',
								'LogRequest'=>'LogRequest',
								'LogResponse'=>'LogResponse',
								'CustomerRequest'=>'CustomerRequest',
								'InstallDataResponse'=>'InstallDataResponse',
		),
		),
		);
	}
	
	/**
	* Get installation data
	* @param string username
	* @param string password
	* @return InstallDataResponse
	* @soap
	*/
	public function getInstallData($username, $password)
	{
		$model = User::model()->findByAttributes(array('username'=>$username, 'password'=>$password));
		$installDataResponse = null;
		if($model)
		{
			$installDataResponse = new InstallDataResponse();
			$installDataResponse->Id_reseller = $model->Id_reseller;
			$installDataResponse->Id_device = uniqid();
		}
	
		return $installDataResponse;
	}
	
	/**
	* Get ripped by customer (feedback to client)
	* @param integer idCustomer
	* @return RippedResponse[]
	* @soap
	*/
	public function getRipped($idCustomer)
	{
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.Id_customer = '. $idCustomer);
	
		$arrayRipped = RippedCustomer::model()->findAll($criteria);
		$arrayResponse = array();
	
		foreach ($arrayRipped as $model)
		{
			$rippedResponse = new RippedResponse();
			$rippedResponse->Id_my_movie = $model->Id_my_movie;
			$rippedResponse->Id_customer = $model->Id_customer;
			$arrayResponse[]=$rippedResponse;
		}
	
		return $arrayResponse;
	}
	
	/**
	* Get new users by customer
	* @param integer idCustomer
	* @return UserResponse[]
	* @soap
	*/
	public function getNewUser($idCustomer)
	{
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id_customer = '. $idCustomer.' and need_update = 1');
				
		$arrayCustomerUsers = CustomerUsers::model()->findAll($criteria);
		$arrayResponse = array();
		
		foreach ($arrayCustomerUsers as $model)
		{
			$userResponse = new UserResponse();
			$userResponse->setAttributes($model);
			$arrayResponse[]=$userResponse;
		}
		
		return $arrayResponse;
	}
	
	/**
	 * Returns new and updated movies
	 * @param string Id_device
	 * @return MovieResponse[]
	 * @soap
	 */
	public function getNewMovies($Id_device)
	{
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_customer where Id_device = "'. $Id_device.'" and need_update = 0)');
		$criteria->addCondition('t.is_draft = 0');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();

		foreach ($arrayNbz as $modelNbz)
		{
			$movieResponse = new MovieResponse;
			$movieResponse->setAttributes($modelNbz);
			$arrayResponse[]=$movieResponse;
				
			$nzbCustomerDB = NzbCustomer::model()->findByAttributes(array('Id_nzb'=>$modelNbz->Id, 'Id_device'=>$Id_device));
			if($nzbCustomerDB != null)
			{
				$nzbCustomerDB->need_update = 1;
				$nzbCustomerDB->save();
			}
			else
			{
				$modelNzbCustomer = new NzbCustomer;

				$modelNzbCustomer->attributes = array(
												'Id_nzb'=>$modelNbz->Id,
												'Id_device'=>$Id_device,
												'need_update'=> 1,
				);
				$modelNzbCustomer->save();
			}
		}

		return $arrayResponse;
	}

	
	/**
	* Returns new and updated series
	* @param integer idCustomer
	* @return SerieResponse[]
	* @soap
	*/
	public function getNewSeries($idCustomer)
	{
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_customer where Id_customer = '. $idCustomer.' and need_update = 0)');
		$criteria->addCondition('t.Id_imdbdata_tv is not null');
		//$criteria->addCondition('t.deleted  <> 1');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();
		
		
		//check if there are headers which need update
		$imdbdataTvCustomerDB = ImdbdataTvCustomer::model()->findAllByAttributes(array('need_update'=>1));
		foreach ($imdbdataTvCustomerDB as $item)
		{
			$imdbdataTv = ImdbdataTv::model()->findByPk($item->Id_imdbdata_tv);
			$serieResponse = new SerieResponse;
			$serieResponse->setHeaderAttributes($imdbdataTv);
			$serieResponse->setSeasons( Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$imdbdataTv->ID)));
			$arrayResponse[]=$serieResponse;
		}
		
		foreach ($arrayNbz as $modelNbz) //add Serie Header
		{
			$imdbdataTv = ImdbdataTv::model()->findByPk($modelNbz->imdbDataTv->Id_parent);
			if(!$this->findImdbID($imdbdataTv->ID, $arrayResponse)) // insert just once
			{
				$imdbdataTvCustomerDB = ImdbdataTvCustomer::model()->findByPk(array('Id_imdbdata_tv'=>$imdbdataTv->ID,'Id_customer'=>$idCustomer));
				if($imdbdataTvCustomerDB == null) //insert send Serie Header
				{
					$modelImdbCustomer = new ImdbdataTvCustomer;
					
					$modelImdbCustomer->attributes = array(
															'Id_imdbdata_tv'=>$imdbdataTv->ID,
															'Id_customer'=>$idCustomer,
															'need_update'=> 1,
					);
					$modelImdbCustomer->save();
					
					$serieResponse = new SerieResponse;
					$serieResponse->setHeaderAttributes($imdbdataTv);
					$serieResponse->setSeasons( Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$imdbdataTv->ID)));
					$arrayResponse[]=$serieResponse;
				}
				else 
				{
					if($imdbdataTvCustomerDB->need_update == 1)
					{
						$serieResponse = new SerieResponse;
						$serieResponse->setHeaderAttributes($imdbdataTv);
						$serieResponse->setSeasons( Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$imdbdataTv->ID)));
						$arrayResponse[]=$serieResponse;
					}
				}
			}
				
		}
		
		foreach ($arrayNbz as $modelNbz) //add episode (nzb)
		{
			
			$serieResponse = new SerieResponse;
			$serieResponse->setAttributes($modelNbz);
			$arrayResponse[]=$serieResponse;
	
			$nzbCustomerDB = NzbCustomer::model()->findByPk(array('Id_nzb'=>$modelNbz->Id, 'Id_customer'=>$idCustomer));
			if($nzbCustomerDB != null)
			{
				$nzbCustomerDB->need_update = 1;
				$nzbCustomerDB->save();
			}
			else
			{
				$modelNzbCustomer = new NzbCustomer;
	
				$modelNzbCustomer->attributes = array(
													'Id_nzb'=>$modelNbz->Id,
													'Id_customer'=>$idCustomer,
													'need_update'=> 1,
				);
				$modelNzbCustomer->save();
			}
		}
	
		return $arrayResponse;
	}
	
	/**
	*
	* Update customer
	* @param CustomerRequest
	* @return integer idCusomer
	* @soap
	*/
	public function updateCustomer($customerRequest )
	{
		$idCustomer = 0;
		try {
				
			$model = Customer::model()->findByPk($customerRequest->Id);
			if($model)
			{
				$model->name = $customerRequest->name;
				$model->last_name = $customerRequest->last_name;
				$model->address = $customerRequest->address;
				if($model->save())
				{
					$idCustomer = $model->Id;
				}
			}
				
		} catch (Exception $e) {
			return $idCustomer;
		}
		return $idCustomer;
	}
	
	/**
	*
	* Create customer
	* @param CustomerRequest
	* @return integer idCusomer
	* @soap
	*/
	public function setCustomer($customerRequest )
	{		
		$idCustomer = 0;
		try {
			
			$model = new Customer();
			$model->name = $customerRequest->name;
			$model->last_name = $customerRequest->last_name;
			$model->address = $customerRequest->address;
			$model->Id_reseller = $customerRequest->Id_reseller;
			
			if($model->save())
			{
				$idCustomer = $model->Id;
			}
	
			
		} catch (Exception $e) {
			return $idCustomer;
		}
		return $idCustomer;
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
				$rippedCustomerDB = RippedCustomer::model()->findByAttributes(array('Id_my_movie'=>$item->Id_my_movie)); 				
				if(isset($rippedCustomerDB))
				{
					$transaction = $rippedCustomerDB->dbConnection->beginTransaction();
					try {
						
						$rippedCustomerDB->delete();
						MyMovie::model()->deleteByPk($rippedCustomerDB->Id_my_movie);
						
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
					}
				}
				
				$modelMyMovie = new MyMovie();
				
				
				$transaction = $modelMyMovie->dbConnection->beginTransaction();
				try {
				
					$modelMyMovie->Id = $item->Id_my_movie;
					$modelMyMovie->type = $item->type;
					$modelMyMovie->bar_code = $item->bar_code;
					$modelMyMovie->country = $item->country;
					$modelMyMovie->local_title = $item->local_title;
					$modelMyMovie->original_title = $item->original_title;
					$modelMyMovie->sort_title = $item->sort_title;
					$modelMyMovie->aspect_ratio = $item->aspect_ratio;
					$modelMyMovie->video_standard = $item->video_standard;
					$modelMyMovie->production_year = $item->production_year;
					$modelMyMovie->release_date = $item->release_date;
					$modelMyMovie->running_time = $item->running_time;
					$modelMyMovie->description = $item->description;
					$modelMyMovie->extra_features = $item->extra_features;
					$modelMyMovie->parental_rating_desc = $item->parental_rating_desc;
					$modelMyMovie->imdb = $item->imdb;
					$modelMyMovie->rating = $item->rating;
					$modelMyMovie->data_changed = $item->data_changed;
					$modelMyMovie->covers_changed = $item->covers_changed;
					$modelMyMovie->genre = $item->genre;
					$modelMyMovie->studio =  $item->studio;				
					$modelMyMovie->poster_original =  $item->poster;
					$modelMyMovie->adult =  $item->adult;
					$modelMyMovie->Id_parental_control =  $item->Id_parental_control;
					
					$validator = new CUrlValidator();
					
					if($item->poster!='' && $validator->validateValue($item->poster))
					{
						try {
							$content = @file_get_contents($item->poster);
							if ($content !== false) {
								$file = fopen("./images/".$modelMyMovie->Id.".jpg", 'w');
								fwrite($file,$content);
								fclose($file);
								$modelMyMovie->poster = $modelMyMovie->Id.".jpg";
							} else {
								// an error happened
							}
						} catch (Exception $e) {
							throw $e;
							// an error happened
						}
					}
					
					$modelMyMovie->backdrop_original =  $item->backdrop;
						
					if($item->backdrop!='' && $validator->validateValue($item->backdrop))
					{
						try {
							$content = @file_get_contents($item->backdrop);
							if ($content !== false) {
								$file = fopen("./images/".$modelMyMovie->Id."_bd.jpg", 'w');
								fwrite($file,$content);
								fclose($file);
								$modelMyMovie->backdrop = $modelMyMovie->Id."_bd.jpg";
							} else {
								// an error happened
							}
						} catch (Exception $e) {
							throw $e;
							// an error happened
						}
					}
					
					$modelMyMovie->save();
					
					$modelRippedCustomer = new RippedCustomer();
					$modelRippedCustomer->Id_customer = $item->Id_customer;
					$modelRippedCustomer->Id_my_movie = $item->Id_my_movie;
					$modelRippedCustomer->ripped_date = $item->ripped_date;
					$modelRippedCustomer->save();
					
					$transaction->commit();
				} catch (Exception $e) {
					//Yii::trace('---------------------------------------------------------'. $e , 'webService');
					$transaction->rollback();
				}
			}
	
		} catch (Exception $e) {
			return false;
		}
		return true;
	
	}
	
	/**
	*
	* Change customerUser status in relation customer/user
	* @param UserStateRequest[]
	* @return boolean
	* @soap
	*/
	public function setUserState($userStateRequest )
	{
	
		try {
	
			foreach($userStateRequest as $item)
			{
				$model = CustomerUsers::model()->findByAttributes(array('username'=>$item->username, 'Id_customer'=>$item->Id_customer));
				if(isset($model))
				{
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
	 * Change movie status in relation customer/nzb
	 * @param MovieStateRequest[]
	 * @return boolean
	 * @soap
	 */
	public function setMovieState($movieStateRequest )
	{
		// 		Yii::trace('date param: '. $date, 'webService');
		// 		Yii::trace('idCustomer param: '. $idCustomer, 'webService');
		// 		Yii::trace('idMovie param: '. $idMovie, 'webService');
		// 		Yii::trace('idState param: '. $idState, 'webService');
		
		try {

			foreach($movieStateRequest as $item)
			{
				$model = NzbCustomer::model()->findByAttributes(array('Id_device'=>$item->Id_device, 'Id_nzb'=>$item->Id_nzb));
			
				if(isset($model))
				{
					$model->Id_movie_state = $item->Id_state;
					switch ($item->Id_state) {
						case 1:
							$model->date_sent = date("Y-m-d H:i:s",$item->date);
							break;
						case 2:
							$model->date_downloading = date("Y-m-d H:i:s",$item->date);
							//$this->doTransaction($item->Id_nzb, $item->Id_device);
							break;
						case 3:
							$model->date_downloaded = date("Y-m-d H:i:s",$item->date);
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
	* Change serie status in relation customer/serie
	* @param SerieStateRequest[]
	* @return boolean
	* @soap
	*/
	public function setSerieState($serieStateRequest )
	{
// 				Yii::trace('date param: '. $date, 'webService');
// 				Yii::trace('idCustomer param: '. $idCustomer, 'webService');
// 				Yii::trace('idMovie param: '. $idMovie, 'webService');
// 				Yii::trace('idState param: '. $idState, 'webService');
// 				foreach($serieStateRequest as $item)
// 		 		{
// 		 			Yii::trace('id_serie_nzb param: '. $item->id_serie_nzb, 'webService');
// 		 			Yii::trace('date param: '. $item->date, 'webService');
// 		 			Yii::trace('state param: '. $item->id_state, 'webService');
// 		 			Yii::trace('CUSTOMER param: '. $item->id_customer, 'webService');
// 		 			Yii::trace('id_imdbdata_tv param: '. $item->id_imdbdata_tv, 'webService');
// 		 			Yii::trace('---------------------------------------------------', 'webService');
// 		 		}
		try {
			foreach($serieStateRequest as $item)
			{
				if($item->id_serie_nzb != null) //is serie episode
				{
					$model = NzbCustomer::model()->findByAttributes(array('Id_customer'=>$item->id_customer, 'Id_nzb'=>$item->id_serie_nzb));
					if(isset($model))
					{
						$model->Id_movie_state = $item->id_state;
						switch ( $item->id_state) {
							case 1:
								$model->date_sent = date("Y-m-d H:i:s",$item->date);
								break;
							case 2:
								$model->date_downloading = date("Y-m-d H:i:s",$item->date);
								//$this->doTransaction($item->id_serie_nzb, $item->id_customer);
								break;
							case 3:
								$model->date_downloaded = date("Y-m-d H:i:s",$item->date);
							break;
						}
						
						$model->need_update = 0;
						$model->save();
					}
					
				}
				else //is serie header
				{
					$model = ImdbdataTvCustomer::model()->findByAttributes(array('Id_customer'=>$item->id_customer, 'Id_imdbdata_tv'=>$item->id_imdbdata_tv));
					if(isset($model))
					{
						$model->date_sent = date("Y-m-d H:i:s",$item->date);
						$model->need_update = 0;
						$model->save();
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

	public function actionViewReseller($id)
	{
		$this->render('viewReseller',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewEpisode($id)
	{
		$this->render('viewEpisode',array(
				'model'=>$this->loadModel($id),
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

	public function actionCreateEpisode()
	{
		$model=new Nzb;
		$modelUpload=new Upload;
		$modelImdb = new ImdbdataTv;
		$ddlRsrcType = ResourceType::model()->findAll();
		$ddlTvShow = ImdbdataTv::model()->findAllByAttributes(array('Id_parent'=>null));
		$ddlSeason = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$ddlTvShow[0]->ID));
		$index = 1;
		$ddlEpisode = array();
		while ($index <= $ddlSeason[0]->episodes) {
			$item['episode'] = $index;
			$ddlEpisode[$index] = $item;
			$index = $index + 1;
		}

		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];

		if(isset($_POST['Upload']) && isset($_POST['ImdbdataTv']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$modelImdb->attributes=$_POST['ImdbdataTv'];
			$file=CUploadedFile::getInstance($modelUpload,'file');

			if($modelUpload->validate() && $model->validate())
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($file != null)
					{	
						$uniqueId = uniqid();
						$fileName = $uniqueId . '.nzb';
						
						$model->url = '/nzb/'.$fileName;
						$model->file_name = $fileName;
						
						$model->file_original_name = $file->getName();
						
						$this->saveFile($file, 'nzb', $fileName);
					}


					$validator = new CUrlValidator();
					if($modelImdb->Poster!='' && $validator->validateValue($modelImdb->Poster))
					{
						$content = file_get_contents($modelImdb->Poster);
						if ($content !== false) {
							$file = fopen("./images/".$modelImdb->ID.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelImdb->Poster_local = $modelImdb->ID.".jpg";
						} else {
							// an error happened
						}
					}
					$modelImdb->save();
					$model->Id_imdbdata_tv = $modelImdb->ID;

					if($model->save()){
						$transaction->commit();
						//$this->redirect(array('view','id'=>$model->Id));
						$this->redirect(array('findSubtitle','id'=>$model->Id));
					}

				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}

		$this->render('createEpisode',array(
					'model'=>$model,
					'modelUpload'=>$modelUpload,
					'modelImdb'=>$modelImdb,
					'ddlRsrcType'=>$ddlRsrcType,
					'ddlTvShow'=>$ddlTvShow,
					'ddlSeason'=>$ddlSeason,
					'ddlEpisode'=>$ddlEpisode,
		));
	}

	public function actionAjaxPublishNzb()
	{
		$id = $_POST['nzbId'];
		if($id)
		{
			$model=$this->loadModel($id);
			$model->is_draft = 0;
			$model->save();
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
		$modelUpload=new Upload;
		$modelSearchDiscRequest = new SearchDiscRequest;
		
		$ddlRsrcType = ResourceType::model()->findAll();

		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];

		if(isset($_POST['Upload']) && isset($_POST['hiddenTitleId']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$titleId = $_POST['hiddenTitleId'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
				
			if($modelUpload->validate() && !empty($titleId))
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($file != null)
					{
						$uniqueId = uniqid();
						$fileName = $uniqueId . '.nzb'; 
						
						$model->url = '/nzb/'.$fileName;
						$model->file_name = $fileName;
						
						$model->file_original_name = $file->getName();
						
						$this->saveFile($file, 'nzb', $fileName);
					}
						
					$myMovie = new MyMoviesAPI();
					$modelMyMovieMovie = $myMovie->LoadDiscTitleById($titleId, true);
					$modelMyMovieMovie->save();
					
					$model->Id_my_movie_movie = $modelMyMovieMovie->Id;
					 
					if($model->save()){
						$transaction->commit();
						$this->redirect(array('findSubtitle','id'=>$model->Id));
					}
						
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}

		$rawData = array();
		
		if(isset($_GET['SearchDiscRequest']))
		{
			$modelSearchDiscRequest->setAttributes($_GET['SearchDiscRequest']);
			$myMovie = new MyMoviesAPI();
			$rawData = $myMovie->SearchDiscTitleByTitle($modelSearchDiscRequest);
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
			'modelUpload'=>$modelUpload,
			'ddlRsrcType'=>$ddlRsrcType,
			'arrayDataProvider'=>$arrayDataProvider,
			'modelSearchDiscRequest'=>$modelSearchDiscRequest,
		));
	}

	public function actionAjaxGetMovieMoreInfo()
	{
		$titleId = isset($_POST['titleId'])?$_POST['titleId']:null;
		
		if(isset($titleId))
		{
			$myMovie = new MyMoviesAPI();
			$model = $myMovie->LoadDiscTitleById($titleId);
		
			echo $this->renderPartial('_viewInfo', array(
														'model'=>$model,));
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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateEpisode($id)
	{
		$model=$this->loadModel($id);
		$modelUpload=new Upload;
		$modelImdb = ImdbdataTv::model()->findByPk($model->Id_imdbdata_tv);
		$ddlRsrcType = ResourceType::model()->findAll();
		$ddlTvShow = ImdbdataTv::model()->findAllByAttributes(array('Id_parent'=>null));
		$ddlSeason = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$modelImdb->Id_parent));
		$hasChanged = false;
		
		$index = 1;
		$ddlEpisode = array();

		while ($index <= $ddlSeason[$modelImdb->Season -1]->episodes) {
			$item['episode'] = $index;
			$ddlEpisode[$index] = $item;
			$index = $index + 1;
		}

		if(isset($_POST['Nzb']))
		{
			if($_POST['Nzb']['Id_resource_type'] != $model->Id_resource_type )
				$hasChanged = true;

			if($_POST['Nzb']['points'] != $model->points )
				$hasChanged = true;
			
			$model->attributes = $_POST['Nzb'];
		}

		if(isset($_POST['ImdbdataTv']))
		{
			if($_POST['ImdbdataTv']['Id_parent'] != $modelImdb->Id_parent )
				$hasChanged = true;
			
			if($_POST['ImdbdataTv']['Season'] != $modelImdb->Season )
				$hasChanged = true;
			
			if($_POST['ImdbdataTv']['Episode'] != $modelImdb->Episode )
				$hasChanged = true;
			
			$modelImdb->attributes=$_POST['ImdbdataTv'];
		}
		
		if(isset($_POST['Upload']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			if($file!=null)
			{
				if($modelUpload->validate())
				{
					
					$uniqueId = uniqid();
					$fileName = $uniqueId . '.nzb';
					
					$model->url = '/nzb/'.$fileName;
					$model->file_name = $fileName;
					
					$model->file_original_name = $file->getName();
					
					$this->saveFile($file, 'nzb', $fileName);
					
					
					$this->saveUpdatedEpisodeModel($model, $modelImdb, $id);
				}
			}
			else
			{
				if($hasChanged)
					$this->saveUpdatedEpisodeModel($model, $modelImdb, $id);
				else
					$this->redirect(array('viewEpisode','id'=>$model->Id));
			}
		}
		else
		{
			if($hasChanged)
				$this->saveUpdatedEpisodeModel($model, $modelImdb, $id);
		}

		$this->render('updateEpisode',array(
					'model'=>$model,
					'modelUpload'=>$modelUpload,
					'modelImdb'=>$modelImdb,
					'ddlRsrcType'=>$ddlRsrcType,
					'ddlTvShow'=>$ddlTvShow,
					'ddlSeason'=>$ddlSeason,
					'ddlEpisode'=>$ddlEpisode,
		));
	}

	private function saveUpdatedEpisodeModel($model, $modelImdb, $id)
	{
		$transaction = $model->dbConnection->beginTransaction();
		try {
			$modelImdb->save();
			if($model->save()){
				$this->updateRelation($id);
				$transaction->commit();
				$this->redirect(array('viewEpisode','id'=>$model->Id));
			}
				
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelUpload=new Upload;
		$modelMyMovieMovie = MyMovieMovie::model()->findByPk($model->Id_my_movie_movie);
		$ddlRsrcType = ResourceType::model()->findAll();
		$hasChanged = false;

		if(isset($_POST['Nzb']))
		{
			if($_POST['Nzb']['Id_resource_type'] != $model->Id_resource_type )
				$hasChanged = true;

			if($_POST['Nzb']['points'] != $model->points )
				$hasChanged = true;
			
			if($_POST['Nzb']['is_draft'] != $model->is_draft )
				$hasChanged = true;
			
			$model->attributes = $_POST['Nzb'];
		}

		if(isset($_POST['MyMovieMovie']))
		{
			if($_POST['MyMovieMovie']['description'] != $modelMyMovieMovie->description )
				$hasChanged = true;
		
			if($_POST['MyMovieMovie']['genre'] != $modelMyMovieMovie->genre )
				$hasChanged = true;
				
			if($_POST['MyMovieMovie']['studio'] != $modelMyMovieMovie->studio )
				$hasChanged = true;
			
			$modelMyMovieMovie->attributes = $_POST['MyMovieMovie'];
		}
		
		if(isset($_POST['Upload']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			if($file!=null)
			{
				if($modelUpload->validate())
				{
					$uniqueId = uniqid();
					$fileName = $uniqueId . '.nzb'; 
					
					$model->url = '/nzb/'.$fileName;
					$model->file_name = $fileName;
					
					$model->file_original_name = $file->getName();
					
					$this->saveFile($file, 'nzb', $fileName);
					
					$modelMyMovieMovie->save();
					$this->saveUpdatedModel($model, $id);
				}
			}
			else
			{
				if($hasChanged){
					$modelMyMovieMovie->save();
					$this->saveUpdatedModel($model, $id);
				}
				else
					$this->redirect(array('view','id'=>$model->Id));
			}
		}
		else
		{
			if($hasChanged){
				$modelMyMovieMovie->save();
				$this->saveUpdatedModel($model, $id);
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelMyMovieMovie'=>$modelMyMovieMovie,
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
		$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$id));
		
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
		$model = new Subtitle('search');
		$modelNzb = Nzb::model()->findByPk($id);

		$model->attributes = array('query'=>str_replace('.nzb','',$modelNzb->file_original_name));

		if($_POST['selectedRow'] != "")
		{
			$this->downloadSubtitle($_POST['selectedRow'], $id);
			$this->redirect(array('view','id'=>$id));
		}

		$modelOpenSubtitle = new OpenSubtitle('search');
		$modelOpenSubtitle->unsetAttributes();
		
		if($_GET['OpenSubtitle'])
		{
			$modelOpenSubtitle->attributes = $_GET['OpenSubtitle'];
		}
		
			
		$this->render('findSubtitle',array(
				'model'=>$model,
				'modelOpenSubtitle'=>$modelOpenSubtitle,
				'modelNzb'=>$modelNzb
		));
	}

	public function actionAjaxDoSearchSubtitle()
	{
		$model = new Subtitle('search');
		
		if($_POST['Subtitle'] )
		{
			
			$model->attributes = $_POST['Subtitle'];
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
				$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$id));

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
			$zip = Subtitle::downloadSubtitle($openSubtitle->IDSubtitleFile);
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
				
			$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$idNzb));
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


	public function actionBackdrop($id)
	{
		$model = Nzb::model()->findByPk($id);
		if(isset($_POST['img']))
		{
			$imdb = Imdbdata::model()->findByPk($model->Id_imdbdata);
			if($imdb != null)
			{
				$imdb->Backdrop = $_POST['img'];

				$transaction = $imdb->dbConnection->beginTransaction();
				try {
					if($imdb->save())
					{
						$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$id));
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

		$this->render('backdrop',array(
				'idImdb'=>$model->Id_imdbdata,
				'id'=>$id
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Nzb',array('criteria'=>array('order'=>'Id DESC')));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionIndexReseller()
	{
		$dataProvider=new CActiveDataProvider('Nzb',array('criteria'=>array('order'=>'Id DESC')));
		$this->render('indexReseller',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndexEpisode()
	{
		$dataProvider=new CActiveDataProvider('Nzb',array('criteria'=>array('order'=>'Id DESC','condition'=>'Id_imdbdata is null')));
		$this->render('indexEpisode',array(
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

	public function actionAdminEpisode()
	{
		$model=new Nzb('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Nzb']))
			$model->attributes=$_GET['Nzb'];
	
		$this->render('adminEpisode',array(
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
