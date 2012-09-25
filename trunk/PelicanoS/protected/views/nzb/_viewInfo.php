<div class="movie-index-view" >

	<div class="left-movie-info-view" >
	<?php
		echo CHtml::image($model->poster_original,$model->original_title,array('id'=>'Poster_img', 'style'=>'height: 200px;width: 125px;')
                            );
		?>
	</div>
	<div class="right-movie-info-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->original_title); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('local_title')); ?>:</b>
		<?php echo CHtml::encode($model->local_title); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('running_time')); ?>:</b>
		<?php echo CHtml::encode($model->running_time); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('imdb')); ?>:</b>
		<?php echo CHtml::encode($model->imdb); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($model->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('studio')); ?>:</b>
		<?php echo CHtml::encode($model->studio); ?>
		<br />
		
	</div>
	<div class="footer-movie-info-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->description); ?>
		<br />
	</div>
</div>