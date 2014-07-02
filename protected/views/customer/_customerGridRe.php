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
							//$customerDevices = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$data->Id));
							$customerDevices = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$data->Id, 'is_pending'=>0));
							foreach($customerDevices as $item)
							{
								$date = isset($item->request_date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $item->request_date):'';
								
								$value .= '<div class="noWrap dispClientes">&bull; '.$item->device->description.' - '.$item->Id_device.'</div>';
								
// 								if($item->is_pending == 1)
// 								{
// 									$idDevice = "'$item->Id_device'";
// 									$value .= '<div class="noWrap dispClientes">&bull; '.$item->device->description.' - '.$item->Id_device.' <span class="label label-danger">pendiente '.$date.'</span></div>';
// 								}
// 								else
// 									$value .= '<div class="noWrap dispClientes">&bull; '.$item->device->description.' - '.$item->Id_device.'</div>';
							}
							
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							
							return '<button onclick="openForm('.$data->Id.')" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:center;"),
						'headerHtmlOptions'=>array("style"=>"text-align:center;"),
				),
			),
		));		
	?>