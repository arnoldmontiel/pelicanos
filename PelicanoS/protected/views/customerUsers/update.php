<?php
$this->breadcrumbs=array(
	'Customer Users'=>array('index'),
	$model->username=>array('view','id'=>$model->username),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerUsers', 'url'=>array('index')),
	array('label'=>'Create CustomerUsers', 'url'=>array('create')),
	array('label'=>'View CustomerUsers', 'url'=>array('view', 'id'=>$model->username)),
	array('label'=>'Manage CustomerUsers', 'url'=>array('admin')),
);
?>

<h1>Update CustomerUsers <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>