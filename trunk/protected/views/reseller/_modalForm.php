<form id="reseller-form" method="post">
	<?php
		if(!$modelReseller->isNewRecord)
			echo CHtml::activeHiddenField($modelReseller, 'Id');
	?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Agregar Reseller</h4>
      		</div>
      		<div class="modal-body">
  				<div class="form-group">
					<label for="campoNombre">Descripci&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelReseller, 'description', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Usuario</label>
			  		<?php echo CHtml::activeTextField($modelUser, 'username', array('class'=>'form-control', 'disabled'=>(!$modelReseller->isNewRecord)?'disabled':'')); ?>
			 	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Password</label>
			  		<?php echo CHtml::activeTextField($modelUser, 'password', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">E-mail</label>
			  		<?php echo CHtml::activeTextField($modelUser, 'email', array('class'=>'form-control')); ?>
			  	</div>
			  	<div id="status-error" style="display:none;"  class="estadoModal">
					<label for="campoLineal">Estado</label>
      				<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
      					<span id="errorMsg">caramba</span>
 					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveReseller();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#reseller-form").submit(function(e)
		{
			var formURL = "<?php echo ResellerController::createUrl("AjaxSaveReseller"); ?>";
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
		    	var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#errorMsg').text(obj.username);
					$('#status-error').show();
				}
				else
				{
					$.fn.yiiGridView.update("reseller-grid");
		    		$('#myModalGeneric').trigger('click');
				}
		    	
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function saveReseller()
	{				
		$('#reseller-form').submit();
	}
</script>