<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#updateSeason', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('adminSeason')."';
	return false;
});

 
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'season-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
      
    <div class="row">
        <?php echo $form->labelEx($model,'season_number'); ?>
        <?php echo $form->textField($model,'season_number'); ?>
        <?php echo $form->error($model,'season_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'banner_original'); ?>
        <?php echo $form->textField($model,'banner_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'banner_original'); ?>
    </div>
	<?php echo CHtml::image( "images/".$model->banner, "",array('id'=>'season_banner_img', 'style'=>'height: 220px;width: 520px;')); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->