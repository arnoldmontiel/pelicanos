<?php

$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('index')),
	array('label'=>'Create Serie Tv', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('imdbdata-tv-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Imdbdata Tvs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imdbdata-tv-grid',
	'dataProvider'=>$model->searchSeries(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'Title',
		'Year',
		'Rated',
		'Released',
		'Genre',
		/*
		'Director',
		'Writer',
		'Actors',
		'Plot',
		'Poster',
		'Poster_local',
		'Runtime',
		'Rating',
		'Votes',
		'Response',
		'Backdrop',
		'Season',
		'Episode',
		'Id_parent',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
