<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->myMovie->poster,$data->myMovie->original_title,array('id'=>'myMovie_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewRipped', 'id'=>$data->Id_my_movie));
		?>
	</div>
	<div class="right-movie-view" >
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($data->myMovie->original_title); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($data->myMovie->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($data->myMovie->type); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($data->myMovie->genre); ?>
		<br />
	</div>
</div>