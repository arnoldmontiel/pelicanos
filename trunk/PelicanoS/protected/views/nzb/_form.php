<div class="form">


<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'))?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'description'); ?>
		<?php echo CHtml::activeTextField($model, 'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo CHtml::error($model, 'description')?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($modelUpload,'File *.nzb'); ?>
		<?php echo CHtml::activeFileField($modelUpload, 'file')?> <?php echo CHtml::link($model->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<?php echo CHtml::error($modelUpload, 'file')?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($modelUpload,'Subtitle *.srt'); ?>
		<?php echo CHtml::activeFileField($modelUpload, 'subt_file')?> <?php echo CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles'))); ?>
		<?php echo CHtml::error($modelUpload, 'subt_file')?>
	</div>
	
	<div class="left">
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->