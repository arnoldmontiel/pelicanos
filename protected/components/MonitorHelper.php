<?php
class MonitorHelper
{ 
	static public function getStatistics()
	{
		$monitorAPI = new WsMonitor();
		$response = $monitorAPI->getHeartBeat();
		
		if(isset($response))
		{
			try {
				
			
				$arrAckHeartBeat = array();
				foreach($response as $item)
				{
					$monitor = new Monitor();
					$monitor->Id_device = $item->Id_device;
					$monitor->description = $item->description;
					$monitor->Id_device_type = $item->Id_device_type;
					$monitor->Id_device_state = $item->Id_device_state;
					$monitor->insert_date = $item->insert_date;
					if($monitor->save())
						$arrAckHeartBeat[] = $item;
				}
				
				$monitorAPI->ackHeartBeat($arrAckHeartBeat);
				
			} catch (Exception $e) {
				$monitorAPI->ackHeartBeat($arrAckHeartBeat);
			}
		}
		
	}
	
}