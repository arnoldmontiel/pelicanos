<?php
$this->breadcrumbs=array(
	'Client Settings'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List ClientSettings', 'url'=>array('index')),
	array('label'=>'Create ClientSettings', 'url'=>array('create')),
	array('label'=>'Update ClientSettings', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ClientSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientSettings', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript('client_settings', "
$('#update-button').click(function(){
	jQuery('#waiting').dialog('open');
	$.post('".ClientSettingsController::CreateUrl('AjaxUpdateClientToLastVersion')."',{Id:".$model->Id."},
	function(){
		jQuery('#waiting').dialog('close');
		});
	return false;
});

");

$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('none'),
			'idDialog'=>'waiting',
));

?>

<h1>Client Settings </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>'Customer',value=>$model->customer->last_name.' '.$model->customer->name),
		'Id_device',
		'ip_v4',
		'ip_v6',
		'port_v4',
		'port_v6',
		'last_update',
		'anydvd_version_installed',
		'anydvd_version_downloaded',
		'need_update',
),
)); ?>

<?php 
	echo CHtml::button('Update',array('id'=>'update-button'));
?>

