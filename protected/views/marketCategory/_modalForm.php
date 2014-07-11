<form id="market-category-form" method="post">
	<?php
		if(!$modelMarketCategory->isNewRecord)
			echo CHtml::activeHiddenField($modelMarketCategory, 'Id');
	?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Agregar Categor&iacute;a</h4>
      		</div>
      		<div class="modal-body">
  				<div class="form-group">
					<label for="campoNombre">Descripci&oacute;n</label>
			  		<?php echo CHtml::activeTextField($modelMarketCategory, 'description', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Ocultar</label>
			  		<?php echo CHtml::activeCheckBox($modelMarketCategory, 'hide', array('class'=>'form-control')); ?>
			  	</div>
			  	<div class="form-group">
			  		<label for="campoNombre">Orden</label>
			  		<?php
 
			  			echo CHtml::activeDropDownList($modelMarketCategory, 'order', $orderList, array('class'=>'form-control','prompt'=>'Ultimo')); 
			  		?>
			  	</div>
			  	<div id="status-error" style="display:none;"  class="estadoModal">
					<label for="campoLineal">Estado</label>
      				<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
      					<span id="errorMsg">El usuario ya existe, intente con otro.</span>
 					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveCategory();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#market-category-form").submit(function(e)
		{
			var formURL = "<?php echo MarketCategoryController::createUrl("AjaxSaveCategory"); ?>";
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
					$.fn.yiiGridView.update("market-category-grid");
		    		$('#myModalGeneric').trigger('click');
				}
		    	
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function saveCategory()
	{						
		$('#market-category-form').submit();	
	}
</script>