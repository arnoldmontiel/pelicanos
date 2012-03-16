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
		array(
		 			'name'=>"Deleted_serie",
		 			'type'=>'raw',
		 			'value'=>'CHtml::checkBox("deleted_serie",$data->Deleted_serie,array("disabled"=>"disabled"))',
		 			'filter'=>CHtml::listData(
					array(
							array('id'=>'0','value'=>'No'),
							array('id'=>'1','value'=>'Yes')
						)
						,'id','value'
					),
		),
		'Rated',
		'Released',
		'Genre',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
