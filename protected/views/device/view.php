<?php
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Device', 'url'=>array('index')),
	array('label'=>'Create Device', 'url'=>array('create')),
	array('label'=>'Update Device', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Device', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Device', 'url'=>array('admin')),
);
?>

<h1>Device <?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>'Device','value'=>$model->Id),
		array('label'=>'Customer','value'=>$modelClientSettings->customer->last_name.' '.$modelClientSettings->customer->name),
		'description',
	),
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelClientSettings,
	'attributes'=>array(
		'ip_v4',
		'ip_v6',
		'port_v4',
		'port_v6',
		'anydvd_version_installed',
		'anydvd_version_downloaded',
		'need_update',
		'last_update',
),
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelSettingsRipper,
	'attributes'=>array(
		'drive_letter',
		'temp_folder_ripping',
		'final_folder_ripping',
		'time_from_reboot',
		'time_to_reboot',
		'mymovies_username',
		'mymovies_password',
		'last_update',
	),
)); ?>


