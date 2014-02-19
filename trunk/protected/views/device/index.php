<script type="text/javascript">
function portConfig(id)
{
	$.post("<?php echo DeviceController::createUrl('AjaxOpenConfigPort'); ?>",
			{
				idDevice:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}
</script>
<div class="container" id="screenDispositivos">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Dispositivos Pedidos</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Reseller</th>
            <th>Cliente</th>
            <th>Fecha Pedido</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Venezuela</td>
            <td>Juan Perez</td>
            <td>10/10/2013</td>
            <td class="align-right"><button data-toggle="modal" data-target="#myModalCrearDispositivo" type="button" class="btn btn-default btn-sm" ><i class="fa fa-plus"></i> Crear Dispositivo</button>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Dispositivos</h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12">
  		<?php echo $this->renderPartial('_devices',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->