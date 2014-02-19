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
      </ul>
      <div class="tab-content">
	      <div class="tab-pane active" id="tabAdmin">
	      	<?php echo $this->renderPartial('_tabAdmin',array('modelUser'=>$modelUser)); ?>	      
	      </div><!-- /.tabAdmin -->
	      <div class="tab-pane" id="tabMovie">
	     	<?php echo $this->renderPartial('_tabMovieAdmin',array('modelUser'=>$modelUser)); ?>
	      </div><!-- /.tabMovie -->
      </div><!-- /.tabContent -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
