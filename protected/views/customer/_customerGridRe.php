  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'customer-grid',
		'dataProvider'=>$model->search(),
		'selectableRows' => 0,
		'filter'=>$model,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array(
						'name'=>'reseller_desc',
						'value'=>function($data){
								
							return $data->reseller->description;
						},
						'type'=>'raw',
				),
				'name',
				'last_name',
				'address',
				array(
						'header'=>'Dispositivos',
						'value'=>function($data){
							$value = '';
							$customerDevices = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$data->Id));
							foreach($customerDevices as $item)
							{
								$date = isset($item->request_date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $item->request_date):'';
								if($item->is_pending == 1)
									$value .= '<div>&bull; '.$item->device->description.' - '.$item->Id_device.'<span class="label label-danger">pendiente '.$date.'</span></div>';
								else
									$value .= '<div>&bull; '.$item->device->description.' - '.$item->Id_device.'</div>';
							}
							
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							
							return '<button onclick="openForm('.$data->Id.')" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
									<button onclick="openRequestDevice('.$data->Id.');" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalRequest" ><i class="fa fa-hdd-o"></i> Solicitar Dispositivo</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
	?>