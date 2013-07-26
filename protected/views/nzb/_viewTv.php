<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->myMovieDiscNzb->myMovieNzb->poster,$data->myMovieDiscNzb->myMovieNzb->original_title,array('id'=>'poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewTv', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->myMovieDiscNzb->name), array('viewTv', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('serie')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->name); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('season')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->getSeasonNumber()); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('episodes')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->getEpisodes()); ?>
		<br />
				
		<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($data->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->file_name, 'root'=>'nzb'))); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('disc_name')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->name); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->myMovieNzb->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($data->myMovieDiscNzb->myMovieNzb->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($data->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Points')); ?>:</b>
		<?php echo CHtml::encode($data->points); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Share State')); ?>:</b>
		<?php echo CHtml::encode(($data->is_draft)?'In draft': 'Published'); ?>
		<br />
				
		<?php if($data->deleted == 1){ ?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
			<span class="deleted">Deleted</span>
			<br />
		<?php } ?>
	</div>
</div>