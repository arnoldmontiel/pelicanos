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
		'filter'=>$model,
		'itemsCssClass' => 'table table-striped',
		'columns'=>array(		
				array(
						'name'=>'reseller',
						'value'=>function($data){
							return $data->reseller;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'customerName',						
						'value'=>function($data){
							return $data->customerName;
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
						'header'=>'Total',
						'value'=>function($data){
							return $data->total_points;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$name = $data->customer->fullName;
							$fullName = "'$name'";
							return '<a onclick="openConsumptionDetail('.$data->Id_customer.','.$data->month.','.$data->year.');" class="btn btn-default"><i class="fa fa-eye"></i> Ver Detalles</a> ';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>