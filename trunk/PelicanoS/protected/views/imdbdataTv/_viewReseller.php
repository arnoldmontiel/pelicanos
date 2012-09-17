<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->Poster_local,$data->Title,array('id'=>'ImdbdataTv_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array(($data->Id_parent == null)?'viewReseller':'nzb/viewEpisodeReseller', 'id'=>($data->Id_parent == null)?$data->ID:$data->nzbs[0]->Id ));
		?>
	</div>
	<div class="right-movie-view" >
		<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->Title), 
		array(($data->Id_parent == null)?'viewReseller':'nzb/viewEpisodeReseller', 'id'=>($data->Id_parent == null)?$data->ID:$data->nzbs[0]->Id ));
		?>	
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
	
		<?php if($data->Id_parent == null){?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('Seasons')); ?>:</b>
				<?php echo CHtml::encode(count($data->seasons)); ?>
			<br />
			<?php if($data->Deleted_serie == 1){ ?>
				<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
				<span class="deleted">Deleted</span>
				<br />
			<?php } ?>
		<?php }else{?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('Season')); ?>:</b>
				<?php echo CHtml::encode($data->Season); ?>
			<br />
			<b><?php echo CHtml::encode($data->getAttributeLabel('Episode')); ?>:</b>
				<?php echo CHtml::encode($data->Episode); ?>
			<br />
			<b><?php echo CHtml::encode($data->getAttributeLabel('Points')); ?>:</b>
				<?php echo CHtml::encode($data->nzbs[0]->points); ?>
			<br />
				<?php if($data->idParent->Deleted_serie == 1){ ?>
						<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
						<span class="deleted">Deleted</span>
						<br />
				<?php } ?>
		<?php }?>
		
	</div>
</div>	