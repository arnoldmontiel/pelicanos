<?php
Yii::app()->clientScript->registerScript(__CLASS__.'index-nzb', "
	   				
$('#a-tab-uploading').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabUploading') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabUploading').html(data);
		});
});

$('#a-tab-draft').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabDraft') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabDraft').html(data);
		});
});
	   				
$('#a-tab-approved').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabApproved') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabApproved').html(data);
		});
});

$('#a-tab-published').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabPublished') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabPublished').html(data);
		});
});

$('#a-tab-rejected').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabRejected') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabRejected').html(data);
		});
});
$('#a-tab-deleted').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxOpenTabDeleted') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabDeleted').html(data);
		});
});
");
?>
<script type="text/javascript">
function searchTabApproved(value)
{
	$.post("<?php echo NzbController::createUrl('AjaxSearchTabApproved'); ?>",
			{
				value:value
			}
		).success(
			function(data){
				$('#tabApproved').html(data);
			});
	return false;
}

function searchTabDraft(value)
{
	$.post("<?php echo NzbController::createUrl('AjaxSearchTabDraft'); ?>",
			{
				value:value
			}
		).success(
			function(data){
				$('#tabDraft').html(data);
			});
	return false;
}

function changeNzbType(idNzb, obj)
{
	var changeOk = $("#change-ok-"+idNzb);
	var ddlNzb = $("#ddl-nzb-"+idNzb);
	$.post("<?php echo NzbController::createUrl('AjaxChangeNzbType'); ?>",
			{
				idNzb:idNzb,
				idNzbType:obj.value
			}
		).success(
			function(data){
				ddlNzb.hide();
				
				changeOk.animate({opacity: 'show'},240);
				changeOk.animate({opacity: 'hide'},3000, function(){
					ddlNzb.show();
					});
			});
	return false;	
}

function approveNzb(id)
{
	if($('#hasMain').val() == 0)
	{
		$('#status-error').show();	
		return false;
	}
	
	$.post("<?php echo NzbController::createUrl('AjaxApproveNzb'); ?>",
			{
				idNzb:id
			}
		).success(
			function(data){
				$("#movieItem_draft_" + id).hide();
				$('#myModalGeneric').trigger('click');	  
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#a-tab-uploading').children().text(obj.uploadingQty);
					$('#a-tab-draft').children().text(obj.draftQty);
					$('#a-tab-approved').children().text(obj.approvedQty);
					$('#a-tab-rejected').children().text(obj.cancelledQty);
				}
			});
}

function approveConfirm(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxOpenApproveConfirm'); ?>",
			{
				idAutoripper:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
			});
	return false;
}

function publishNzb(id)
{
	if($('#hasMain').val() == 0)
	{
		$('#status-error').show();	
		return false;
	}

	var points = $('#nzb-points').val();
	
	$.post("<?php echo NzbController::createUrl('AjaxPublishNzb'); ?>",
			{
				idNzb:id,
				points:points
			}
		).success(
			function(data){
				$("#movieItem_approved_" + id).hide();
				$('#myModalGeneric').trigger('click');	  
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#a-tab-uploading').children().text(obj.uploadingQty);
					$('#a-tab-draft').children().text(obj.draftQty);
					$('#a-tab-approved').children().text(obj.approvedQty);
					$('#a-tab-rejected').children().text(obj.cancelledQty);
				}
			});
}

function updatePoints(id)
{
	$("#edit_"+id).addClass('hidden');
	$("#save_"+id).removeClass('hidden');
	$("#cancel_"+id).removeClass('hidden');
	$(".btn100").addClass('disabled');
	$("#nzb-grid_published :input[idnzb='"+id+"']").each(function(){
    	$(this).removeAttr('disabled');
	});
}

function cancelEditPoints(id)
{
	$.fn.yiiGridView.update('nzb-grid_published');
}

function savePoints(id)
{
	var obj = $("#nzb-grid_published :input[idnzb='"+id+"']");	
	$.post("<?php echo NzbController::createUrl('AjaxUpdatePoints'); ?>",
			{
				idNzb:id,
				points:obj.val()
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('nzb-grid_published');
			});
	return false;

	
}

function publishConfirm(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxOpenPublishConfirm'); ?>",
			{
				idAutoripper:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
			});
	return false;
}

function rejectConfirm(id)
{	
	$.post("<?php echo NzbController::createUrl('AjaxOpenRejectConfirm'); ?>",
			{
				idAutoripper:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
			});
	return false;
}

function rejectNzb(id, obj)
{
	$.post("<?php echo NzbController::createUrl('AjaxRejectNzb'); ?>",
			{
				idNzb:id
			}
		).success(
			function(data){
				$("#movieItem_draft_" + id).hide();
				$('#myModalGeneric').trigger('click');	  
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#a-tab-uploading').children().text(obj.uploadingQty);
					$('#a-tab-draft').children().text(obj.draftQty);
					$('#a-tab-approved').children().text(obj.approvedQty);
					$('#a-tab-rejected').children().text(obj.cancelledQty);
				}
			});
}

function viewVideoInfo(id, tab)
{
	tab = typeof tab !== 'undefined' ? tab : 1;
	$.post("<?php echo NzbController::createUrl('AjaxOpenViewVideoInfo'); ?>",
			{
				idAutoripper:id,
				activeTab:tab
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
			});
	return false;
}

function viewDownloads(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxOpenViewDownload'); ?>",
			{
				idNzb:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
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
				$('#myModalGeneric').html(data);
		   		$('#myModalGeneric').modal('show');	  
			});
	return false;
}

function editVideoInfo(id)
{
	var params = '&idNzb=' + id;
	window.location = <?php echo '"'. NzbController::createUrl('editVideoInfo') . '"'; ?> + params; 
	return false;
}

function deletePublication(idNzb)
{
	if (confirm('¿Desea eliminarla del marketplace?')) 
	{
		$.post("<?php echo NzbController::createUrl('AjaxDeletePublication'); ?>",
			{
			id:idNzb
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('nzb-grid_published');
			});
		return false;
	}
	return false;	
}

function publicAgain(idNzb)
{
	if (confirm('¿Desea volver a publicar?')) 
	{
		$.post("<?php echo NzbController::createUrl('AjaxRePublic'); ?>",
			{
			id:idNzb
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('nzb-grid_deleted');
			});
		return false;
	}
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
		        <li><a id="a-tab-published" href="#tabPublished" data-toggle="tab">Publicadas</a></li>
		        <li><a id="a-tab-rejected" href="#tabRejected" data-toggle="tab">Rechazadas <span class="badge"><?php echo $cancelledQty; ?></span></a></li>
		        <li><a id="a-tab-deleted" href="#tabDeleted" data-toggle="tab">Eliminadas <span class="badge"></span></a></li>
	      	</ul>
			<div class="tab-content">
				<div class="tab-pane" id="tabUploading">
					<?php echo $this->renderPartial('_tabUploading',array('modelAutoRipper'=>$modelAutoRipper)); ?>
				</div><!-- /.tab1 --> 
			    <div class="tab-pane active" id="tabDraft">
			    	<?php echo $this->renderPartial('_tabDraft',array('modelNzbDraft'=>$modelNzbDraft, 'filter'=>'')); ?>
			    </div><!-- /.tab2 --> 
			    <div class="tab-pane" id="tabApproved">
			    	<?php echo $this->renderPartial('_tabApproved',array('modelNzbApproved'=>$modelNzbApproved, 'filter'=>'')); ?>
			    </div><!-- /.tab3 -->      	
			    <div class="tab-pane" id="tabPublished">
			    	<?php echo $this->renderPartial('_tabPublished',array('modelNzb'=>$modelNzb)); ?>
			    </div><!-- /.tab4 -->
			    <div class="tab-pane" id="tabRejected">
			    	<?php echo $this->renderPartial('_tabRejected',array('modelNzb'=>$modelNzb)); ?>
			    </div><!-- /.tab5 -->
			    <div class="tab-pane" id="tabDeleted">
			    	<?php echo $this->renderPartial('_tabDeleted',array('modelNzb'=>$modelNzb)); ?>
			    </div><!-- /.tab5 -->
			</div><!-- /.tab-content -->
	   </div><!-- /.col-sm-12 --> 
	</div><!-- /.row --> 
</div><!-- /container --> 
