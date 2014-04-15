 <a onclick="openForm('0',4);" data-toggle="modal" data-target="#myModalCrearMovie" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Instalador</a>
<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid-installer',
		'dataProvider'=>$modelUser->searchInstaller(),
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
							$grid = "'user-grid-installer'";
							return '<button onclick="openForm('.$username.',4)" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
	              					<button onclick="deleteInstaller('.$username.', '.$grid.')" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>