<?php

class DeviceController extends Controller
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
		$model = $this->loadModel($id);
		$modelClientSettings= $model->clientSettings[0];
		$modelSettingsRipper= $model->settingsRippers[0];
		
		$this->render('view',array(
			'model'=>$model,
			'modelClientSettings'=>$modelClientSettings,
			'modelSettingsRipper'=>$modelSettingsRipper,
		
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Device;
		$modelClientSettings=new ClientSettings;
		$modelSettingsRipper=new SettingsRipper;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Device']))
		{
			$model->attributes=$_POST['Device'];
			if($model->save())
			{
				$modelClientSettings->attributes = $_POST['ClientSettings'];
				$modelClientSettings->Id_device = $model->Id;
				$modelSettingsRipper->attributes=$_POST['SettingsRipper'];
				$modelSettingsRipper->Id_device = $model->Id;
				if($modelClientSettings->save()&&$modelSettingsRipper->save())
					$this->redirect(array('view','id'=>$model->Id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'modelClientSettings'=>$modelClientSettings,
			'modelSettingsRipper'=>$modelSettingsRipper,
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
		
		$modelClientSettings= $model->clientSettings[0];
		$modelSettingsRipper= $model->settingsRippers[0];
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Device']))
		{
			$model->attributes=$_POST['Device'];
			if($model->save())
			{
				$modelClientSettings->attributes=$_POST['ClientSettings'];
				$modelSettingsRipper->attributes=$_POST['SettingsRipper'];
				if($modelClientSettings->save()&&$modelSettingsRipper->save())				
					$this->redirect(array('view','id'=>$model->Id));
				
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelClientSettings'=>$modelClientSettings,
			'modelSettingsRipper'=>$modelSettingsRipper,
		
		));
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
		$modelCustomerDevice = new CustomerDevice('search');
		$modelCustomerDevice->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerDevice']))
			$modelCustomerDevice->attributes=$_GET['CustomerDevice'];
		
		$modelDeviceTunelGrid = new DeviceTunneling('search');
		$modelDeviceTunelGrid->unsetAttributes();  // clear any default values
		
		$idDevice = isset($_GET['idDevice'])?$_GET['idDevice']:'';
		if(isset($_GET['DeviceTunneling']))
			$modelDeviceTunelGrid->attributes=$_GET['DeviceTunneling'];
		
		$modelDeviceTunelGrid->Id_device = $idDevice;
		
		$this->render('index',array(
				'modelCustomerDevice'=>$modelCustomerDevice,
				'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
		));
	}

	public function actionIndexRe()
	{
		$modelCustomerDevice = new CustomerDevice('search');
		$modelCustomerDevice->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerDevice']))
			$modelCustomerDevice->attributes=$_GET['CustomerDevice'];
	
		$modelDeviceTunelGrid = new DeviceTunneling('search');
		$modelDeviceTunelGrid->unsetAttributes();  // clear any default values
	
		$idDevice = isset($_GET['idDevice'])?$_GET['idDevice']:'';
		if(isset($_GET['DeviceTunneling']))
			$modelDeviceTunelGrid->attributes=$_GET['DeviceTunneling'];
	
		$modelDeviceTunelGrid->Id_device = $idDevice;
	
		$this->render('indexRe',array(
				'modelCustomerDevice'=>$modelCustomerDevice,
				'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
		));
	}
	
	public function actionAjaxOpenViewDownload()
	{
		$idDevice = (isset($_POST['idDevice']))?$_POST['idDevice']:null;
		
		if(isset($idDevice))
		{
			$modalNzbDevices = NzbDevice::model()->findAllByAttributes(array('Id_device'=>$idDevice));
		
			$this->renderPartial('_modalViewDownload',array('modalNzbDevices'=>$modalNzbDevices, 'idDevice'=>$idDevice));
		}
	}
	
	public function actionAjaxOpenConfigPort()
	{
		$idDevice = isset($_POST['idDevice'])?$_POST['idDevice']:null;
		
		$modelDevice = Device::model()->findByPk($idDevice);
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id NOT IN (select Id_port from device_tunneling dt
										where Id_device = "'.$idDevice.'")');
		
		$modelPorts = Port::model()->findAll($criteria);
		$ddlPorts = array();
		foreach($modelPorts as $item)
			$ddlPorts[] = array('Id'=>$item->Id, 'description'=>$item->description); 
		
		echo json_encode(array('ddlPort'=>$ddlPorts, 'idDevice'=>$modelDevice->Id, 'description'=>$modelDevice->description));
	}
	
	public function actionAjaxAddPort()
	{
		$idDevice = isset($_POST['idDevice'])?$_POST['idDevice']:null;
		$idPort = isset($_POST['idPort'])?$_POST['idPort']:null;
		$externalPort = isset($_POST['externalPort'])?$_POST['externalPort']:null;
		
		$modelDeviceTunnel = new DeviceTunneling();
		$modelDeviceTunnel->Id_device = $idDevice;
		$modelDeviceTunnel->is_open = 1;
		$modelDeviceTunnel->Id_port = $idPort;
		$modelDeviceTunnel->external_port = $externalPort;
		$modelDeviceTunnel->save();
	}
	
	public function actionAjaxDoTunnel()
	{
		$idDevice = $_POST['idDevice'];
		$idPort = $_POST['idPort'];
		$open = $_POST['open'];
		if(isset($idDevice) && isset($idPort))
		{
			$model = DeviceTunneling::model()->findByAttributes(array(
					'Id_port'=>$idPort,
					'Id_device'=>$idDevice,
			));
				
			if(isset($model))
			{
				$model->is_open = $open;
				$model->is_validated = 0;
				$model->save();
			}
				
		}
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Device('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Device']))
			$model->attributes=$_GET['Device'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjaxGetPendingDeviceQty()
	{
		$qty = '';
		
		$qty = CustomerDevice::model()->countByAttributes(array('is_pending'=>1));
		
		echo $qty;	
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Device::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='device-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
