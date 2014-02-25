<script type="text/javascript">

setInterval(function() {
	$.fn.yiiGridView.update('pending-customer-device-grid');
}, 5 * 60 * 1000);

function viewDownloads(id)
{
	$.post("<?php echo DeviceController::createUrl('AjaxOpenViewDownload'); ?>",
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

function portConfig(id)
{	
	$.fn.yiiGridView.update('device-tunel-grid', {
 		data: $(this).serialize() + '&idDevice=' + id
 	});
 	
	$.post("<?php echo DeviceController::createUrl('AjaxOpenConfigPort'); ?>",
			{
				idDevice:id
			}
		).success(
			function(data){			
				//$('#container-modal-addPort').html(data);
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$("#internalPort").html("");
					if(obj.ddlPort.length == 0)
						$('#btn-add-port').attr('disabled','disabled');
					else
						$('#btn-add-port').removeAttr('disabled');
					
					for(var index = 0 ; index < obj.ddlPort.length; index++)
						$('#internalPort').append( new Option(obj.ddlPort[index].description, obj.ddlPort[index].Id) );

					$("#device-desc").text(obj.description);
					$("#device-id").text(obj.idDevice);
					$("#Id_device").val(obj.idDevice);
				}
				$('#status-error').hide();		
				$('#myModalGeneric').append($('#container-modal-addPort'));
				$('#container-modal-addPort').show();
				$('#myModalGeneric').modal('show');
			});
	return false;	
	
}

function doTunnel(idDevice, idPort, open)
{
	$.post("<?php echo DeviceController::createUrl('AjaxDoTunnel'); ?>",
			{
				idDevice:idDevice,
				idPort:idPort,
				open:open
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('device-tunel-grid');
			});
	return false;	
	
}

function addPort()
{
	var externalPort = $('#externalPort').val();
	var idPort = $('#internalPort').val();
	var idDevice = $("#Id_device").val();

	if(externalPort.length == 0)
	{
		$('#status-error').show();
		return false;
	}		
	else
		$('#status-error').hide();
	
	$.post("<?php echo DeviceController::createUrl('AjaxAddPort'); ?>",
			{
				idDevice:idDevice,
				idPort:idPort,
				externalPort:externalPort
			}
		).success(
			function(data){				
				$.fn.yiiGridView.update('device-tunel-grid');
				$("#internalPort option:selected").remove();
				$("#externalPort").val('');
				if($('#internalPort option').length == 0)
					$('#btn-add-port').attr('disabled','disabled');
				else
					$('#btn-add-port').removeAttr('disabled');
					
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
			<?php echo $this->renderPartial('_pendingDevices',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
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
  
	<div id="container-modal-addPort" style="display: none">
		<?php echo $this->renderPartial('_modalPortConfig', array( 'modelDeviceTunelGrid'=>$modelDeviceTunelGrid, 'idDevice'=>''));?>
	</div>
  <!-- /.row --> 
</div>
<!-- /container -->