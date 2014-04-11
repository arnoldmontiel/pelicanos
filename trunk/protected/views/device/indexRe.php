<script type="text/javascript">
function viewDownloads(id)
{
	$.post("<?php echo Yii::app()->createUrl('AjaxOpenViewDownload'); ?>",
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
				<li class="active"><a id="tab-open" href="#tabExistentes"
					data-toggle="tab">Existentes</a></li>
				<li><a id="tab-waiting" href="#tabSolicitudes" data-toggle="tab">Solicitudes
						<span class="badge">3</span>
				</a></li>
				<li class="pull-right"><button class="btn btn-primary superBoton"
						data-toggle="modal" data-target="">
						<i class="fa fa-plus"></i> Solicitar Dispositivos
					</button></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabExistentes">
  	<?php echo $this->renderPartial('_devices',array('modelCustomerDevice'=>$modelCustomerDevice)); ?>
     </div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tabSolicitudes">

					<table class="table table-bordered table-striped tablaIndividual noMargin">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Nombre</th>
								<th>Dispositivo</th>
								<th>Fecha Pedido</th>
								<th>Players</th>
								<th>Estado</th>
								<th class="align-right">Acciones</th>
							</tr>
							<tr></tr>
						</thead>
						<tbody>
							<tr>
								<td>Arnold Montiel</td>
								<td>Castelar</td>
								<td>00998893293</td>
								<td>30/10/2020</td>
								<td>
									<ul class="playerList">
										<li>Dormitorio</li>
										<li>Comedor Diario</li>
									</ul>
								</td>
								<td><div class="label label-danger">
										<i class="fa fa-warning"></i> Pendiente
									</div></td>
								<td class="align-right"><button class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i> Cancelar Pedido</button></td>
							</tr>
							<tr>
								<td>Juan Perez</td>
								<td>Villa Gesell</td>
								<td>00998893293</td>
								<td>30/10/2020</td>
								<td>
									<ul class="playerList">
										<li>Dormitorio</li>
										<li>Comedor Diario</li>
										<li>Comedor Diario</li>
									</ul>
								</td>
								<td><div class="label label-danger">
										<i class="fa fa-warning"></i> Pendiente
									</div></td>
								<td class="align-right"><button class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i> Cancelar Pedido</button></td>
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
</div>
<!-- /container -->