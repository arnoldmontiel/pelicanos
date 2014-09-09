<script type="text/javascript">
function portConfig(id)
{	
	$.fn.yiiGridView.update('device-tunel-grid', {
 		data: $(this).serialize() + '&idDevice=' + id
 	});

	$.fn.yiiGridView.update('player-config-grid', {
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
							$("#DevicePlayer_Id_device").val(objDevice.Id);
							
							$("#Device_Id").val(objDevice.Id);
							$("#Device_sabnzb_api_key").val(objDevice.sabnzb_api_key);
							$("#Device_host_file_server").val(objDevice.host_file_server);
							$("#Device_host_file_server_path").val(objDevice.host_file_server_path);
							$("#Device_host_file_server_user").val(objDevice.host_file_server_user);
							$("#Device_host_file_server_passwd").val(objDevice.host_file_server_passwd);
							$("#Device_host_file_server_name").val(objDevice.host_file_server_name);							
							$("#Device_tmdb_api_key").val(objDevice.tmdb_api_key);
							$("#Device_tmdb_lang").val(objDevice.tmdb_lang);

							if(objDevice.is_movie_tester == 1)
								$("#Device_is_movie_tester").attr('checked',true);
							else							
								$("#Device_is_movie_tester").attr('checked',false)
						}

						var objUser = jQuery.parseJSON(obj.modelCustomerUser);
						if(objUser != null)
						{
							$("#CustomerUser_username").val(objUser.username);
							$("#CustomerUser_password").val(objUser.password);
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
				<li class="active"><a id="tab-open" href="#tabExistentes"
					data-toggle="tab">Existentes</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabExistentes">
  					<?php echo $this->renderPartial('_devicesIns',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
    			 </div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- /.col-sm-12 -->
	</div>
	<!-- /.row -->

	<div id="container-modal-addPort" style="display: none">
		<?php echo $this->renderPartial('_modalPortConfig', array('modelPlayerConfigs'=>$modelPlayerConfigs, 'modelDeviceTunelGrid'=>$modelDeviceTunelGrid, 'idDevice'=>''));?>
	</div>
</div>
<!-- /container -->