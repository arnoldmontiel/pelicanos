<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Create Movie</h1>

<?php 
echo $this->renderPartial('_formMovie', array('model'=>$model,
											'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest, 
											'ddlRsrcType'=>$ddlRsrcType,
											'arrayDataProvider'=>$arrayDataProvider,
									));
?>
