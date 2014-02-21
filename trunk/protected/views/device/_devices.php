  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid-admin',
		'dataProvider'=>$modelCustomerDevice->search(),
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
				'Id_device',
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$device = "'$data->Id_device'";
							return '<div class="buttonGroupDevices"><button onclick="portConfig('.$device.');" data-toggle="modal" data-target="#myModalConfigPuertos" type="button" class="btn btn-default btn-sm" ><i class="fa fa-cog"></i> Configurar Puertos</button> 
									<button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
	?>