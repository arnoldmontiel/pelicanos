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
			'value'=>'$data->myMovieMovie->imdb',
		),
		'file_name',
		'subt_file_name',
		array(
 			'name'=>"deleted",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("deleted",$data->deleted,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
						array('id'=>'0','value'=>'No'),
						array('id'=>'1','value'=>'Yes')
					)
					,'id','value'
				),
		),
		array(
 			'name'=>'title',
			'value'=>'$data->myMovieMovie->original_title',
		),
		array(
 			'name'=>'year',
			'value'=>'$data->myMovieMovie->production_year',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->myMovieMovie->genre',
		),
		array(
 			'name'=>'resourceTypeDesc',
			'value'=>'$data->resourceType->description',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
