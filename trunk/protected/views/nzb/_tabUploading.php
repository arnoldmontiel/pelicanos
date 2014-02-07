<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'nzb-grid_uploading',
		'dataProvider'=>$modelAutoRipper->searchUploading(),
		'selectableRows' => 0,
		'filter'=>$modelAutoRipper,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				'name',
				array(
		 			'name'=>'auto_ripper_state_description',
					'value'=>'$data->autoRipperState->description'
				),
				'percentage',
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<button type="button" onclick="viewStateHistory('.$data->Id.');" class="btn btn-default btn-sm"><i class="fa fa-clock-o fa-fw"></i> Ver Movimientos</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>