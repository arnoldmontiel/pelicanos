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
	
	public function actionAjaxCancelRequestedDevice()
	{
		$idDevice = isset($_POST['idDevice'])?$_POST['idDevice']:null;
		$idCustomer = isset($_POST['idCustomer'])?$_POST['idCustomer']:null;
		
		if(isset($idDevice) && isset($idCustomer))
		{
			$modelDevice = Device::model()->findByPk($idDevice);
			if(isset($modelDevice))
			{
				$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$idDevice,'Id_customer'=>$idCustomer));
				
				$transaction = $modelDevice->dbConnection->beginTransaction();
				try {
					$modelCustomerDevice->delete();
					$modelDevice->delete();
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
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
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionIndexRe()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];
	
		$this->render('indexRe',array(
				'model'=>$model,
		));
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
			
	
		$modelRelation=new NzbDevice('search');
		$modelRelation->unsetAttributes();
		
		if(isset($_GET['NzbDevice']))
			$modelRelation->attributes = $_GET['NzbDevice']; 
		
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
			
	
		$modelRelation=new NzbDevice('search');
		$modelRelation->unsetAttributes();
	
		if(isset($_GET['NzbDevice']))
			$modelRelation->attributes = $_GET['NzbDevice'];
	
		if(isset($_GET['Customer']))
			$modelRelation->Id_customer = $_GET['Customer']['Id'];
	
		$this->render('customerSeries',array(
								'model'=>$model,
								'ddlSource'=>$ddlSource,
								'modelRelation'=>$modelRelation,
		));
	
	}
	
	public function actionDeviceTunnel($idDevice, $idCustomer)
	{
		$modelDeviceTunnel = new DeviceTunneling();
		$modelDeviceTunnel->Id_device = $idDevice;				
		
		if(isset($_POST['DeviceTunneling']))
		{
			$modelDeviceTunnel->attributes = $_POST['DeviceTunneling'];
			$modelDeviceTunnel->is_open = 1;
			$modelDeviceTunnel->save();
		}
		
		$modelDeviceTunelGrid = new DeviceTunneling('search');
		$modelDeviceTunelGrid->unsetAttributes();  // clear any default values
		$modelDeviceTunelGrid->Id_device = $idDevice;
		
		if(isset($_GET['DeviceTunneling']))
			$modelDeviceTunelGrid->attributes=$_GET['DeviceTunneling'];
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id NOT IN (select Id_port from device_tunneling dt
										where Id_device = "'.$idDevice.'")');
		
		$ddlPort = CHtml::listData(Port::model()->findAll($criteria), 'Id', 'description' );
		
		$this->render('deviceTunnel',array(
										'modelDeviceTunnel'=>$modelDeviceTunnel,
										'ddlPort'=>$ddlPort,
										'idCustomer'=>$idCustomer,
										'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
		));
	}
	
	public function actionAjaxOpenForm()
	{
		$idCustomer = isset($_POST['idCustomer'])?$_POST['idCustomer']:null;
		
		if(isset($idCustomer))
		{
			if($idCustomer == '0')
			{
				$modelCustomer = new Customer();
				$modalCustomerUser = new CustomerUsers();
			}
			else
			{
				$modelCustomer = Customer::model()->findByPk($idCustomer);
				$modalCustomerUser = CustomerUsers::model()->findByAttributes(array('Id_customer'=>$idCustomer));
			}
			
			
			echo $this->renderPartial('_modalForm', array('modelCustomer'=>$modelCustomer, 'modalCustomerUser'=>$modalCustomerUser));
		}		
	}
	
	public function actionAjaxSaveCustomer()
	{
		$modelCustomer = new Customer();
		$modelCustomerUser = new CustomerUsers();
		
		if(isset($_POST['Customer']))
		{
			if(isset($_POST['Customer']['Id']))
			{
				$modelCustomer = Customer::model()->findByPk($_POST['Customer']['Id']);
				$modelCustomerUser = CustomerUsers::model()->findByAttributes(array('Id_customer'=>$modelCustomer->Id));
				
			}
			
			$modelCustomer->attributes = $_POST['Customer'];
			$modelCustomerUser->attributes = $_POST['CustomerUsers'];
			
			
			$modelUser = User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
			if(isset($modelUser))
				$modelCustomer->Id_reseller = $modelUser->Id_reseller;
			 
			$modelCustomer->save();
			
			$modelCustomerUser->Id_customer = $modelCustomer->Id;
			$modelCustomerUser->save();
		}
	}
	
	public function actionAjaxOpenRequestDevice()
	{
		$idCustomer = isset($_POST['idCustomer'])?$_POST['idCustomer']:null;
		
		if(isset($idCustomer))
		{
			$modelCustomer = Customer::model()->findByPk($idCustomer);
			
			$modelDevice = new Device();
			$modalCustomerUser = new CustomerUsers();
			$modalCustomerUser->Id_customer = $idCustomer;
			echo $this->renderPartial('_modalRequestDevice', array('modelCustomer'=>$modelCustomer, 'modelDevice'=>$modelDevice, 'modalCustomerUser'=>$modalCustomerUser));
		}
	}

	public function actionAjaxCheckUser()
	{
		$response = 0;
		$username = isset($_POST['username'])?$_POST['username']:'';
		
		if(!empty($username))
		{
				$response = 1;
		}
		echo $response;
	}
	
	public function actionAjaxSaveRequestDevice()
	{		
		
		if(isset($_POST['Device']) && isset($_POST['Customer']))
		{
			$idCustomer = isset($_POST['Customer']['Id'])?$_POST['Customer']['Id']:null;
			
			$modelDevice = new Device();
			$modelDevice->attributes = $_POST['Device'];
			
			$transaction = $modelDevice->dbConnection->beginTransaction();
			try {
				$modelDevice->Id = uniqid();
				$modelDevice->save();
				$modelDevice->refresh();
				
				$modelCustomerDevice = new CustomerDevice();
				$modelCustomerDevice->Id_device = $modelDevice->Id;
				$modelCustomerDevice->Id_customer = $idCustomer;
				$modelCustomerDevice->save();
				
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
			 
		}
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
