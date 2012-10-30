<?php
$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Box', 'url'=>array('adminBox')),
	array('label'=>'Manage Serie', 'url'=>array('adminSerie')),
	array('label'=>'Manage Season', 'url'=>array('adminSeason')),
);

?>

<h1>Manage Episode</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'serie_name',
			'value'=>'$data->myMovieSeason->myMovieSerieHeader->name',
		),
		array(
 			'name'=>'season_number',
			'value'=>'$data->myMovieSeason->season_number',
		),
		array(
 			'name'=>'episode_number',
			'value'=>'$data->episode_number',
		),
		array(
 			'name'=>'name',
			'value'=>'$data->name',
		),
		array(
 			'name'=>'description',
			'value'=>'(strlen($data->description) > 300)?substr($data->description,0,300)."...":$data->description',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
				(
					'update' => array
					(
						'url'=>'Yii::app()->createUrl("nzb/updateEpisode", array("id"=>$data->Id))',
					),
				),
		),
	),
)); ?>
