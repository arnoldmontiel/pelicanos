<?php

$this->menu=array(
	array('label'=>'Ripped', 'url'=>array('indexRipped', 'id'=>$idCustomer)),
);
?>

<h1>Ripped data</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'original_title',
		'production_year',
		'type',
		'genre',
		'country',
		'video_standard',
		'description',
		'extra_features',
		'studio',
		'running_time',
		'parental_rating_desc',
		'rating',
		'imdb',
	),
)); 

?>
