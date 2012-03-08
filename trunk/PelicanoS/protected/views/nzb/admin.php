<?php
$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
);

?>

<h1>Manage Nzbs Movies</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->searchNzbMovies(),
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
