<?php

$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Update Nzb', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Update Subtitle', 'url'=>array('findSubtitle', 'id'=>$model->Id)),
	array('label'=>'Upload Subtitle', 'url'=>array('uploadSubtitle', 'id'=>$model->Id)),
	array('label'=>'Backdrop', 'url'=>array('backdrop', 'id'=>$model->Id)),
	array('label'=>($model->deleted == 1)?'Re-create Nzb':'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>($model->deleted == 1)?'Are you sure you want to re-create this item?':'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
);



?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(".$model->imdbData->Backdrop.")');
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
		<?php echo CHtml::encode($model->imdbData->ID); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rated')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Rated); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Released')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Released); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Director); ?>
		<br />
				
		<b><?php echo CHtml::encode($model->getAttributeLabel('Writer')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Writer); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Actors); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Plot); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Runtime); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($model->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Votes')); ?>:</b>
		<?php echo CHtml::encode($model->imdbData->Votes); ?>
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
		<?php echo CHtml::image( "./images/".$model->imdbData->Poster_local, $model->imdbData->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>

