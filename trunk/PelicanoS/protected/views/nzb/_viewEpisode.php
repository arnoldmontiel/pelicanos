<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->imdbDataTv->Poster_local,$data->imdbDataTv->Title,array('id'=>'imdbDataTv_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewEpisode', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
		<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->imdbDataTv->ID), array('viewEpisode', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($data->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->file_name, 'root'=>'nzb'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('subt_file_name')); ?>:</b>
		<?php echo CHtml::link($data->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->subt_file_name, 'root'=>'subtitles'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($data->resourceType->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Serie')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->idParent->Title); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Season')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Season); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Episode')); ?>:</b>
		<?php echo CHtml::encode($data->imdbDataTv->Episode); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
		<?php echo CHtml::encode($data->points); ?>
		<br />
		
		<?php if($data->imdbDataTv->idParent->Deleted_serie == 1 || $data->deleted == 1){ ?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
			<span class="deleted">Deleted</span>
			<br />
		<?php } ?>
	</div>
</div>