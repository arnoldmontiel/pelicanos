<?php
$this->breadcrumbs=array(
	'Anydvdhd Versions'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AnydvdhdVersion', 'url'=>array('index')),
	array('label'=>'Create AnydvdhdVersion', 'url'=>array('create')),
	array('label'=>'View AnydvdhdVersion', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage AnydvdhdVersion', 'url'=>array('admin')),
);
?>

<h1>Update AnydvdhdVersion <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>