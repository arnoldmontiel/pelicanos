<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
);
?>

<h1>Create Movie</h1>

<?php 
echo $this->renderPartial('_formMovie', array('model'=>$model,
											'modelUpload'=>$modelUpload, 
											'modelSearchDiscRequest'=>$modelSearchDiscRequest, 
											'ddlRsrcType'=>$ddlRsrcType,
											'arrayDataProvider'=>$arrayDataProvider
									));
?>
