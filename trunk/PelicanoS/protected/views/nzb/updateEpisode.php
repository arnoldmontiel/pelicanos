<?php

$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'View Nzb', 'url'=>array('viewEpisode', 'id'=>$model->Id)),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Update Nzb</h1>

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
			 	'value'=>'Cancel',
		 		'cssFile'=>'',
			 	'onclick'=>'js:function(){
			 		window.location = "'.NzbController::createUrl('viewEpisode',array('id'=>$model->Id)).'";
			 		return false;
				}',
		 	)
		 );
	 ?>		 