<?php
$this->breadcrumbs=array(
	'Client Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClientSettings', 'url'=>array('index')),
	array('label'=>'Create ClientSettings', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
});
");
?>

<h1>Manage Client Settings</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'client-settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'customer','value'=>'$data->customer->last_name." ".$data->customer->name '),
		'Id',
		'ip_v4',
		'port_v4',
		'last_update',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
