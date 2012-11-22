<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#updateSerie', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('adminSerie')."';
	return false;
});

 
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'serie-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
     
    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'poster_original'); ?>
        <?php echo $form->textField($model,'poster_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'poster_original'); ?>
    </div>
	<?php echo CHtml::image( "images/".$model->poster, "",array('id'=>'serie_poster_img', 'style'=>'height: 320px;width: 220px;')); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'genre'); ?>
        <?php echo $form->textField($model,'genre',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'genre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sort_name'); ?>
        <?php echo $form->textField($model,'sort_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'sort_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'rating'); ?>
        <?php echo $form->textField($model,'rating',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_network'); ?>
        <?php echo $form->textField($model,'original_network',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'original_network'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_status'); ?>
        <?php echo $form->textField($model,'original_status',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'original_status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->