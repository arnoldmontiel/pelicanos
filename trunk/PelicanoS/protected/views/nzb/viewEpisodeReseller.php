<?php
$this->menu=array(
	array('label'=>'List Episodes', 'url'=>array('indexEpisodeReseller')),
);


?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(".$model->imdbDataTv->Backdrop.")');
");
?>
<h1>View Nzb</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >		
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
		
		<?php if($model->imdbDataTv->idParent->Deleted_serie == 1 || $model->deleted == 1){ ?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('State')); ?>:</b>
		<span class="deleted">Deleted</span>
		<br />
		<?php } ?>
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->imdbDataTv->Poster_local, $model->imdbDataTv->Title,array('id'=>'imdbDataTv_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>

