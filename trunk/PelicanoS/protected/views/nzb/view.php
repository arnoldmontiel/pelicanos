<?php

$confirm = '';
if($model->deleted == 1)
{
	$confirm = 'Are you sure you want to re-create this item?';
	$this->menu=array(
		array('label'=>'List Nzb Movies', 'url'=>array('index')),
		array('label'=>'Re-create Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>$confirm)),
		array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	);
}
else
{
	$confirm = 'Are you sure you want to delete this item?';
	$this->menu=array(
		array('label'=>'List Nzb Movies', 'url'=>array('index')),
		array('label'=>'Create Nzb', 'url'=>array('create')),
		array('label'=>'Update Nzb', 'url'=>array('update', 'id'=>$model->Id)),
		array('label'=>'Update Subtitle', 'url'=>array('findSubtitle', 'id'=>$model->Id)),
		array('label'=>'Upload Subtitle', 'url'=>array('uploadSubtitle', 'id'=>$model->Id)),
		array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>$confirm)),
		array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	);	
}


?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(./images/".$model->myMovieMovie->backdrop.")');
");
?>
<h1>View Nzb</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($model->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('subt_file_name')); ?>:</b>
		<?php echo CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('subt_original_name')); ?>:</b>
		<?php echo CHtml::encode($model->subt_original_name); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id imdb')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->imdb); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('rating')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('rating_votes')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->rating_votes); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('studio')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->studio); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('running_time')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieMovie->running_time); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($model->resourceType->description); ?>
		<br />
			
		<b><?php echo CHtml::encode($model->getAttributeLabel('points')); ?>:</b>
		<?php echo CHtml::encode($model->points); ?>
		<br />
		
		<?php if($model->deleted == 1){ ?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('State')); ?>:</b>
		<span class="deleted">Deleted</span>
		<br />
		<?php } ?>
		
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->myMovieMovie->poster, $model->myMovieMovie->original_title,array('id'=>'poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>

