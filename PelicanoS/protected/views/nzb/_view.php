<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::link( CHtml::image("./images/".$data->imdbData->Poster_local,$data->imdbData->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 200px;width: 125px;')
                            ),array('view', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
		<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->imdbData->ID), array('view', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($data->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->file_name, 'root'=>'nzb'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('subt_file_name')); ?>:</b>
		<?php echo CHtml::link($data->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->subt_file_name, 'root'=>'subtitles'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Title); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Year); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($data->imdbData->Runtime); ?>
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
	</div>
</div>