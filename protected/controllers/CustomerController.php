<?php

class CustomerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
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
		$modelCustDev = new CustomerDevice('search');
		$modelCustDev->unsetAttributes();
		$modelCustDev->Id_customer = $id;
		
		$modelCustUsers = new CustomerUsers('search');
		$modelCustUsers->unsetAttributes();
		$modelCustUsers->Id_customer = $id;
		
		if(isset($_GET['CustomerUsers']))
			$modelCustUsers->attributes=$_GET['CustomerUsers'];
		
		if(isset($_GET['CustomerDevice']))
			$modelCustDev->attributes=$_GET['CustomerDevice'];
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelCustUsr'=>$modelCustUsers,
			'modelCustDev'=>$modelCustDev,
		));
	}
	
	public function actionAjaxSaveDevice()
	{
		$model = new Device();
		$transaction = $model->dbConnection->beginTransaction();
		try {
		
			if(isset($_POST['Device']) && isset($_POST['idCustomer']))
			{
				$model->attributes = $_POST['Device'];
				$model->Id = uniqid();
				if($model->save())
				{
					$modelRel = new CustomerDevice();
					$modelRel->Id_customer = (int)$_POST['idCustomer'];
					$modelRel->Id_device = $model->Id;
					$modelRel->save();

					$modelClientSettings = new ClientSettings();
					
					$modelClientSettings->Id_device = $model->Id;
					$modelClientSettings->Id_customer = $modelRel->Id_customer;
					$modelClientSettings->save();
					$transaction->commit();
					
					$modelSettingsRipper = new SettingsRipper();
						
					$modelSettingsRipper->Id_device = $model->Id;
					$modelSettingsRipper->save();
					
					$transaction->commit();
						
				}
			}
		}catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	public function actionAjaxRemoveCustomerDevice()
	{
		$idDevice = $_GET['idDevice'];
		$idCustomer = $_GET['idCustomer'];

		if(isset($idDevice) && isset($idCustomer))
		{
			$model = CustomerDevice::model()->findByAttributes(array(
												'Id_customer'=>$idCustomer,
												'Id_device'=>$idDevice,
				));
			if(isset($model))
				$model->delete();
			
			
			
		}
	}
	
	public function actionViewRipped($id)
	{
	
		$model = MyMovie::model()->findByPk($id);
		
		$criteria=new CDbCriteria;
	
		$criteria->join =	"LEFT OUTER JOIN ripped_customer rc ON rc.Id_device=t.Id_device
								LEFT OUTER JOIN my_movie_disc md on md.Id = rc.Id_my_movie_disc";
		$criteria->addCondition('md.Id_my_movie = "'. $id.'"');
		
		$modelCustomerDevice = CustomerDevice::model()->find($criteria);
		
		$idCustomer = (isset($modelCustomerDevice))?$modelCustomerDevice->Id_customer:0;
	
		$this->render('viewRipped',array(
				'model'=>$model,
				'idCustomer'=>$idCustomer,
		));
	}
	
	public function actionViewSummaryRipped($id)
	{
	
		$model = MyMovieDisc::model()->findByPk($id);
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	"LEFT OUTER JOIN ripped_customer rc ON rc.Id_device=t.Id_device";
		$criteria->addCondition('rc.Id_my_movie_disc = "'. $id.'"');
		
		$modelCustomerDevice = CustomerDevice::model()->find($criteria);
		
		$idCustomer = (isset($modelCustomerDevice))?$modelCustomerDevice->Id_customer:0;
		
		$this->render('viewSummaryRipped',array(
					'model'=>$model,
					'idCustomer'=>$idCustomer,
		));
	}
	
	public function actionSummaryNzb($id)
	{
	 
		$model=new NzbDevice('search');
		$model->unsetAttributes();  // clear any default values
		$model->Id_customer = $id;
		if(isset($_GET['NzbDevice']))
			$model->attributes=$_GET['NzbDevice'];
		
		$this->render('summaryNzb',array(
							'model'=>$model,
		));
		
	}
	
	public function actionIndexRipped($id)
	{
	
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.Id_device IN (select Id_device from customer_device where Id_customer = '.$id.')');
		
		$dataProvider=new CActiveDataProvider('RippedCustomer', array(
								'criteria'=>$criteria,
		));
		
		$this->render('indexRipped',array(
					'model'=>$this->loadModel($id),
					'dataProvider'=>$dataProvider,
		));
	}

	public function actionSummaryRipped($id)
	{
	
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.Id_device IN (select Id_device from customer_device where Id_customer = '.$id.')');
	
		$dataProvider=new CActiveDataProvider('RippedCustomer', array(
									'criteria'=>$criteria,
		));
	
		$this->render('summaryRipped',array(
						'model'=>$this->loadModel($id),
						'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Customer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			$model->Id_reseller = User::getResellerId();
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if($model->save())
			{
				$this->updateDevice($model);
				$this->redirect(array('view','id'=>$model->Id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	private function updateDevice($model)
	{
		$array = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$model->Id));
		foreach($array as $item)
		{
			$item->need_update = 1;
			$item->save();
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Customer('search');
		//$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$model->search(),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSummary()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];
	
		$this->render('summary',array(
				'model'=>$model,
		));
	}
	
	public function actionAjaxDoTransaction()
	{
		$pointsQty = $_POST['pointsQty'];
		$pointsDesc = $_POST['pointsDesc'];
		$transType = (int)$_POST['rbnTransType'];
		$idCustomer = $_POST['Customer']['Id'];
		
		$currentPoints = 0;
		$modelTransaction = new CustomerTransaction;
		$modelTransaction->attributes = array('Id_customer'=>$idCustomer,
												'points'=>$pointsQty,
												'description'=>$pointsDesc,
												'Id_transaction_type'=>$transType);
		
		if($transType == 1) //Debit
		{
			$currentPoints = $this->removeCredit($modelTransaction);
		}
		else //Credit 
		{
			$currentPoints = $this->addCredit($modelTransaction);
		}
		
		echo $currentPoints;
	}
	
	private function addCredit($modelTransaction)
	{
		
		$transaction = $modelTransaction->dbConnection->beginTransaction();
		try {
			
			//save customer credit transaction		
			$modelTransaction->save();
			
			//customer points increment
			$model = Customer::model()->findByPk($modelTransaction->Id_customer);
			$model->current_points = $model->current_points + $modelTransaction->points;
			$model->save();
			
			$transaction->commit();
			return $model->current_points;
		} catch (Exception $e) {
			$transaction->rollback();
		}
		
		
	}
	
	private function removeCredit($modelTransaction)
	{
	
		$transaction = $modelTransaction->dbConnection->beginTransaction();
		try {
				
			//save customer credit transaction
			$modelTransaction->save();
				
			//customer points decrement
			$model = Customer::model()->findByPk($modelTransaction->Id_customer);
			$model->current_points = $model->current_points - $modelTransaction->points;
			$model->save();
				
			$transaction->commit();
			return $model->current_points;
		} catch (Exception $e) {
			$transaction->rollback();
		}
	
	
	}
	
	public function actionCustomerPoints()
	{
		$ddlSource = Customer::model()->findAll();
		$model = Customer::model();
			
	
		$modelRelation = new CustomerTransaction('search');
		$modelRelation->unsetAttributes();
	
		if(isset($_GET['CustomerTransaction']))
			$modelRelation->attributes = $_GET['CustomerTransaction'];
	
		if(isset($_GET['Customer']))
			$modelRelation->Id_customer = $_GET['Customer']['Id'];
	
		$this->render('customerPoints',array(
								'model'=>$model,
								'ddlSource'=>$ddlSource,
								'modelRelation'=>$modelRelation,
		));
	
	}
	
	public function actionAjaxGetCurrentPoints()
	{
		$idCustomer = $_POST['idCustomer'];
		$model = Customer::model()->findByPk($idCustomer);
		echo $model->current_points; 
	}
	
	public function actionCustomerTransaction()
	{
		$ddlSource = Customer::model()->findAll();
		$model = Customer::model();
			
	
		$modelRelation = new CustomerTransaction('search');
		$modelRelation->unsetAttributes();
	
		if(isset($_GET['CustomerTransaction']))
			$modelRelation->attributes = $_GET['CustomerTransaction'];
	
		if(isset($_GET['Customer']))
			$modelRelation->Id_customer = $_GET['Customer']['Id'];
	
		$this->render('customerTransaction',array(
									'model'=>$model,
									'ddlSource'=>$ddlSource,
									'modelRelation'=>$modelRelation,
		));
	
	}
	
	public function actionCustomerMovies()
	{
		$ddlSource = Customer::model()->findAll();
		$model = Customer::model();
			
	
		$modelRelation=new NzbCustomer('search');
		$modelRelation->unsetAttributes();
		
		if(isset($_GET['NzbCustomer']))
			$modelRelation->attributes = $_GET['NzbCustomer']; 
		
		if(isset($_GET['Customer']))
			$modelRelation->Id_customer = $_GET['Customer']['Id'];
		
		$this->render('customerMovies',array(
							'model'=>$model,
							'ddlSource'=>$ddlSource,
							'modelRelation'=>$modelRelation,
		));
	
	}
	
	public function actionCustomerSeries()
	{
		$ddlSource = Customer::model()->findAll();
		$model = Customer::model();
			
	
		$modelRelation=new NzbCustomer('search');
		$modelRelation->unsetAttributes();
	
		if(isset($_GET['NzbCustomer']))
			$modelRelation->attributes = $_GET['NzbCustomer'];
	
		if(isset($_GET['Customer']))
			$modelRelation->Id_customer = $_GET['Customer']['Id'];
	
		$this->render('customerSeries',array(
								'model'=>$model,
								'ddlSource'=>$ddlSource,
								'modelRelation'=>$modelRelation,
		));
	
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Customer::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
