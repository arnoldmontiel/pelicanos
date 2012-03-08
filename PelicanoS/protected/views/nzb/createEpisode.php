<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
);
?>

<h1>Create Episode</h1>

<?php echo $this->renderPartial('_formEpisode', array('model'=>$model,
													'modelUpload'=>$modelUpload, 
													'modelImdb'=>$modelImdb, 
													'ddlRsrcType'=>$ddlRsrcType,
													'ddlTvShow'=>$ddlTvShow,
													'ddlSeason'=>$ddlSeason,
													'ddlEpisode'=>$ddlEpisode)); ?>
<br>
<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'cancel',
			 	'name'=>'Cancel',
			 	'caption'=>'Cancel',
			 	'cssFile'=>'',
			 	'value'=>'Cancel',
			 	'onclick'=>'js:function(){
			 		window.location = "'.NzbController::createUrl('indexEpisode').'";
			 		return false;
				}',
		 	)
		 );
	 ?>		
