<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$model->imdbData->ID=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'View Nzb', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Update Nzb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelUpload'=>$modelUpload, 'modelImdb'=>$modelImdb)); ?>