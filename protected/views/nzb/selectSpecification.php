<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Select Box Specification</h1>

<?php 
echo $this->renderPartial('_selectSpecification', array('model'=>$model,
											'modelSubtitle'=>$modelSubtitle,
											'modelAudioTrack'=>$modelAudioTrack,
											'modelPerson'=>$modelPerson,
											'modelNzbSubtitle'=>$modelNzbSubtitle,
											'modelNzbAudioTrack'=>$modelNzbAudioTrack,
											'modelNzbPerson'=>$modelNzbPerson,
									));
?>
	
