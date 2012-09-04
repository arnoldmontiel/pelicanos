<?php
$this->breadcrumbs=array(
	'Resellers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reseller', 'url'=>array('index')),
	array('label'=>'Manage Reseller', 'url'=>array('admin')),
);
?>

<h1>Create Reseller</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelUser'=>$modelUser,)); ?>