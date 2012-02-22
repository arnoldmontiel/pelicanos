<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
);

?>

<h1>Manage Nzbs</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->searchNzb(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'idImdb',
			'value'=>'$data->imdbData->ID',
		),
		'file_name',
		'subt_file_name',
		array(
 			'name'=>'title',
			'value'=>'$data->imdbData->Title',
		),
		array(
 			'name'=>'year',
			'value'=>'$data->imdbData->Year',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->imdbData->Genre',
		),
		array(
 			'name'=>'resourceTypeDesc',
			'value'=>'$data->resourceType->description',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
