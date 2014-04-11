<script type="text/javascript">

setInterval(function() {
	$.fn.yiiGridView.update('pending-customer-device-grid');
}, 5 * 60 * 1000);

function createDevice(idDevice, idCustomer)
{
	if(confirm("¿Seguro desea crear este dispositivo?"))
	{
		$.post("<?php echo DeviceController::createUrl('AjaxCreateDevice'); ?>",
				{
					idDevice:idDevice,
					idCustomer:idCustomer
				}
			).success(
				function(data){
					$.fn.yiiGridView.update('pending-customer-device-grid');
					$.fn.yiiGridView.update('customer-device-grid');
					getPendingDevices();
				});
	}
	return false;
		
}

function viewDownloads(id)
{
	$.fn.yiiGridView.update('nzb-device-grid', {
 		data: $(this).serialize() + '&idDevice=' + id
 	});
 	
	$.post("<?php echo DeviceController::createUrl('AjaxOpenViewDownload'); ?>",
			{
				idDevice:id
			}
		).success(
			function(data){
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$("#download-device-desc").text(obj.description);
					$("#download-device-id").text(obj.idDevice);
					$("#downloaded-qty").text(obj.downloadedQty);
				}		
				$('#container-modal-addPort').hide();
				$('#myModalGeneric').append($('#container-modal-viewDownload'));
				$('#container-modal-viewDownload').show();
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
				$('#container-modal-viewDownload').hide();
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
    	<h1 class="pageTitle">Dispositivos</h1>
    	</div>
  	</div>
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li class="active"><a id="tab-open" href="#tabExistentes" data-toggle="tab">Existentes</a></li>
				<li><a id="tab-waiting" href="#tabSolicitudes" data-toggle="tab">Solicitudes <span class="badge">3</span></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabExistentes">
			<?php echo $this->renderPartial('_devices',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
			</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tabSolicitudes">
				  		<?php echo $this->renderPartial('_pendingDevices',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
				

				</div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
    	</div>
    	<!-- /.col-sm-12 --> 
  	</div>
  	<!-- /.row --> 
  
  
	<div id="container-modal-addPort" style="display: none">
		<?php echo $this->renderPartial('_modalPortConfig', array( 'modelDeviceTunelGrid'=>$modelDeviceTunelGrid, 'idDevice'=>''));?>
	</div>
	
	<div id="container-modal-viewDownload" style="display: none">
		<?php echo $this->renderPartial('_modalViewDownload', array( 'modelNzbDevice'=>$modelNzbDevice, 'idDevice'=>''));?>
	</div>
  <!-- /.row --> 
</div>
<!-- /container -->