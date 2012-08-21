<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); 
		echo CHtml::activeHiddenField($model, 'Id_customer');
	?>

	<div class="row" style="float: left; width: 100%;">
		<div class="row-half">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row-half">
			<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'parental_control'); ?>
		<?php echo $form->checkBox($model,'parental_control'); ?>
		<?php echo $form->error($model,'parental_control'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->