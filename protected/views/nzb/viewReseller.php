<?php

	$this->menu=array(
		array('label'=>'List Movies', 'url'=>array('indexReseller')),
	);	



?>

<?php
Yii::app()->clientScript->registerScript('viewNzbReseller', "
	$('#page').css('background-image','url(./images/".$model->myMovieMovie->backdrop.")');
");
?>
<h1>View Movie</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
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

