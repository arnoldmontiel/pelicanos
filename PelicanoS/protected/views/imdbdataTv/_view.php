<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->Poster_local,$data->Title,array('id'=>'ImdbdataTv_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('view', 'id'=>$data->ID));
		?>
	</div>
	<div class="right-movie-view" >
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($data->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->Year); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Rated')); ?>:</b>
		<?php echo CHtml::encode($data->Rated); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Released')); ?>:</b>
		<?php echo CHtml::encode($data->Released); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->Genre); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($data->Director); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Seasons')); ?>:</b>
				<?php echo CHtml::encode(count($data->seasons)); ?>
		<br />
	
	</div>
</div>	