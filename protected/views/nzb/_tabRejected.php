<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'nzb-grid_rejected',
		'dataProvider'=>$modelNzb->search(),
		'selectableRows' => 0,
		'filter'=>$modelNzb,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array(
					'header'=>'Afiche',
					
					'value'=>function($data){
						return '<img class="tableMovieImage" src="images/spiderman.jpg" width="50">';
					},
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),			
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<button type="button" onclick="removeProduct('.$data->Id.');" class="btn btn-default btn-sm"><i class="fa fa-clock-o fa-fw"></i> Ver Movimientos</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>