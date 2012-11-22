<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#resellerForm', "

$('#cancelButton').click(function(){
	window.location = '".ResellerController::createUrl('index')."';
	return false;
});
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reseller-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<?php if($model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($modelUser,'username'); ?>
		<?php echo $form->textField($modelUser,'username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelUser,'password'); ?>
		<?php echo $form->textField($modelUser,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelUser,'email'); ?>
		<?php echo $form->textField($modelUser,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'email'); ?>
	</div>
	<?php }?>
	<div class="row buttons">
		<?php 
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
			echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->