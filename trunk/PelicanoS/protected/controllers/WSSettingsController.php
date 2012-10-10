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
	* Set romete client settings
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
	
}
