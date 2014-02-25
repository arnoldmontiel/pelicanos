<?php 
	$title = "&nbsp;";
	$modelNzb = $modalAutoRipper->nzb;
	if(isset($modelNzb))
	{
		if(isset($modelNzb->myMovieDiscNzb))
		{
			$modeMyMovieNzb = $modelNzb->myMovieDiscNzb->myMovieNzb;
			$title = $modeMyMovieNzb->original_title;
			$year = $modeMyMovieNzb->production_year;
			if(!empty($year))
				$title = $title . ' ('.$year.')';
		}
	}
?>
<form id="form-reject-confirm" method="post">
	<?php echo CHtml::activeHiddenField($modelNzb, 'Id');?>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title"><?php echo $title;?></h4>
      		</div>
      		<div class="modal-body">
  				<div class="form-group">
  					<label for="campoNombre">Raz&oacute;n</label>
  					<?php 
    					echo CHtml::activeTextArea($modelNzb, 'reject_note', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Escriba una raz&oacute;n...'));
    				?>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveReject();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-ban"></i> Rechazar</button>
      		</div>
    	</div><!-- /.modal-content -->
    	<script type="text/javascript">

			$("#form-reject-confirm").submit(function(e)
			{
				var formURL = "<?php echo NzbController::createUrl("AjaxSaveRejectConfirm"); ?>";
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
			    	$('#myModalGeneric').trigger('click');
			    	$("#movieItem_draft_" + <?php echo $modelNzb->Id;?>).hide();
					var obj = jQuery.parseJSON(data);				
					if(obj != null)
					{
						$('#a-tab-uploading').children().text(obj.uploadingQty);
						$('#a-tab-draft').children().text(obj.draftQty);
						$('#a-tab-approved').children().text(obj.approvedQty);
						$('#a-tab-rejected').children().text(obj.cancelledQty);
					}
			    },
			     error: function(jqXHR, textStatus, errorThrown)
			     {
			     }         
			    });
			    e.preventDefault(); //Prevent Default action.
			});
		
			function saveReject()
			{				
				$('#form-reject-confirm').submit();
			}
		</script>
  	</div><!-- /.modal-dialog -->
</form>