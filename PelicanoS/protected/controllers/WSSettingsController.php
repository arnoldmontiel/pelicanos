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
	
}
