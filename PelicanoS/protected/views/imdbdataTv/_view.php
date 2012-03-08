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
	
		<?php /*
		<b><?php echo CHtml::encode($data->getAttributeLabel('Writer')); ?>:</b>
		<?php echo CHtml::encode($data->Writer); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($data->Actors); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($data->Plot); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Poster')); ?>:</b>
		<?php echo CHtml::encode($data->Poster); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Poster_local')); ?>:</b>
		<?php echo CHtml::encode($data->Poster_local); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($data->Runtime); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($data->Rating); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Votes')); ?>:</b>
		<?php echo CHtml::encode($data->Votes); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Response')); ?>:</b>
		<?php echo CHtml::encode($data->Response); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Backdrop')); ?>:</b>
		<?php echo CHtml::encode($data->Backdrop); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Season')); ?>:</b>
		<?php echo CHtml::encode($data->Season); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Episode')); ?>:</b>
		<?php echo CHtml::encode($data->Episode); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_parent')); ?>:</b>
		<?php echo CHtml::encode($data->Id_parent); ?>
		<br />
	
		*/ ?>
	
	</div>
</div>	