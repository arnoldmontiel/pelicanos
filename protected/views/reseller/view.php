<?php
$this->breadcrumbs=array(
	'Resellers'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Reseller', 'url'=>array('index')),
	array('label'=>'Create Reseller', 'url'=>array('create')),
	array('label'=>'Update Reseller', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Reseller', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reseller', 'url'=>array('admin')),
);
?>

<h1>View Reseller #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
