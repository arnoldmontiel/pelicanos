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
			try {
				$model->ip_v4 = $settings->ip_v4;
				$model->ip_v6 = $settings->ip_v6;
				$model->port_v4 = $settings->port_v4;
				$model->port_v6 = $settings->port_v6;
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
	
}
