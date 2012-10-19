<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Create Automatic</h1>

<?php 
echo $this->renderPartial('_formAutomatic', array('model'=>$model,
											'modelUpload'=>$modelUpload, 
											'modelSearchDiscRequest'=>$modelSearchDiscRequest, 
											'ddlRsrcType'=>$ddlRsrcType,
											'arrayDataProvider'=>$arrayDataProvider,
									));
?>
