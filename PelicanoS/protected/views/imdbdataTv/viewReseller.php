<?php
$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('indexReseller')),
);
?>

<h1>View Serie Tv</h1>
<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($model->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($model->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rated')); ?>:</b>
		<?php echo CHtml::encode($model->Rated); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Released')); ?>:</b>
		<?php echo CHtml::encode($model->Released); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($model->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($model->Director); ?>
		<br />
				
		<b><?php echo CHtml::encode($model->getAttributeLabel('Writer')); ?>:</b>
		<?php echo CHtml::encode($model->Writer); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($model->Actors); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($model->Plot); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($model->Runtime); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($model->Rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Votes')); ?>:</b>
		<?php echo CHtml::encode($model->Votes); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Seasons')); ?>:</b>
		<?php 
		$index = 1;
		while ($index <= count($model->seasons)) {
			echo CHtml::link($index,array('viewSeasonReseller','id'=>$model->ID, 'season'=>$index)). ' <span>|</span> ';
			$index = $index + 1;
		}?>
		<br />
		<?php if($model->Deleted_serie == 1){ ?>
				<b><?php echo CHtml::encode($model->getAttributeLabel('State')); ?>:</b>
				<span class="deleted">Deleted</span>
				<br />
			<?php } ?>
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->Poster_local, $model->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>
