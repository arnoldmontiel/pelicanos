<?php
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Device', 'url'=>array('index')),
	array('label'=>'Create Device', 'url'=>array('create')),
	array('label'=>'View Device', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Device', 'url'=>array('admin')),
);
?>

<h1>Update Device <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
	'modelClientSettings'=>$modelClientSettings,
	'modelSettingsRipper'=>$modelSettingsRipper)); 
?>