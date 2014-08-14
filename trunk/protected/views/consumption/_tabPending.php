<div class="row">
	<div class="col-sm-6">
		<h2 class="tabPanelTitle">Pendiente</h2>
	</div>
	<div class="col-sm-6 align-right">
		<div class="tabPanelDescargas">Descargas Pendientes <span id="points-pending-by-customer"><?php echo Consumption::pointsAccumulated(false);?></span></div>
	</div>
</div>
<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'pending-customer-grid',
		'dataProvider'=>$model->searchPendingByCustomer(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped',
		'columns'=>array(				
				array(
						'header'=>'Cliente',
						'value'=>function($data){
							return $data->customer->fullName;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Periodo',
						'value'=>function($data){
							$value = '';
							
							return strftime('%B', mktime(0, 0, 0, $data->month)).' '. $data->year;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Valor',
						'value'=>function($data){
							return $data->total_points;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'Acciones',
						'value'=>function($data){							
							//return '<a onclick="openConsumptionDetail('.$data->Id_reseller.');" data-toggle="modal" class="btn btn-primary"><i class="fa fa-list"></i> Ver Detalle</a>';
							$name = $data->customer->fullName;
							$fullName = "'$name'";
							return '<a onclick="openConsumptionDetail('.$data->Id_customer.','.$data->month.','.$data->year.');" class="btn btn-default">Ver Detalles</a> 
									<a onclick="registerPayment('.$data->Id_customer.', '.$data->month.', '.$data->year.', '.$fullName.');" class="btn btn-default">Registrar Pago</a> 
									<a onclick="generateTicket();" class="btn btn-default">Imprimir Factura</a>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>