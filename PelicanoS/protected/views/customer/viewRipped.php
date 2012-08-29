<?php

$this->menu=array(
	array('label'=>'Ripped', 'url'=>array('indexRipped', 'id'=>$idCustomer)),
);
?>
<?php
Yii::app()->clientScript->registerScript('viewRipped', "
	$('#page').css('background-image','url(./images/".$model->backdrop.")');
");
?>
<h1>Ripped data</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($model->type); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($model->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('country')); ?>:</b>
		<?php echo CHtml::encode($model->country); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('video_standard')); ?>:</b>
		<?php echo CHtml::encode($model->video_standard); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('extra_features')); ?>:</b>
		<?php echo CHtml::encode($model->extra_features); ?>
		<br />
				
		<b><?php echo CHtml::encode($model->getAttributeLabel('studio')); ?>:</b>
		<?php echo CHtml::encode($model->studio); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('running_time')); ?>:</b>
		<?php echo CHtml::encode($model->running_time); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('parental_rating_desc')); ?>:</b>
		<?php echo CHtml::encode($model->parental_rating_desc); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('rating')); ?>:</b>
		<?php echo CHtml::encode($model->rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('imdb')); ?>:</b>
		<?php echo CHtml::encode($model->imdb); ?>
		<br />
		
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->poster, $model->original_title,array('id'=>'myMovie_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>