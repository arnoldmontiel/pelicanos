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
		),
		),
		);
	}

	/**
	 * Returns new and updated movies
	 * @param integer idCustomer
	 * @return MovieResponse[]
	 * @soap
	 */
	public function getNewMovies($idCustomer)
	{
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_customer where Id_customer = '. $idCustomer.' and need_update = 0)');
		$criteria->addCondition('t.Id_imdbdata_tv is null');
		//$criteria->addCondition('t.deleted  <> 1');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();

		foreach ($arrayNbz as $modelNbz)
		{
			$movieResponse = new MovieResponse;
			$movieResponse->setAttributes($modelNbz);
			$arrayResponse[]=$movieResponse;
				
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
				$model = NzbCustomer::model()->findByAttributes(array('Id_customer'=>$item->id_customer, 'Id_nzb'=>$item->id_movie));
			
				if(isset($model))
				{
					$model->Id_movie_state = $item->id_state;
					switch ($item->id_state) {
						case 1:
							$model->date_sent = date("Y-m-d H:i:s",$item->date);
							break;
						case 2:
							$model->date_downloading = date("Y-m-d H:i:s",$item->date);
							$this->doTransaction($item->id_movie, $item->id_customer);
							break;
						case 3:
							$model->date_downloaded = date("Y-m-d H:i:s",$item->date);
							break;
					}
					$model->need_update = 0;
					$model->save();
				}
			}
			
			return true;
		} catch (Exception $e) {
			return false;
		}
		

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
								$this->doTransaction($item->id_serie_nzb, $item->id_customer);
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
			
			return true;
		} catch (Exception $e) {
			return false;
		}
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
		
		$criteria->addCondition('t.Id_customer = '. $idCustomer);
		$criteria->addCondition('t.Id_nzb is null ');
		
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

	public function actionViewEpisode($id)
	{
		$this->render('viewEpisode',array(
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
		$hola = $this->getNewSeries(1);
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
						$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
						$model->file_name = $file->getName();
							
						$this->saveFile($file, 'nzb', $file->getName());
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
		$modelImdb = new Imdbdata;
		$ddlRsrcType = ResourceType::model()->findAll();

		if(isset($_POST['Nzb']))
			$model->attributes = $_POST['Nzb'];

		if(isset($_POST['Upload']) && isset($_POST['Imdbdata']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$modelImdb->attributes=$_POST['Imdbdata'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
				
			if($modelUpload->validate() && $model->validate())
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($file != null)
					{
						$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
						$model->file_name = $file->getName();
							
						$this->saveFile($file, 'nzb', $file->getName());
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
					$model->Id_imdbdata = $modelImdb->ID;

					if($model->save()){
						$transaction->commit();
						$this->redirect(array('findSubtitle','id'=>$model->Id));
					}
						
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}


		$this->render('createMovie',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelImdb'=>$modelImdb,
			'ddlRsrcType'=>$ddlRsrcType,
		));
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
					$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
					$model->file_name = $file->getName();
					
					$this->saveFile($file, 'nzb', $file->getName());
					
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
		$modelImdb = Imdbdata::model()->findByPk($model->Id_imdbdata);
		$ddlRsrcType = ResourceType::model()->findAll();
		$hasChanged = false;

		if(isset($_POST['Nzb']))
		{
			if($_POST['Nzb']['Id_resource_type'] != $model->Id_resource_type )
				$hasChanged = true;

			if($_POST['Nzb']['points'] != $model->points )
				$hasChanged = true;
			
			$model->attributes = $_POST['Nzb'];
		}

		if(isset($_POST['Upload']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			if($file!=null)
			{
				if($modelUpload->validate())
				{
					$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
					$model->file_name = $file->getName();
					
					$this->saveFile($file, 'nzb', $file->getName());
					
					$this->saveUpdatedModel($model, $id);
				}
			}
			else
			{
				if($hasChanged)
					$this->saveUpdatedModel($model, $id);
				else
					$this->redirect(array('view','id'=>$model->Id));
			}
		}
		else
		{
			if($hasChanged)
				$this->saveUpdatedModel($model, $id);
		}

		$this->render('update',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelImdb'=>$modelImdb,
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

		$model->attributes = array('query'=>str_replace('.nzb','',$modelNzb->file_name));

		if($_POST['selectedRow'] != "")
		{
			$this->downloadSubtitle($_POST['selectedRow'], $id);
			$this->redirect(array(($modelNzb->Id_imdbdata != null) ? 'view' : 'viewEpisode','id'=>$id));
		}

		if($_POST['Subtitle'])
		{
			$model->attributes = $_POST['Subtitle'];
			try {
				$model->searchSubtitle();
			} catch (Exception $e) {
				throw new CHttpException('Searching Subtitle','Invalid request. The OpenSubtitle API is not working. Please '. CHtml::link('try again',Yii::app()->request->getUrl()) .'.');

			}
		}

		$modelOpenSubtitle = new OpenSubtitle('search');

		if($_GET['OpenSubtitle'])
		$modelOpenSubtitle->attributes = $_GET['OpenSubtitle'];


			
		$this->render('findSubtitle',array(
				'model'=>$model,
				'modelOpenSubtitle'=>$modelOpenSubtitle,
				'modelNzb'=>$modelNzb
		));
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
						
					$modelNzb->subt_url = Yii::app()->request->getBaseUrl(). '/subtitles/'.rawurlencode($subtFileName);
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
						$this->redirect(array(($modelNzb->Id_imdbdata != null ) ? 'view' : 'viewEpisode','id'=>$id));
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


		$nzb->subt_url = Yii::app()->request->getBaseUrl(). '/subtitles/'.rawurlencode($subtFileName);
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
		$dataProvider=new CActiveDataProvider('Nzb',array('criteria'=>array('order'=>'Id DESC','condition'=>'Id_imdbdata_tv is null')));
		$this->render('index',array(
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
