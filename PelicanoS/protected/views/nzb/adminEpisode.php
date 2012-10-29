<?php
$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
);

?>

<h1>Manage Episode</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'name',
			'value'=>'$data->myMovieSeason->myMovieSerieHeader->name',
		),
		array(
 			'name'=>'name',
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
			'value'=>'$data->description',
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
