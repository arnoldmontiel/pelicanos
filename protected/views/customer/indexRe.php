<script type="text/javascript">
function openForm(idCustomer)
{
	$.post("<?php echo CustomerController::createUrl('AjaxOpenForm'); ?>",
			{
				idCustomer:idCustomer
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}

function openRequestDevice(idCustomer)
{
	$.post("<?php echo CustomerController::createUrl('AjaxOpenRequestDevice'); ?>",
			{
				idCustomer:idCustomer
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}
</script>
<div class="container" id="screenClientes">
<div class="row">
<div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a onclick="openForm(0);" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearCliente"><i class="fa fa-plus"></i> Agregar Cliente</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    	<?php echo $this->renderPartial('_customerGridRe',array('model'=>$model)); ?>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->