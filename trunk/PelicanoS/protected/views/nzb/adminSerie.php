<?php
$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb', 'url'=>array('index')),
);

?>

<h1>Manage Series</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'serie-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'name',
			'value'=>'$data->name',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->genre',
		),
		array(
 			'name'=>'original_network',
			'value'=>'$data->original_network',
		),
		array(
 			'name'=>'original_status',
			'value'=>'$data->original_status',
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
						'url'=>'Yii::app()->createUrl("nzb/updateSerie", array("id"=>$data->Id))',
					),
				),
		),
	),
)); ?>
