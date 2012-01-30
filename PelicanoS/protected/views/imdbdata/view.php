<?php
$this->breadcrumbs=array(
	'Imdbdatas'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List Imdbdata', 'url'=>array('index')),
	array('label'=>'Create Imdbdata', 'url'=>array('create')),
	array('label'=>'Update Imdbdata', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Imdbdata', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Imdbdata', 'url'=>array('admin')),
);
?>

<h1>View Imdbdata #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Title',
		'Year',
		'Rated',
		'Released',
		'Genre',
		'Director',
		'Writer',
		'Actors',
		'Plot',
		'Poster',
		'Runtime',
		'Rating',
		'Votes',
		'Response',
	),
)); ?>
