<form id="device-form" method="post">
	<?php echo CHtml::hiddenField('idCustomer', $idCustomer,array('id'=>'idCustomer')); ?>
	<?php echo CHtml::activeHiddenField($modelDevice, 'Id'); ?>
	<div class="modal-dialog" id="myModalCrearDisp">
    	<div class="modal-content">
      		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
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
	  			<div class="row">
  					<div class="form-group col-sm-12">
			  		<label for="campoNombre">Descripci&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'description', array('class'=>'form-control')); ?>
			 		</div>
  				</div>
  				<div class="inlineForm">
  					<label class="inlineFormLabel">Servidor Multimedia</label>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia IP</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Path Archivos</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_path', array('class'=>'form-control'));?>
	  					</div>
  					</div>  					
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Usuario</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_user', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia Password</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_passwd', array('class'=>'form-control'));?>
	  					</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Nombre</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_name', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	  				
	  					</div>	  					
  					</div>
  				</div>
  				<div class="inlineForm">
	  					<label class="inlineFormLabel">Varios</label>
	  					<div class="row">
		  					<div class="form-group col-sm-6">
	    						<label>Sabnzbd API Key</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_key', array('class'=>'form-control'));?>
	  						</div>
	  						<div class="form-group col-sm-6 ">
		  						<label>Porcentaje de aviso de disco lleno</label>
	      							<?php echo CHtml::activeTextField($modelDevice, 'disc_min_size_warning', array('class'=>'form-control', 'onkeyup'=>'checkPercentaje(this);'));?>
	      					</div>  
	  					</div>
	  					<div class="row">
		  					<div class="form-group col-sm-6">
	    						<label>Es Tester</label>
	      							<?php echo CHtml::activeCheckBox($modelDevice, 'is_movie_tester', array('class'=>'form-control'));?>
	  						</div>
	  						<div class="form-group col-sm-6 ">
	      					</div>  
	  					</div>
  				</div>
  					
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="acceptDevice();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Crear</button>
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