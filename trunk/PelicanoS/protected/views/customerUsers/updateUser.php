<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>128,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adult_section'); ?>
		<?php echo $form->checkBox($model,'adult_section'); ?>
		<?php echo $form->error($model,'adult_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->checkBox($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'birth_date'); ?>
	 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		     // additional javascript options for the date picker plugin
	 		'language'=>'es',
	 		'model'=>$model,
	 		'attribute'=>'birth_date',
	 		'options'=>array(
		         'showAnim'=>'fold',
		     ),
		     'htmlOptions'=>array(
		         'style'=>'height:20px;'
		    ),
			));?>
			<?php echo $form->error($model,'birth_date'); ?>
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->