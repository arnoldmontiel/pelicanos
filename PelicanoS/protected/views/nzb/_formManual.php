<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#ManualNzb', "

$('#Upload_file').change(function() {
	if($('#hiddenTitleId').val() != '' && $(this).val() != '')
  		$('#saveButton').removeAttr('disabled');
});

$('#saveButton').click(function(){
	$('#wating').dialog('open');
});

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('index')."';
	return false;
});
 
$('#Nzb_points').keyup(function(){
	validateNumber($(this));
});  
");
?>

<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'));
?>

<div class="row"> 
	<?php echo CHtml::activeLabelEx($modelUpload,'File *.nzb'); ?>
	<?php echo CHtml::activeFileField($modelUpload, 'file',array('size'=>50))?>
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
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Movie Data
	</div>
</div>
	
<div id="search-movie-data">

	<?php echo CHtml::errorSummary($modelMyMovieNzb); ?>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'Id_parental_control'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'Id_parental_control'); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'Id_parental_control'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'local_title'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'local_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'local_title'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'original_title'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'original_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'original_title'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'sort_title'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'sort_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'sort_title'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'production_year'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'production_year',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'production_year'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'running_time'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'running_time',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'running_time'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'description'); ?>
        <?php echo CHtml::activeTextArea($modelMyMovieNzb,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'description'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'parental_rating_desc'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'parental_rating_desc',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'parental_rating_desc'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'imdb'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'imdb',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'imdb'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'rating'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'rating',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'rating'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'genre'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'genre',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'genre'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'studio'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'studio',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'studio'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'poster_original'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'poster_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'poster_original'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'backdrop_original'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'backdrop_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'backdrop_original'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'adult'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'adult'); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'adult'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'extra_features'); ?>
        <?php echo CHtml::activeTextArea($modelMyMovieNzb,'extra_features',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'extra_features'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'country'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'country',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'country'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'type'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'type',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'type'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'media_type'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'media_type',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'media_type'); ?>
    </div>
	
</div>

<div class="left" style="display: inline-block;">
	
</div>

	
	<div class="left">
		<div class="row buttons">
			<?php 			
									
				echo CHtml::submitButton($model->isNewRecord ? 'Create and find Subtitle' : 'Save', array('id'=>'saveButton','disabled'=>'disabled'));
				echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
			?>		
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->
