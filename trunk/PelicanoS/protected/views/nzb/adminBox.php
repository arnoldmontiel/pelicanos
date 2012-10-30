<?php
$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Serie', 'url'=>array('adminSerie')),
	array('label'=>'Manage Season', 'url'=>array('adminSeason')),
	array('label'=>'Manage Episode', 'url'=>array('adminEpisode')),
);

?>

<h1>Manage Box</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'box-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'original_title',
			'value'=>'$data->original_title',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->genre',
		),
		array(
 			'name'=>'production_year',
			'value'=>'$data->production_year',
		),
		array(
 			'name'=>'studio',
			'value'=>'$data->studio',
		),
		array(
 			'name'=>'description',
			'value'=>'(strlen($data->description) > 300)?substr($data->description,0,300)."...":$data->description',
		),
		array(
 			'name'=>"poster",
 			'type'=>'raw',
 			'value'=>'CHtml::image("images/".$data->poster ,"",array("style"=>"height: 200px;width: 120px;"))',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
				(
					'update' => array
					(
						'url'=>'Yii::app()->createUrl("nzb/updateBox", array("id"=>$data->Id))',
					),
				),
		),
	),
)); ?>
