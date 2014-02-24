<script type="text/javascript">
function viewDownloads(id)
{
	$.post("<?php echo NzbController::createUrl('AjaxOpenViewDownloadByReseller'); ?>",
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
</script>

<div class="container" id="screenInicio">
	<h1 class="pageTitle">Pel&iacute;culas</h1>
	<div class="row">
	    <div class="col-sm-12">
			<div class="tab-content">
			    <?php echo $this->renderPartial('_tabPublishedRe',array('modelNzb'=>$modelNzb)); ?>
			</div><!-- /.tab-content -->
	   </div><!-- /.col-sm-12 --> 
	</div><!-- /.row --> 
</div><!-- /container --> 
