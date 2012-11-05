<?php

$this->menu=array(
	array('label'=>'Ripped', 'url'=>array('summaryRipped', 'id'=>$idCustomer)),
);
?>
<?php
Yii::app()->clientScript->registerScript('viewRipped', "
	$('#page').css('background-image','url(./images/".$model->myMovie->backdrop.")');
");
?>
<h1>Ripped data</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->type); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('country')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->country); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('video_standard')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->video_standard); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('extra_features')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->extra_features); ?>
		<br />
				
		<b><?php echo CHtml::encode($model->getAttributeLabel('studio')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->studio); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('running_time')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->running_time); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('parental_rating_desc')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->parental_rating_desc); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('rating')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('imdb')); ?>:</b>
		<?php echo CHtml::encode($model->myMovie->imdb); ?>
		<br />
		
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->myMovie->poster, $model->myMovie->original_title,array('id'=>'myMovie_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>