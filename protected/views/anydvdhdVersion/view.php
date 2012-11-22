<?php
$this->breadcrumbs=array(
	'Anydvdhd Versions'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List AnydvdhdVersion', 'url'=>array('index')),
	array('label'=>'Create AnydvdhdVersion', 'url'=>array('create')),
	array('label'=>'Update AnydvdhdVersion', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete AnydvdhdVersion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AnydvdhdVersion', 'url'=>array('admin')),
);
?>

<h1>View AnydvdhdVersion #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'version',
		'file_name',
		'file_path',
		'date',
	),
)); ?>
