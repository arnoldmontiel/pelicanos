  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'device-alerts-grid',
		'dataProvider'=>$modelCustomerDevice->searchApproved(),
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
			),
		));		
	?>