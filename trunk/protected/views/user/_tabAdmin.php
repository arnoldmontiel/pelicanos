<a onclick="openForm('0',1);" data-toggle="modal" data-target="#myModalCrearAdmin" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Administrador</a>
<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid-admin',
		'dataProvider'=>$modelUser->searchAdmin(),
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
							$username = "'$data->username'";
							$grid = "'user-grid-admin'";
							return '<button onclick="openForm('.$username.',1)" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
	              					<button onclick="deleteReseller('.$username.', '.$grid.')" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>