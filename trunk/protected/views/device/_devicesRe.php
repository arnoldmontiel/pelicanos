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
				'Id_device',
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
							}
							return $value;
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$device = "'$data->Id_device'";
							return '<div class="buttonGroupDevices"><button onclick="portConfig('.$device.');" data-toggle="modal" data-target="#myModalConfigPuertos" type="button" class="btn btn-default btn-sm" ><i class="fa fa-cog"></i> Configurar</button> 
									<button onclick="viewDownloads('.$device.');" type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
	?>