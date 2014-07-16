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
				array(
						'name'=>'name',
						'value'=>function($data){
				
							return $data->name;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'last_name',
						'value'=>function($data){
				
							return $data->last_name;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'address',
						'value'=>function($data){
				
							return $data->address;
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"30%"),
				),
				array(
						'header'=>'Dispositivos',
					'value'=>function($data){
							$value = '';
							//$customerDevices = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$data->Id));
							$customerDevices = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$data->Id, 'is_pending'=>0));
							foreach($customerDevices as $item)
							{
								$date = isset($item->request_date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $item->request_date):'';
																
 								if($item->is_pending == 1)
									$value .=  '<div class="noWrap tableList">'.$date.' <span class="labelPendiente">Pendiente</span> <br/>&bull; '.$item->device->description.' - '.$item->Id_device.'</div>';
								else
									$value .= '<div class="noWrap tableList">&bull; '.$item->device->description.' - '.$item->Id_device.'</div>';
							}
							
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							
							return '<div class="editBorrarBtnGroup"><button onclick="openForm('.$data->Id.')" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
	?>