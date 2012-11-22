<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->myMovieDisc->myMovie->poster,$data->myMovieDisc->myMovie->original_title,array('id'=>'myMovie_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewSummaryRipped', 'id'=>$data->Id_my_movie_disc));
		?>
	</div>
	<div class="right-movie-view" >
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDisc->myMovie->original_title); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDisc->myMovie->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDisc->myMovie->type); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDisc->myMovie->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Disc Name')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDisc->name); ?>
		<br />
	</div>
</div>