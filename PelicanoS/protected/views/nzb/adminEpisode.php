<?php
$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
);

?>

<h1>Manage Nzbs Episodes</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->searchNzbEpisodes(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'idImdb',
			'value'=>'$data->imdbDataTv->ID',
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
 			'name'=>"deleted_serie",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("deleted_serie",$data->imdbDataTv->idParent->Deleted_serie,array("disabled"=>"disabled"))',
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
			'value'=>'$data->imdbDataTv->Title',
		),
		array(
 			'name'=>'year',
			'value'=>'$data->imdbDataTv->Year',
		),
		array(
 			'name'=>'serie_title',
			'value'=>'$data->imdbDataTv->idParent->Title',
		),
		array(
 			'name'=>'season',
			'value'=>'$data->imdbDataTv->Season',
		),
		array(
 			'name'=>'episode',
			'value'=>'$data->imdbDataTv->Episode',
		),
		array(
 			'name'=>'resourceTypeDesc',
			'value'=>'$data->resourceType->description',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array
			(
			    'view' => array
				(
			    	'url'=>'Yii::app()->createUrl("nzb/viewEpisode", array("id"=>$data->Id))',
				),
			),
		),
	),
)); ?>
