<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#updateEpisode', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('adminEpisode')."';
	return false;
});

 
");
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'episode-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'episode_number'); ?>
        <?php echo $form->textField($model,'episode_number'); ?>
        <?php echo $form->error($model,'episode_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

 	<div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->