<?php

class WSSettingsController extends Controller
{

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
					'classMap'=>array(
			                    'ClientSettingsRequest'=>'ClientSettingsRequest',
			                    'CustomerSettingsResponse'=>'CustomerSettingsResponse',
			                    'TunnelingPorts'=>'TunnelingPorts',
		),
		),
		);
	}
	
	/**
	* Set remote client settings
	* @param ClientSettingsRequest settings
	* @return bool success
	* @soap
	*/
	public function setClientSettings($settings)
	{
		$model = ClientSettings::model()->findByAttributes(array('Id_device'=>$settings->Id_device));
		if(isset($model))
		{
			$transaction = $model->dbConnection->beginTransaction();
			try {
				$model->ip_v4 = $settings->ip_v4;
				$model->ip_v6 = $settings->ip_v6;
				$model->port_v4 = $settings->port_v4;
				$model->port_v6 = $settings->port_v6;
				$model->is_nas_alive = $settings->is_nas_alive;
				if($model->is_nas_alive != 0)
				{
					$model->disc_used_space = $settings->disc_used_space;
					$model->disc_total_space = $settings->disc_total_space;
				}
				$model->save();
				
				foreach($settings->ClientError as $clientError)
				{
					$modelErrorLog = new ErrorLog();
					$modelErrorLog->error_type = $clientError->error_type;
					$modelErrorLog->has_error = $clientError->has_error;
					$modelErrorLog->date = $clientError->date;
					$modelErrorLog->save();
				}
				$transaction->commit();
			}
			catch (Exception $e) 
			{
				$transaction->rollback();
				return false;
			}
			return true;
		}
		return false;
	}
	/**
	* Set wich version has been downloaded
	* @param string idDevice
	* @param string version
	* @return bool success
	* @soap
	*/
	
	public function setAnydvdVersionDownloaded($idDevice,$version)
	{
		$model = ClientSettings::model()->findByAttributes(array('Id_device'=>$idDevice));
		if(isset($model))
		{
			try {
				$model->anydvd_version_downloaded = $version;
				$model->need_update = 0;
				$model->save();
			}
			catch (Exception $e)
			{
				return false;
			}
			return true;
		}
		return false;
	}
	/**
	* Set wich version has been installed
	* @param string idDevice
	* @param string version
	* @return bool success
	* @soap
	*/
	
	public function setAnydvdVersionInstalled($idDevice,$version)
	{
		$model = ClientSettings::model()->findByAttributes(array('Id_device'=>$idDevice));
		if(isset($model))
		{
			try {
				$model->anydvd_version_installed = $version;
				$model->save();
			}
			catch (Exception $e)
			{
				return false;
			}
			return true;
		}
		return false;
		
	}
	/**
	* check for a now version of anydvd
	* @param string idDevice
	* @return ServerAnydvdUpdateResponse response
	* @soap
	*/
	
	public function checkForUpdate($idDevice)
	{
		$response = new ServerAnydvdUpdateResponse;
		$response->version = "";
		$model = ClientSettings::model()->findByAttributes(array('Id_device'=>$idDevice));
		if(isset($model))
		{
			if($model->need_update)			
			{
				$criteria = new CDbCriteria();
				$criteria->order = 'Id DESC';
				$anydvdVersion = AnydvdhdVersion::model()->find($criteria);
				if(isset($anydvdVersion))
				{
					$settings = Setting::getInstance();
						
					$response->download_link = $settings->path_anydvd_download.$anydvdVersion->file_name;
					$response->file_name = $anydvdVersion->file_name;
					$response->version = $anydvdVersion->version;						
				}				
			}
		}
		return $response;
	}
	/**
	* Returns the device configuration
	* @param string idDevice
	* @return ServerSettingsRipperResponse response
	* @soap
	*/
	
	public function getRipperSettings($idDevice)
	{
		$response = new ServerSettingsRipperResponse;
		$model = SettingsRipper::model()->findByAttributes(array('Id_device'=>$idDevice));
		if(isset($model))
		{
			$response->drive_letter = $model->drive_letter;
			$response->final_folder_ripping = $model->final_folder_ripping;
			$response->mymovies_password = $model->mymovies_password;
			$response->mymovies_username = $model->mymovies_username;
			$response->temp_folder_ripping = $model->temp_folder_ripping;
			$response->time_from_reboot = $model->time_from_reboot;
			$response->time_to_reboot = $model->time_to_reboot;
		}
		return $response;
	}
	
	/**
	*
	* Returns the customer configuration
	* @param string idDevice
	* @return CustomerSettingsResponse
	* @soap
	*/
	public function getCustomerSettings($idDevice)
	{
		try {
				
			$modelRel = CustomerDevice::model()->findByAttributes(array('Id_device'=>$idDevice, 'need_update'=>1));
				
			if(isset($modelRel))
			{	
				$modelResponse = new CustomerSettingsResponse();
				$modelResponse->Id_device = $idDevice;
				$modelResponse->Id_customer = $modelRel->Id_customer;
				$modelResponse->setAttributes($modelRel->customer);
				
				$configSOAP = new ConfigurationSOAP();
				$configSOAP->setAttributes($modelRel->device);
				
				//agrego las cuentas de sabnzbd
				$sabnzbdAccounts = SabnzbdConfig::model()->findAllByAttributes(array('Id_device'=>$idDevice));
				
				foreach($sabnzbdAccounts as $account)
				{
					$modelAccount = new SabnzbdAccountSOAP();
					$modelAccount->setAttributes($account);
					$configSOAP->SabnzbdAccounts[] = $modelAccount;
				}
				
				//agrego los players
				$devicePlayers = DevicePlayer::model()->findAllByAttributes(array('Id_device'=>$idDevice));
				
				foreach($devicePlayers as $player)
				{
					$modelPlayer = new PlayerSOAP();
					$modelPlayer->setAttributes($player);
					$configSOAP->Players[] = $modelPlayer;
				}
				
				$modelResponse->Configuration = $configSOAP;

				$users = CustomerUsers::model()->findAllByAttributes(array('Id_customer'=>$modelRel->Id_customer));
				
				foreach($users as $user)
				{
					$modelUser = new UserSOAP();
					$modelUser->setAttributes($user);
					$modelResponse->Users[] = $modelUser;
				}
				
				return $modelResponse;
			}
		} catch (Exception $e) {
			return null;
		}
	}
	
	/**
	*
	* Set "getCustomerSettings" acknowledge
	* @param string idDevice
	* @return boolean response
	* @soap
	*/
	public function ackCustomerSettings($idDevice)
	{
		try {
	
			$modelRel = CustomerDevice::model()->findByAttributes(array('Id_device'=>$idDevice, 'need_update'=>1));
	
			if(isset($modelRel))
			{
				$modelRel->need_update = 0;
				$modelRel->last_read_date = new CDbExpression('NOW()');
				if($modelRel->save())	
					return true;
			}
		} catch (Exception $e) {
			return false;
		}
		return false;
	}
	
	/**
	*
	* Returns array of ports to tunnel by device
	* @param string idDevice
	* @return TunnelingPorts[]
	* @soap
	*/
	public function getDeviceTunnelPort($idDevice)
	{
		$arrayResponse = array();
		$modelDeviceTunnelings = DeviceTunneling::model()->findAllByAttributes(array('Id_device'=>$idDevice, 'is_validated'=>0));

		foreach($modelDeviceTunnelings as $item)
		{
			$tunnelingPorts = new TunnelingPorts();
			$tunnelingPorts->internal_port = $item->port->port_number;
			$tunnelingPorts->external_port = $item->external_port;
			$tunnelingPorts->open = $item->is_open;
			$arrayResponse[] = $tunnelingPorts; 
		}
		
		return $arrayResponse;
	}
	
	/**
	*
	* Set "getDeviceTunnelPort" acknowledge
	* @param string idDevice
	* @param TunnelingPorts[] ports
	* @return boolean response
	* @soap
	*/
	public function ackDeviceTunnelPort($idDevice, $ports)
	{
		try {
	
			foreach($ports as $item)
			{
				$criteria = new CDbCriteria();
				$criteria->join = 'INNER JOIN port p on (t.Id_port = p.Id)';
				$criteria->addCondition('t.Id_device = "'.$idDevice.'"');
				$criteria->addCondition('t.is_validated = 0');
				$criteria->addCondition('p.port_number = '.$item->internal_port);
				$criteria->addCondition('t.external_port = '.$item->external_port);
				
				$modelDeviceTunneling = DeviceTunneling::model()->find($criteria);
				
				if(isset($modelDeviceTunneling))
				{
					$modelDeviceTunneling->is_validated = 1;
					$modelDeviceTunneling->save();
				}
			}
			
			return true;
		} catch (Exception $e) {
			return false;
		}
		return false;
	}
}
