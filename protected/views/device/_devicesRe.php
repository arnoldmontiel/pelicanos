  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'customer-device-grid',
		'dataProvider'=>$modelCustomerDevice->searchApprovedRe(),
		'selectableRows' => 0,
		'filter'=>$modelCustomerDevice,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
						'name'=>'customer_description',
						'value'=>function($data){
								
							return $data->customer->fullName;
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
						'name'=>'Id_device',
						'value'=>function($data){
				
							return $data->Id_device;
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"10%"),
				),				
				array(
						'header'=>'Players',
						'value'=>function($data){
							$modelDevicePlayers = DevicePlayer::model()->findAllByAttributes(array('Id_device'=>$data->Id_device));
				
							$playerList = '';
							foreach($modelDevicePlayers as $player)
							{
								$playerList .= '<div class="noWrap tableList">&bull; '. $player->description . '</div>';
															}
							return $playerList;
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"10%"),
				),
				array(
						'header'=>'Con NAS',
						'value'=>function($data){
							return ($data->device->need_nas == 0)?'No':'Si';
						},
						'type'=>'raw',
						'headerHtmlOptions'=>array("style"=>"white-space:nowrap;"),
						),
				array(
						'header'=>'Estado',
						'value'=>function($data){
							$value = '';
							switch ($data->device->state) {
								case 1:
									$value = '<span class="label label-danger">Offline</span>';
									break;
								case 2:
									$value = '<span class="label label-warning">Waiting</span>';
									break;
								case 3:
									$value = '<span class="label label-success">Online</span>';
									break;
								case 4:
									$value = '<span class="label label-primary"><i class="fa fa-exclamation-triangle"></i> Disco lleno</span>';
									break;
							}
							if($data->device->hasError)
								$value = $value.'<div class="conErrores"><i class="fa fa-exclamation-triangle"></i> Con Errores</div>';
							return $value;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-center"),
						'headerHtmlOptions'=>array("class"=>"align-center"),
				),
				array(
						'header'=>'Actualizado',
						'value'=>function($data){
							return ($data->device->isUpToDate)?'Si':'No';
						},
						'type'=>'raw',
						'headerHtmlOptions'=>array("style"=>"white-space:nowrap;"),
				),
				array(
						'header'=>'Versi&oacute;n',
						'value'=>function($data){
							$modelClientSetting = ClientSettings::model()->findByAttributes(array('Id_device'=>$data->Id_device, 'Id_customer'=>$data->Id_customer));
							$version = 0;
							if(isset($modelClientSetting))
								$version = (isset($modelClientSetting->version))?$modelClientSetting->version:0;
								
							return $version;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$device = "'$data->Id_device'";
							return '<div class="buttonGroupDevices pull-right"><button onclick="portConfig('.$device.');" data-toggle="modal" data-target="#myModalConfigPuertos" type="button" class="btn btn-default btn-sm" ><i class="fa fa-cog"></i> Configurar</button> 
									<button onclick="viewDeviceInfo('.$device.');" type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewInfo" ><i class="fa fa-clock-o"></i> Ver Info</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
	?>