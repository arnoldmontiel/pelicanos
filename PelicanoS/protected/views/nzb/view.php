<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Update Nzb', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>View Nzb #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'url',
		'description',
		array('label'=>$model->getAttributeLabel('file_name'),
			'type'=>'raw',
			'value'=>CHtml::link($model->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb')))
		),
		'subt_url',
		array('label'=>$model->getAttributeLabel('subt_file_name'),
			'type'=>'raw',
			'value'=>CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles')))
		),
	),
)); ?>
