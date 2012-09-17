<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->imdbData->Poster_local,$data->imdbData->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewReseller', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
		<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->imdbData->Title), array('viewReseller', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($data->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Rating); ?>
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