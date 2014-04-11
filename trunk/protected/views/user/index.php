<script type="text/javascript">
function openForm(username, idProfile)
{
	$.post("<?php echo UserController::createUrl('AjaxOpenForm'); ?>",
			{
				username:username,
				idProfile:idProfile
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}
function deleteReseller(username, grid)
{
	if (confirm('¿Desea borrar este usuario?')) 
	{
		$.post("<?php echo UserController::createUrl('AjaxDelete'); ?>",
			{
				username:username
			}
		).success(
			function(data){
				$.fn.yiiGridView.update(grid);
			});
		return false;
	}
	return false;
}
</script>
<div class="container" id="screenUsuarios">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Usuarios</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabAdmin" data-toggle="tab">Administradores</a></li>
        <li><a href="#tabMovie" data-toggle="tab">Movie Managers</a></li>
        <li><a href="#tabInstaladores" data-toggle="tab">Instaladores</a></li>
      </ul>
      <div class="tab-content">
	      <div class="tab-pane active" id="tabAdmin">
	      	<?php echo $this->renderPartial('_tabAdmin',array('modelUser'=>$modelUser)); ?>	      
	      </div><!-- /.tabAdmin -->
	      <div class="tab-pane" id="tabMovie">
	     	<?php echo $this->renderPartial('_tabMovieAdmin',array('modelUser'=>$modelUser)); ?>
	      </div><!-- /.tabMovie -->
	      <div class="tab-pane" id="tabInstaladores">
	      <a data-toggle="modal" data-target="#myModalCrearInstalador" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Instalador</a>
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Usuario</th>
<th>Password</th>
<th>E-mail</th>
<th class="align-right">Acciones</th>
</tr></thead>
<tbody>
<tr>
<td>Juan</td>
<td>Perez</td>
<td>juanperex@hola.com</td>
<td class="align-right">
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
</td>
</tr>
<tr>
<td>Juan</td>
<td>Perez</td>
<td>juanperex@hola.com</td>
<td class="align-right">
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
</td>
</tr>
<tr>
<td>Juan</td>
<td>Perez</td>
<td>juanperex@hola.com</td>
<td class="align-right">
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
</td>
</tr>
</tbody>
</table>
  	      </div><!-- /.tabInstaladores -->
      </div><!-- /.tabContent -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
