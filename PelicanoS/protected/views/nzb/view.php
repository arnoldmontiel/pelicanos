<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$model->imdbData->ID,
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Update Nzb', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Update Subtitle', 'url'=>array('findSubtitle', 'id'=>$model->Id)),
	array('label'=>'Upload Subtitle', 'url'=>array('uploadSubtitle', 'id'=>$model->Id)),
	array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>View Nzb</h1>

	<div class="left" style="display: inline-block;">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('file_name'),
			'type'=>'raw',
			'value'=>CHtml::link($model->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb')))
		),
		array('label'=>$model->getAttributeLabel('subt_file_name'),
			'type'=>'raw',
			'value'=>CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles')))
		),
		subt_original_name,
		array('label'=>$model->getAttributeLabel('ID'),
			'type'=>'raw',
			'value'=>$model->imdbData->ID
		),
		array('label'=>$model->getAttributeLabel('Title'),
			'type'=>'raw',
			'value'=>$model->imdbData->Title
		),
		array('label'=>$model->getAttributeLabel('Year'),
			'type'=>'raw',
			'value'=>$model->imdbData->Year
		),
		array('label'=>$model->getAttributeLabel('Rated'),
			'type'=>'raw',
			'value'=>$model->imdbData->Rated
		),
		array('label'=>$model->getAttributeLabel('Released'),
			'type'=>'raw',
			'value'=>$model->imdbData->Released
		),
		array('label'=>$model->getAttributeLabel('Genre'),
			'type'=>'raw',
			'value'=>$model->imdbData->Genre
		),
		array('label'=>$model->getAttributeLabel('Director'),
			'type'=>'raw',
			'value'=>$model->imdbData->Director
		),
		array('label'=>$model->getAttributeLabel('Writer'),
			'type'=>'raw',
			'value'=>$model->imdbData->Writer
		),
		array('label'=>$model->getAttributeLabel('Actors'),
			'type'=>'raw',
			'value'=>$model->imdbData->Actors
		),
		array('label'=>$model->getAttributeLabel('Plot'),
			'type'=>'raw',
			'value'=>$model->imdbData->Plot
		),
		array('label'=>$model->getAttributeLabel('Runtime'),
			'type'=>'raw',
			'value'=>$model->imdbData->Runtime
		),
		array('label'=>$model->getAttributeLabel('Rating'),
			'type'=>'raw',
			'value'=>$model->imdbData->Rating
		),
		array('label'=>$model->getAttributeLabel('Votes'),
			'type'=>'raw',
			'value'=>$model->imdbData->Votes
		),
		array('label'=>$model->getAttributeLabel('Response'),
			'type'=>'raw',
			'value'=>$model->imdbData->Response
		),
	),
)); ?>
</div>
	<div class="right" style="display: inline-block; vertical-align: top;">
<?php echo CHtml::image( $model->imdbData->Poster, $model->imdbData->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>

</div>
