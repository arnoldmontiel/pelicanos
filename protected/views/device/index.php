<script type="text/javascript">

setInterval(function() {
	$.fn.yiiGridView.update('pending-customer-device-grid');
}, 5 * 60 * 1000);

getPendingDevices();

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

function openAcceptDeviceForm(idDevice, idCustomer)
{
	$.post("<?php echo DeviceController::createUrl('AjaxOpenAcceptDeviceForm'); ?>",
			{
				idDevice:idDevice,
				idCustomer:idCustomer
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
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

					if(obj.modelDevice != null)
					{
						var objDevice = jQuery.parseJSON(obj.modelDevice);
						if(objDevice != null)
						{
							$("#device-desc").text(objDevice.description);
							$("#device-id").text(objDevice.Id);
							$("#Id_device").val(objDevice.Id);

							$("#Device_Id").val(objDevice.Id);
							$("#Device_sabnzb_api_key").val(objDevice.sabnzb_api_key);
							$("#Device_sabnzb_api_url").val(objDevice.sabnzb_api_url);
							$("#Device_path_sabnzbd_download").val(objDevice.path_sabnzbd_download);
							$("#Device_path_pending").val(objDevice.path_pending);
							$("#Device_path_ready").val(objDevice.path_ready);
							$("#Device_path_images").val(objDevice.path_images);
							$("#Device_path_shared").val(objDevice.path_shared);
							$("#Device_tmdb_api_key").val(objDevice.tmdb_api_key);
							$("#Device_tmdb_lang").val(objDevice.tmdb_lang);
							$("#Device_host_path").val(objDevice.host_path);
							$("#Device_host_file_server").val(objDevice.host_file_server);
							$("#Device_host_file_server_path").val(objDevice.host_file_server_path);
						}
					}					
				}
				$('#status-error').hide();		
				$('#container-modal-viewDownload').hide();
				$('#myModalPorts').append($('#container-modal-addPort'));
				$('#container-modal-addPort').show();
				$('#myModalPorts').modal('show');
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
				<li><a id="tab-waiting" href="#tabSolicitudes" data-toggle="tab">Solicitudes <span id="tabPendingDevicesQty" class="badge"></span></a></li>
				<li><a href="#tabAlertas" data-toggle="tab">Alertas <span class="badge">3</span></a></li>
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
				<div class="tab-pane" id="tabAlertas">

				<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Reseller</th>
<th>Cliente</th>
<th>Nombre</th>
<th>Dispositivo</th>
<th class="align-center">Estado</th>
</thead>
<tbody>
<tr>
<td>Venezuela</td>
<td>Arnol Montiel</td>
<td>Castelar Norte</td>
<td>50ed8335ae2ef</td>
<td class="align-center"><span class="label label-primary"><i class="fa fa-exclamation-triangle"></i> Disco Lleno</span></td>
</tr>
<tr>
<td>Venezuela</td>
<td>Arnol Montiel</td>
<td>Castelar Norte</td>
<td>50ed8335ae2ef</td>
<td class="align-center"><span class="label label-danger"> Offline</span></td>
</tr>
</tbody>
</table>
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