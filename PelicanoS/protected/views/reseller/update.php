<?php
$this->breadcrumbs=array(
	'Resellers'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reseller', 'url'=>array('index')),
	array('label'=>'Create Reseller', 'url'=>array('create')),
	array('label'=>'View Reseller', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Reseller', 'url'=>array('admin')),
);
?>

<h1>Update Reseller <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>