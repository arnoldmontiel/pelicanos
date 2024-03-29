<div class="row">
	<div class="col-sm-6">
		<h2 class="tabPanelTitle">Pagos</h2>
	</div>
	<div class="col-sm-6 align-right">
		<div class="tabPanelDescargas">Descargas <span id="points-paid-by-reseller"><?php echo Consumption::pointsAccumulated();?></span></div>
	</div>
</div>
<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'payment-reseller-grid',
		'dataProvider'=>$model->searchPaymentByReseller(),
		'selectableRows' => 0,
		'summaryText'=>'',
		'filter'=>$model,
		'itemsCssClass' => 'table table-striped tableRightPanel',
		'columns'=>array(				
				array(
						'name'=>'reseller',
						'value'=>function($data){
							return $data->reseller;
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
						'header'=>'Acciones',
						'value'=>function($data){							
							//return '<a onclick="openConsumptionDetail('.$data->Id_reseller.');" data-toggle="modal" class="btn btn-primary"><i class="fa fa-list"></i> Ver Detalle</a>';
							return '<a onclick="openConsumptionDetailByReseller('.$data->Id_reseller.','.$data->month.','.$data->year.');" class="btn btn-default"><i class="fa fa-eye"></i> Ver Detalle</a>
									<a onclick="generateTicket('.$data->Id_reseller.','.$data->month.','.$data->year.',2);" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Factura</a>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>
