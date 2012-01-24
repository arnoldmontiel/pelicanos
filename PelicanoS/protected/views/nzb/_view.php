<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::link($data->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->file_name, 'root'=>'nzb'))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subt_url')); ?>:</b>
	<?php echo CHtml::encode($data->subt_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subt_file_name')); ?>:</b>
	<?php echo CHtml::link($data->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$data->subt_file_name, 'root'=>'subtitles'))); ?>
	<br />


</div>