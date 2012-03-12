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
	'dataProvider'=>$model->searchNzbMovies(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'idImdb',
			'value'=>'$data->imdbData->ID',
		),
		'file_name',
		'subt_file_name',
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
			'value'=>'$data->imdbData->Title',
		),
		array(
 			'name'=>'year',
			'value'=>'$data->imdbData->Year',
		),
		array(
 			'name'=>'genre',
			'value'=>'$data->imdbData->Genre',
		),
		array(
 			'name'=>'resourceTypeDesc',
			'value'=>'$data->resourceType->description',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'deleteConfirmation'=>'Are you sure you want to Delete/Re-create this item?',
			'buttons'=>array
			(
				'delete' => array
				(
					'label'=>'Delete/Re-create',
			    	'url'=>'Yii::app()->createUrl("nzb/delete", array("id"=>$data->Id))',
				),
			),
		),
	),
)); ?>
