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
	'dataProvider'=>$model->searchMovie(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'idImdb',
			'value'=>'$data->myMovieDiscNzb->myMovieNzb->imdb',
		),
		array(
 			'name'=>"is_draft",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("is_draft",$data->is_draft,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
					array(
						array('id'=>'0','value'=>'No'),
						array('id'=>'1','value'=>'Yes')
					)
			,'id','value'
			),
		),
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
			'value'=>'$data->myMovieDiscNzb->myMovieNzb->original_title',
		),
		array(
 			'name'=>'year',
			'value'=>'$data->myMovieDiscNzb->myMovieNzb->production_year',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->myMovieDiscNzb->myMovieNzb->genre',
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
