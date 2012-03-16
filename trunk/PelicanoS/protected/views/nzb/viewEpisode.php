<?php

if($model->imdbDataTv->idParent->Deleted_serie == 1)
{
	$this->menu=array(
		array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
		array('label'=>'Re-create Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteEpisode','id'=>$model->Id),'confirm'=>'Are you sure you want to re-create this item?')),
		array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
	);
}
else {
	$this->menu=array(
		array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
		array('label'=>'Update Nzb', 'url'=>array('updateEpisode', 'id'=>$model->Id)),
		array('label'=>'Update Subtitle', 'url'=>array('findSubtitle', 'id'=>$model->Id)),
		array('label'=>'Upload Subtitle', 'url'=>array('uploadSubtitle', 'id'=>$model->Id)),
		array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteEpisode','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
	);
}


?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(".$model->imdbDataTv->Backdrop.")');
");
?>
<h1>View Nzb</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($model->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('subt_file_name')); ?>:</b>
		<?php echo CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('subt_original_name')); ?>:</b>
		<?php echo CHtml::encode($model->subt_original_name); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('ID')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->ID); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rated')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Rated); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Released')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Released); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Director); ?>
		<br />
				
		<b><?php echo CHtml::encode($model->getAttributeLabel('Writer')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Writer); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Actors); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Plot); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Runtime); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($model->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Votes')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Votes); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Serie')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->idParent->Title); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Season')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Season); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Episode')); ?>:</b>
		<?php echo CHtml::encode($model->imdbDataTv->Episode); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('points')); ?>:</b>
		<?php echo CHtml::encode($model->points); ?>
		<br />
		
		<?php if($model->imdbDataTv->idParent->Deleted_serie == 1){ ?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('State')); ?>:</b>
		<span class="deleted">Deleted</span>
		<br />
		<?php } ?>
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->imdbDataTv->Poster_local, $model->imdbDataTv->Title,array('id'=>'imdbDataTv_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>

