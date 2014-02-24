<form id="request-device-form" method="post">
	<?php
		echo CHtml::activeHiddenField($modelCustomer, 'Id');
	?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Solicitar Dispositivo</h4>
      		</div>
      		<div class="modal-body">
      		<div class="panel panel-default panelCliente">
  <div class="panel-body">
   Cliente
   <div class="infoPanelCliente">
   <div class="bold">Arnold Montiel</div>
      		<div>Lobos 1747</div>
  </div></div>
</div>
      		
  				<div class="form-group">
					<label for="campoNombre">Descripci&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelDevice, 'description', array('class'=>'form-control')); ?>
			  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveRequest();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Solicitar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#request-device-form").submit(function(e)
		{
			var formURL = "<?php echo CustomerController::createUrl("AjaxSaveRequestDevice"); ?>";
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
		    	$.fn.yiiGridView.update("customer-grid");
	    		$('#myModalGeneric').trigger('click');
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function saveRequest()
	{				
		$('#request-device-form').submit();
	}
</script>