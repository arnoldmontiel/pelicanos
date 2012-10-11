<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->myMovieMovie->poster,$data->myMovieMovie->original_title,array('id'=>'poster_img', 'style'=>'height: 200px;width: 125px;')
							),array('viewReseller', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id Imdb')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->myMovieMovie->imdb), array('view', 'id'=>$data->Id)); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieMovie->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieMovie->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieMovie->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($data->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieMovie->rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Points')); ?>:</b>
		<?php echo CHtml::encode($data->points); ?>
		<br />
		
		<?php if($data->deleted == 1){ ?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
			<span class="deleted">Deleted</span>
			<br />
		<?php } ?>
	</div>
</div>