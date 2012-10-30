<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#newMovieManual', "


$('#Upload_file').change(function() {
	if($(this).val() != '')
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

<?php
		
		$this->widget('ext.processingDialog.processingDialog', array(
					'buttons'=>array('none'),
					'idDialog'=>'wating',
		));
?>
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
        <?php $parentalControl = CHtml::listData($ddlParentalControl, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($modelMyMovieNzb,'Id_parental_control'); ?>
		<?php echo CHtml::activeDropDownList($modelMyMovieNzb, 'Id_parental_control', $parentalControl);?>
		<?php echo CHtml::error($modelMyMovieNzb,'Id_parental_control'); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'parental_rating_desc'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'parental_rating_desc',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'parental_rating_desc'); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'adult'); ?>
      	<?php echo CHtml::activeCheckBox($modelMyMovieNzb,'adult'); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'adult'); ?>
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
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'video_standard'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'video_standard',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'video_standard'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'release_date'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'release_date',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'release_date'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'bar_code'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'bar_code',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'bar_code'); ?>
    </div>

    <div class="row">
       <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'type'); ?>
			<?php 
				$type = array('Blu-ray'=>'Blu-ray',
								'DVD'=>'DVD',
								);
				
				echo CHtml::activeDropDownList($modelMyMovieNzb, 'type', $type); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'media_type'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'media_type',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'media_type'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'aspect_ratio'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'aspect_ratio',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'aspect_ratio'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'data_changed'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'data_changed',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'data_changed'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($modelMyMovieNzb,'covers_changed'); ?>
        <?php echo CHtml::activeTextField($modelMyMovieNzb,'covers_changed',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::error($modelMyMovieNzb,'covers_changed'); ?>
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

<?php
//ProductType
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'ViewMoreInfo',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Movie Info',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Aceptar'=>'js:function(){jQuery("#ViewMoreInfo").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'popup-view-movie-info','style'=>'position:relative;display:inline-block;width:97%'));
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>