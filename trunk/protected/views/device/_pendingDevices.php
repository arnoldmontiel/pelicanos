  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'pending-customer-device-grid',
		'dataProvider'=>$modelCustomerDevice->searchPending(),
		'selectableRows' => 0,
		'filter'=>$modelCustomerDevice,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
						'name'=>'reseller_description',
						'value'=>function($data){
							
							return $data->customer->reseller->description;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'customer_description',
						'value'=>function($data){
								
							return $data->customer->name . ' ' . $data->customer->last_name;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'device_description',
						'value'=>function($data){
				
							return $data->device->description;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'request_date',
						'value'=>function($data){
							return isset($data->request_date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $data->request_date):'';
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Players',
						'value'=>function($data){
							$modelDevicePlayers = DevicePlayer::model()->findAllByAttributes(array('Id_device'=>$data->Id_device));
				
							$playerList = '<ul class="playerList">';
							foreach($modelDevicePlayers as $player)
							{
								$playerList .= '<li>'. $player->description . '</li>';
							}
							$playerList .= '</ul>';
							return $playerList;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Con NAS',
						'value'=>function($data){
							return ($data->device->need_nas == 0)?'No':'Si';
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$device = "'$data->Id_device'";							
							return '<button data-toggle="modal" onclick="openAcceptDeviceForm('.$device.','.$data->Id_customer.');" type="button" class="btn btn-default btn-sm" ><i class="fa fa-plus"></i> Crear Dispositivo</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
	?>