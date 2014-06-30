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
		
		$modelNzbDevice = new NzbDevice('search');
		$modelNzbDevice->unsetAttributes();  // clear any default values
		if(isset($_GET['NzbDevice']))
			$modelNzbDevice->attributes=$_GET['NzbDevice'];
		
		$modelDeviceTunelGrid = new DeviceTunneling('search');
		$modelDeviceTunelGrid->unsetAttributes();  // clear any default values
		
		$idDevice = isset($_GET['idDevice'])?$_GET['idDevice']:'';
		if(isset($_GET['DeviceTunneling']))
			$modelDeviceTunelGrid->attributes=$_GET['DeviceTunneling'];
		
		$modelDeviceTunelGrid->Id_device = $idDevice;
		$modelNzbDevice->Id_device = $idDevice;
		
		$modelSabNzbdConfigs = new SabnzbdConfig('search');
		$modelSabNzbdConfigs->unsetAttributes();
		
		$modelSabNzbdConfigs->Id_device = $idDevice;
		
		$modelPlayerConfigs = new DevicePlayer('search');
		$modelPlayerConfigs->unsetAttributes();
		
		$modelPlayerConfigs->Id_device = $idDevice;
		
		$this->render('index',array(
				'modelCustomerDevice'=>$modelCustomerDevice,
				'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
				'modelNzbDevice'=>$modelNzbDevice,
				'modelSabNzbdConfigs'=>$modelSabNzbdConfigs,
				'modelPlayerConfigs'=>$modelPlayerConfigs,
		));
	}

	public function actionIndexRe()
	{
		$modelCustomerDevice = new CustomerDevice('search');
		$modelCustomerDevice->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerDevice']))
			$modelCustomerDevice->attributes=$_GET['CustomerDevice'];
	
		$modelNzbDevice = new NzbDevice('search');
		$modelNzbDevice->unsetAttributes();  // clear any default values
		if(isset($_GET['NzbDevice']))
			$modelNzbDevice->attributes=$_GET['NzbDevice'];
		
		$modelDeviceTunelGrid = new DeviceTunneling('search');
		$modelDeviceTunelGrid->unsetAttributes();  // clear any default values
	
		$idDevice = isset($_GET['idDevice'])?$_GET['idDevice']:'';
		if(isset($_GET['DeviceTunneling']))
			$modelDeviceTunelGrid->attributes=$_GET['DeviceTunneling'];
	
		$modelDeviceTunelGrid->Id_device = $idDevice;
		$modelNzbDevice->Id_device = $idDevice;
		
		$criteria=new CDbCriteria;
		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)';
		$criteria->addCondition('t.is_pending = 1');
		$criteria->addCondition('c.Id_reseller = '.User::getResellerId());
		
		$modelPlayerConfigs = new DevicePlayer('search');
		$modelPlayerConfigs->unsetAttributes();
		
		$modelPlayerConfigs->Id_device = $idDevice;
		
		$this->render('indexRe',array(
				'modelCustomerDevice'=>$modelCustomerDevice,
				'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
				'modelNzbDevice'=>$modelNzbDevice,
				'qtyPending'=>CustomerDevice::model()->count($criteria),
				'modelPlayerConfigs'=>$modelPlayerConfigs,
		));
	}
	
	public function actionAjaxAddSabnzbdAccount()
	{
		$model = new SabnzbdConfig();
		$model->attributes = $_POST['SabnzbdConfig'];
		$model->name = $model->server_name;
		$model->host = $model->server_name;
		if($model->save())
		{
			$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$model->Id_device));
			if(isset($modelCustomerDevice))
			{
				$modelCustomerDevice->need_update = 1;
				$modelCustomerDevice->save();
			}
		}
	}
	
	public function actionAjaxAddNewPlayer()
	{
		$model = new DevicePlayer();
		$model->attributes = $_POST['DevicePlayer'];
		if($model->save())
		{
			$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$model->Id_device));
			if(isset($modelCustomerDevice))
			{
				$modelCustomerDevice->need_update = 1;
				$modelCustomerDevice->save();
			}
		}
	}
	
	public function actionAjaxRemovePlayer()
	{
		$idPlayer = isset($_POST['idPlayer'])?$_POST['idPlayer']:null;
		
		if(isset($idPlayer))
		{
			$model = DevicePlayer::model()->findByPk($idPlayer);
			if(isset($model))
			{
				$idDevice = $model->Id_device;
				if($model->delete())
				{
					$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$idDevice));
					if(isset($modelCustomerDevice))
					{
						$modelCustomerDevice->need_update = 1;
						$modelCustomerDevice->save();
					}
				}
			}
			
		}
	}
	
	public function actionAjaxUpdateSabnzbdAccount()
	{
		$idSabnzbdConfig = isset($_POST['idAccount'])?$_POST['idAccount']:null;
		
		if(isset($idSabnzbdConfig))
		{
			$modelSabmzbdConfig = SabnzbdConfig::model()->findByPk($idSabnzbdConfig);
			if(isset($modelSabmzbdConfig))
			{
				$modelSabmzbdConfig->connections = $_POST['connections_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->fill_server = $_POST['fill_server_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->password = $_POST['password_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->port = $_POST['port_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->retention = $_POST['retention_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->server_name = $_POST['server_name_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->name = $_POST['server_name_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->host = $_POST['server_name_'.$idSabnzbdConfig];				
				$modelSabmzbdConfig->timeout = $_POST['timeout_'.$idSabnzbdConfig];
				$modelSabmzbdConfig->username = $_POST['username_'.$idSabnzbdConfig];
				
				if(isset($_POST['ssl_'.$idSabnzbdConfig]))
				{
					if($_POST['ssl_'.$idSabnzbdConfig] == 'on')
						$modelSabmzbdConfig->ssl = 1;
					else
						$modelSabmzbdConfig->ssl = 0;
				}
				
				if(isset($_POST['optional_'.$idSabnzbdConfig]))
				{
					if($_POST['optional_'.$idSabnzbdConfig] == 'on')
						$modelSabmzbdConfig->optional = 1;
					else
						$modelSabmzbdConfig->optional = 0;
				}
				
				if(isset($_POST['enable_'.$idSabnzbdConfig]))
				{
					if($_POST['enable_'.$idSabnzbdConfig] == 'on')
						$modelSabmzbdConfig->enable = 1;
					else
						$modelSabmzbdConfig->enable = 0;
				}
				
				if($modelSabmzbdConfig->save())
				{
					$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$modelSabmzbdConfig->Id_device));
					if(isset($modelCustomerDevice))
					{
						$modelCustomerDevice->need_update = 1;
						$modelCustomerDevice->save();
					}
				}
			}
		}
		 	
	}
	
	public function actionAjaxUpdatePlayerConfig()
	{
		$idPlayer = isset($_POST['idPlayer'])?$_POST['idPlayer']:null;
		
		if(isset($idPlayer))
		{
			$modelDevicePlayer = DevicePlayer::model()->findByPk($idPlayer);
			if(isset($modelDevicePlayer))
			{
				$modelDevicePlayer->description = $_POST['description_'.$idPlayer];
				$modelDevicePlayer->url = $_POST['url_'.$idPlayer];
				$modelDevicePlayer->type = $_POST['type_'.$idPlayer];
				$modelDevicePlayer->file_protocol = $_POST['file_protocol_'.$idPlayer];
				
				if($modelDevicePlayer->save())
				{
					$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$modelDevicePlayer->Id_device));
					if(isset($modelCustomerDevice))
					{
						$modelCustomerDevice->need_update = 1;
						$modelCustomerDevice->save();
					}
				}
			}
		}
		
	}
	
	public function actionIndexIns()
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
	
		$modelPlayerConfigs = new DevicePlayer('search');
		$modelPlayerConfigs->unsetAttributes();
		
		$modelPlayerConfigs->Id_device = $idDevice;
	
		$this->render('indexIns',array(
				'modelCustomerDevice'=>$modelCustomerDevice,
				'modelDeviceTunelGrid'=>$modelDeviceTunelGrid,
				'modelPlayerConfigs'=>$modelPlayerConfigs,
		));
	}
	
	public function actionAjaxGetAlerts()
	{
		$criteria=new CDbCriteria;
		
		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)
							INNER JOIN reseller r on (c.Id_reseller = r.Id)
							INNER JOIN device d on (d.Id = t.Id_device)
							INNER JOIN client_settings cs on (d.Id = cs.Id_device)
							INNER JOIN setting s';
		
		$criteria->addCondition('t.is_pending = 0');
		$criteria->addCondition('cs.ip_v4 is not null');
		if(!User::isAdmin())
			$criteria->addCondition('c.Id_reseller = '.User::getResellerId());
		
		$criteria->addCondition('(
									(cs.last_update < DATE_SUB(NOW(), interval 30 Minute))
									OR
									( (cs.disc_total_space - cs.disc_used_space)*100/cs.disc_total_space <= s.disc_minimum_warning)
								)');
		echo CustomerDevice::model()->count($criteria);
	}
	
	public function actionAjaxOpenViewDownload()
	{
		$idDevice = (isset($_POST['idDevice']))?$_POST['idDevice']:null;
		
		if(isset($idDevice))
		{
			$modelDevice = Device::model()->findByPk($idDevice);
			$downloadedQty = NzbDevice::model()->countByAttributes(array('Id_device'=>$idDevice, 'Id_nzb_state'=>3)); //cuento los descargados
			echo json_encode(array('idDevice'=>$modelDevice->Id, 'description'=>$modelDevice->description, 'downloadedQty'=>$downloadedQty));
		}
	}
	
	
	public function actionAjaxCreateDevice()
	{
		$idCustomer = isset($_POST['idCustomer'])?$_POST['idCustomer']:null;
	
		if(isset($_POST['Device']) && isset($idCustomer))
		{
			if(isset($_POST['Device']['Id']))
			{
				$modelDevice = Device::model()->findByPk($_POST['Device']['Id']);
				$modelDevice->attributes = $_POST['Device'];
				$modelDevice->save();
				
				$modelClientSettings=new ClientSettings;
				$modelClientSettings->Id_customer = $idCustomer;
				$modelClientSettings->Id_device = $modelDevice->Id;
				$modelClientSettings->save();
				
				$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$modelDevice->Id,'Id_customer'=>$idCustomer));
				if(isset($modelCustomerDevice))
				{
					$modelCustomerDevice->is_pending = 0;
					$modelCustomerDevice->save();
				}	
			}
			
		}
	}
	
	public function actionAjaxSaveGeneralConfig()
	{			
		if(isset($_POST['Device']))
		{
			if(isset($_POST['Device']['Id']))
			{
				$modelDevice = Device::model()->findByPk($_POST['Device']['Id']);
				$modelDevice->attributes = $_POST['Device'];
				if($modelDevice->save())
				{
					$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$modelDevice->Id));
					if(isset($modelCustomerDevice))
					{
						$modelCustomerDevice->need_update = 1;
						$modelCustomerDevice->save();
					}
				}
			}
				
		}
	}
	
	public function actionAjaxSaveRequestDevice()
	{
		
 		if(isset($_POST['player_name']) && isset($_POST['CustomerDevice']))
 		{
 			$modelDevice = new Device();
 			$transaction = $modelDevice->dbConnection->beginTransaction();
 			try {
 				$modelDevice->Id = uniqid();
 				$modelDevice->attributes = $_POST['Device'];
 				$modelDevice->save();
 				$modelDevice->refresh();
 			
 				$modelCustomerDevice = new CustomerDevice();
 				$modelCustomerDevice->Id_device = $modelDevice->Id;
 				$modelCustomerDevice->Id_customer = $_POST['CustomerDevice']['Id_customer'];
 				$modelCustomerDevice->save();
 			
 				foreach($_POST['player_name'] as $player)
 				{
 					$modelDevicePlayer = new DevicePlayer();
 					$modelDevicePlayer->Id_device = $modelDevice->Id;
 					$modelDevicePlayer->description = $player;
 					$modelDevicePlayer->save();
 				}
 				
 				$transaction->commit();
 			} catch (Exception $e) {
 				$transaction->rollback();
 			}
 			
 		}
 		
 		$criteria=new CDbCriteria;
 		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)';
 		$criteria->addCondition('t.is_pending = 1');
 		$criteria->addCondition('c.Id_reseller = '.User::getResellerId());
 		
 		echo json_encode(array('qtyPending'=>CustomerDevice::model()->count($criteria)));
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
					DevicePlayer::model()->deleteAllByAttributes(array('Id_device'=>$idDevice));
					$modelCustomerDevice->delete();
					$modelDevice->delete();
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}
		
		$criteria=new CDbCriteria;
				
		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)';
 		$criteria->addCondition('t.is_pending = 1');
 		$criteria->addCondition('c.Id_reseller = '.User::getResellerId());		
		
		echo json_encode(array('qtyPending'=>CustomerDevice::model()->count($criteria)));
		
	}
	
	public function actionAjaxOpenRequestDevice()
	{
		$modelCustomers = Customer::model()->findAllByAttributes(array('Id_reseller'=>User::getResellerId()),array('order'=>'name ASC'));
			
		$modelCustomerDevice = new CustomerDevice();
		$modelDevice = new Device();
		echo $this->renderPartial('_modalRequestDevice', array('modelCustomers'=>$modelCustomers, 'modelCustomerDevice'=>$modelCustomerDevice, 'modelDevice'=>$modelDevice));
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
		
		echo json_encode(array('ddlPort'=>$ddlPorts,
								'modelDevice'=>json_encode($modelDevice->attributes), 
								'idDevice'=>$modelDevice->Id, 
								'description'=>$modelDevice->description));
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
	
	public function actionAjaxOpenAcceptDeviceForm()
	{
		$idCustomer = isset($_POST['idCustomer'])?$_POST['idCustomer']:null;
		$idDevice = isset($_POST['idDevice'])?$_POST['idDevice']:null;
	
		if(isset($idCustomer) && isset($idDevice))
		{
			$modelDevice = Device::model()->findByPk($idDevice);
			echo $this->renderPartial('_modalForm', array('modelDevice'=>$modelDevice, 'idCustomer'=>$idCustomer));
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
