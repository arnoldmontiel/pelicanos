<?php
$this->breadcrumbs=array(
	'Customer Users'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'List CustomerUsers', 'url'=>array('index')),
	array('label'=>'Create CustomerUsers', 'url'=>array('create')),
	array('label'=>'Update CustomerUsers', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Delete CustomerUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustomerUsers', 'url'=>array('admin')),
);
?>

<h1>View CustomerUsers #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'password',
		'parental_control',
		'email',
		'Id_customer',
		'deleted',
		'need_update',
	),
)); ?>
