 <a  data-toggle="modal" data-target="#myModalCrearMovie" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Movie Manager</a>
<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid-movie-admin',
		'dataProvider'=>$modelUser->searchMovieAdmin(),
		'selectableRows' => 0,
		'filter'=>$modelUser,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				'username',
				'password',
				'email',
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
	              					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>