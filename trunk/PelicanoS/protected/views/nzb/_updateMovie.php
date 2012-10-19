<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#updateMovie', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('view',array('id'=>$model->Id))."';
	return false;
});
  
");
?>


<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'))?>

<div class="movie-index-view" >

	<div class="left-movie-view" >
	<?php
		echo CHtml::image("./images/".$model->myMovieDiscNzb->myMovieNzb->poster,$model->myMovieDiscNzb->myMovieNzb->original_title,array('id'=>'poster_img', 'style'=>'height: 200px;width: 125px;'));
		?>
	</div>
	<div class="right-movie-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id Imdb')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->imdb); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($model->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('subt_file_name')); ?>:</b>
		<?php echo CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles'))); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->production_year); ?>
		<br />
		
	</div>
</div>
<br>

	<div class="row"> 
		<?php echo CHtml::activeLabelEx($modelUpload,'File *.nzb'); ?>
		<?php echo CHtml::activeFileField($modelUpload, 'file')?> <?php echo CHtml::link($model->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<?php echo CHtml::error($modelUpload, 'file')?>
	</div>	

	<div id="resourceType" style="margin-bottom: 5px">
		<?php	$rsrcType = CHtml::listData($ddlRsrcType, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($model,'Id_resource_type'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_resource_type', $rsrcType);?>
		<?php echo CHtml::error($model,'Id_resource_type'); ?>
	</div>

	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($model,'points'); ?>
		<?php echo CHtml::activeTextField($model, 'points');?>
		<?php echo CHtml::error($model,'points'); ?>
	</div>

	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($modelMyMovieNzb,'description'); ?>
		<?php echo CHtml::activeTextArea($modelMyMovieNzb, 'description',array('cols'=>50));?>
		<?php echo CHtml::error($modelMyMovieNzb,'description'); ?>
	</div>
	
	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($modelMyMovieNzb,'studio'); ?>
		<?php echo CHtml::activeTextField($modelMyMovieNzb, 'studio',array('size'=>50));?>
		<?php echo CHtml::error($modelMyMovieNzb,'studio'); ?>
	</div>
	
	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($modelMyMovieNzb,'genre'); ?>
		<?php echo CHtml::activeTextField($modelMyMovieNzb, 'genre',array('size'=>50));?>
		<?php echo CHtml::error($modelMyMovieNzb,'genre'); ?>
	</div>
	
	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($model,'is_draft'); ?>
		<?php echo CHtml::activeCheckBox($model, 'is_draft');?>
		<?php echo CHtml::error($model,'is_draft'); ?>
	</div>
		
	<?php 
		echo CHtml::submitButton('Save'); 
		echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
	?>
	
	<?php echo CHtml::endForm()?>

</div><!-- form -->
	