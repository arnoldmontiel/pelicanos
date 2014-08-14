<div class="row">
	<div class="col-sm-6">
		<h2 class="tabPanelTitle">Pagos</h2>
	</div>
	<div class="col-sm-6 align-right">
		<div class="tabPanelDescargas">Descargas <span id="points-paid-by-customer"><?php echo Consumption::pointsAccumulated();?></span></div>
	</div>
</div>
<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'payment-customer-grid',
		'dataProvider'=>$model->searchPaymentByCustomer(),
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
						'header'=>'Registro',
						'value'=>function($data){
															
							return $data->paid_date;
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
							return '<a onclick="openConsumptionDetail('.$data->Id_customer.','.$data->month.','.$data->year.');" class="btn btn-default"><i class="fa fa-eye"></i>  Ver Detalle</a>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>