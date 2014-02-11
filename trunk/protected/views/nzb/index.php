<script type="text/javascript">
function viewVideoInfo(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxOpenViewVideoInfo'); ?>",
			{
				idAutoripper:id
			}
		).success(
			function(data){
				$('#myModalViewVideoInfo').html(data);
		   		$('#myModalViewVideoInfo').modal('show');	  
			});
	return false;
}

function viewStateHistory(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxViewStateHistory'); ?>",
			{
				idAutoripper:id
			}
		).success(
			function(data){
				$('#myModalAutoRipperStates').html(data);
		   		$('#myModalAutoRipperStates').modal('show');	  
			});
	return false;
}

function editVideoInfo(id)
{
	var params = '&idNzb=' + id;
	window.location = <?php echo '"'. NzbController::createUrl('editVideoInfo') . '"'; ?> + params; 
	return false;
}
	
</script>

<div class="container" id="screenInicio">
	<h1 class="pageTitle">Pel&iacute;culas</h1>
	<div class="row">
	    <div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a id="a-tab-uploading" href="#tabUploading" data-toggle="tab">Uploading <span class="badge"><?php echo $uploadingQty; ?></span></a></li>
		        <li class="active"><a id="a-tab-draft" href="#tabDraft" data-toggle="tab">Borradores <span class="badge"><?php echo $draftQty; ?></span></a></li>
		        <li><a id="a-tab-approved" href="#tabApproved" data-toggle="tab">Aprobadas <span class="badge"><?php echo $approvedQty; ?></span></a></li>
		        <li><a href="#tabPublished" data-toggle="tab">Publicadas</a></li>
		        <li><a id="a-tab-cancelled" href="#tabRechazadas" data-toggle="tab">Rechazadas <span class="badge"><?php echo $cancelledQty; ?></span></a></li>
	      	</ul>
			<div class="tab-content">
				<div class="tab-pane" id="tabUploading">
					<?php echo $this->renderPartial('_tabUploading',array('modelAutoRipper'=>$modelAutoRipper)); ?>
				</div><!-- /.tab1 --> 
			    <div class="tab-pane active" id="tabDraft">
			    	<?php echo $this->renderPartial('_tabDraft',array('modelNzbDraft'=>$modelNzbDraft)); ?>
			    </div><!-- /.tab2 --> 
			    <div class="tab-pane" id="tabApproved">
			    	<?php echo $this->renderPartial('_tabUploading',array('modelAutoRipper'=>$modelAutoRipper)); ?>
			    </div><!-- /.tab3 -->      	
			    <div class="tab-pane" id="tabPublished">
			    	<?php echo $this->renderPartial('_tabUploading',array('modelAutoRipper'=>$modelAutoRipper)); ?>
			    </div><!-- /.tab4 -->
			    <div class="tab-pane" id="tabRechazadas">
			    	<?php echo $this->renderPartial('_tabRejected',array('modelNzb'=>$modelNzb)); ?>
			    </div><!-- /.tab5 -->
			</div><!-- /.tab-content -->
	   </div><!-- /.col-sm-12 --> 
	</div><!-- /.row --> 
</div><!-- /container --> 
