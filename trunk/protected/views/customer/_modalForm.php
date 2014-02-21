<form id="customer-form" method="post">
	<?php
		if(!$modelCustomer->isNewRecord)
			echo CHtml::activeHiddenField($modelCustomer, 'Id');
	?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Agregar Cliente</h4>
      		</div>
      		<div class="modal-body">
  				<div class="form-group">
					<label for="campoNombre">Nombre</label>
			  		<?php echo CHtml::activeTextField($modelCustomer, 'name', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Apellido</label>
			  		<?php echo CHtml::activeTextField($modelCustomer, 'last_name', array('class'=>'form-control')); ?>
			 	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Direcci&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelCustomer, 'address', array('class'=>'form-control')); ?>
			  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveCustomer();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#customer-form").submit(function(e)
		{
			var formURL = "<?php echo CustomerController::createUrl("AjaxSaveCustomer"); ?>";
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
	
	function saveCustomer()
	{				
		$('#customer-form').submit();
	}
</script>