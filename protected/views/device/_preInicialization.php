<form id="device-form" method="post">
	<?php echo CHtml::hiddenField('idCustomer', $idCustomer,array('id'=>'idCustomer')); ?>
	<?php echo CHtml::hiddenField('idDevice', $modelDevice->Id,array('id'=>'idDevice')); ?>
	<div class="modal-dialog" id="myModalCrearDisp">
    	<div class="modal-content">
      		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
      		        		<h4 class="modal-title">Dispositivo</h4>
      		</div>
      		<div class="modal-body">
  				<div class="inlineForm">
  					<label class="inlineFormLabel">Nota</label>
  					<div class="row">
	  					<div class="form-group col-sm-12 ">
	    					<label>Al presionar Generar, se crear&aacute;n las claves del nuevo dispositivo.</label>
	  					</div>
  					</div>  					
  				</div>
  					
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="acceptDevice();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Generar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

	
	function acceptDevice()
	{			
		$.post("<?php echo DeviceController::createUrl('AjaxOpenAcceptDeviceForm'); ?>",
				{
					idDevice:$("#idDevice").val(),
					idCustomer:$("#idCustomer").val()
				}
			).success(
				function(data){
					$('#myModalGeneric').html(data);
					$('#myModalGeneric').modal('show');
				});
		return false;	
	}
</script>