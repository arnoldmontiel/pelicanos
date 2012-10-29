<?php
$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb', 'url'=>array('index')),
);

?>

<h1>Manage Season</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'season_number',
			'value'=>'$data->season_number',
		),
		array(
 			'name'=>'season_number',
			'value'=>'$data->myMovieSerieHeader->name',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
				(
					'update' => array
					(
						'url'=>'Yii::app()->createUrl("nzb/updateSeason", array("id"=>$data->Id))',
					),
				),
		),
	),
)); ?>
