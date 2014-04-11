<form id="device-form" method="post">
	<?php echo CHtml::hiddenField('idCustomer', $idCustomer,array('id'=>'idCustomer')); ?>
	<?php echo CHtml::activeHiddenField($modelDevice, 'Id'); ?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Dispositivo</h4>
      		</div>
      		<div class="modal-body">
      			
      			<div class="panel panel-default panelCliente">
	      			<div class="panel-body">
		      			<div class="infoPanelCliente">
		  					<div class="bold"><?php echo $modelDevice->description;?> (ID: <?php echo $modelDevice->Id;?>)</div>
		  				</div>
	  				</div>
	  			</div>
	  			
			  	<div class="form-group">
			  		<label for="campoNombre">Descripti&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'description', array('class'=>'form-control')); ?>
			 	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Sabnzb API Key</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_key', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Sabnzb API URL</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_url', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Path Sabnzb Descarga</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'path_sabnzbd_download', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Path Nzb Pendientes</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'path_pending', array('class'=>'form-control')); ?>
			  	</div>
				
				<div class="form-group">
			  		<label for="campoNombre">Path Nzb Listos</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'path_ready', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Path Imagenes</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'path_images', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Path Compartidos</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'path_shared', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Host Path</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'host_path', array('class'=>'form-control')); ?>
			  	</div>
			  	 <div class="form-group">
			  		<label for="campoNombre">Host File Server</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'host_file_server', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Host File Server Path</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_path', array('class'=>'form-control')); ?>
			  	</div>
 				<div class="form-group">
			  		<label for="campoNombre">Tmdb API Key</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'tmdb_api_key', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Tmdb API Lang</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'tmdb_lang', array('class'=>'form-control')); ?>
			  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="acceptDevice();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#device-form").submit(function(e)
		{
			var formURL = "<?php echo DeviceController::createUrl("AjaxCreateDevice"); ?>";
			var formData = new FormData(this);
			
		    $.ajax({
		        url: formURL,
		    type: 'POST',
		        data:  formData,
		    mimeType:"multipart/form-data",
		    contentType: false,
		        cache: false,
		        processData:false,
		    success: function(data, textStatus, jqXHR)
		    {	
		    	$.fn.yiiGridView.update('pending-customer-device-grid');
				$.fn.yiiGridView.update('customer-device-grid');
				getPendingDevices();
	    		$('#myModalGeneric').trigger('click');
		    	
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function acceptDevice()
	{				
		$('#device-form').submit();
	}
</script>