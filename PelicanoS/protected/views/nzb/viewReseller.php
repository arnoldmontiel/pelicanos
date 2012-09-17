<?php

	$this->menu=array(
		array('label'=>'List Movies', 'url'=>array('indexReseller')),
	);	



?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(".$model->imdbData->Backdrop.")');
");
?>
<h1>View Movie</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
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

