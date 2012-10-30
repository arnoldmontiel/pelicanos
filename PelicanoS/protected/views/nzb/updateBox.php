<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#updateBox', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('adminBox')."';
	return false;
});

 
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'box-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'local_title'); ?>
        <?php echo $form->textField($model,'local_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'local_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_title'); ?>
        <?php echo $form->textField($model,'original_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'original_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sort_title'); ?>
        <?php echo $form->textField($model,'sort_title',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'sort_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'production_year'); ?>
        <?php echo $form->textField($model,'production_year',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'production_year'); ?>
    </div>

  	<div class="row">
        <?php $parentalControl = CHtml::listData($ddlParentalControl, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($model,'Id_parental_control'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_parental_control', $parentalControl);?>
		<?php echo CHtml::error($model,'Id_parental_control'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'parental_rating_desc'); ?>
        <?php echo $form->textField($model,'parental_rating_desc',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'parental_rating_desc'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'adult'); ?>
      	<?php echo $form->checkBox($model,'adult'); ?>
        <?php echo $form->error($model,'adult'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'running_time'); ?>
        <?php echo $form->textField($model,'running_time',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'running_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'imdb'); ?>
        <?php echo $form->textField($model,'imdb',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'imdb'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'rating'); ?>
        <?php echo $form->textField($model,'rating',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'genre'); ?>
        <?php echo $form->textField($model,'genre',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'genre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'studio'); ?>
        <?php echo $form->textField($model,'studio',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'studio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'poster_original'); ?>
        <?php echo $form->textField($model,'poster_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'poster_original'); ?>
    </div>
	<?php echo CHtml::image( "images/".$model->poster, "",array('id'=>'poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'backdrop_original'); ?>
        <?php echo $form->textField($model,'backdrop_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'backdrop_original'); ?>
    </div>
	<?php echo CHtml::image( "images/".$model->backdrop, "",array('id'=>'backdrop_img', 'style'=>'height: 320px;width: 220px;')); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'extra_features'); ?>
        <?php echo $form->textArea($model,'extra_features',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'extra_features'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->textField($model,'country',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'video_standard'); ?>
        <?php echo $form->textField($model,'video_standard',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'video_standard'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'release_date'); ?>
        <?php echo $form->textField($model,'release_date',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'release_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'bar_code'); ?>
        <?php echo $form->textField($model,'bar_code',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'bar_code'); ?>
    </div>

    <div class="row">
       <?php echo CHtml::activeLabelEx($model,'type'); ?>
			<?php 
				$type = array('Blu-ray'=>'Blu-ray',
								'DVD'=>'DVD',
								);
				
				echo CHtml::activeDropDownList($model, 'type', $type); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'media_type'); ?>
        <?php echo $form->textField($model,'media_type',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'media_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'aspect_ratio'); ?>
        <?php echo $form->textField($model,'aspect_ratio',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'aspect_ratio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'data_changed'); ?>
        <?php echo $form->textField($model,'data_changed',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'data_changed'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'covers_changed'); ?>
        <?php echo $form->textField($model,'covers_changed',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'covers_changed'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->