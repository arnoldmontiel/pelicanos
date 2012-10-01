<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_customer'); ?>
		<?php echo $form->dropDownList($model, 'Id_customer', CHtml::listData(
		Customer::model()->findAll(), 'Id', 'last_name' ));
		?>
		<?php echo $form->error($model,'Id_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_v4'); ?>
		<?php echo $form->textField($model,'ip_v4',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'ip_v4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_v6'); ?>
		<?php echo $form->textField($model,'ip_v6',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'ip_v6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'port_v4'); ?>
		<?php echo $form->textField($model,'port_v4'); ?>
		<?php echo $form->error($model,'port_v4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'port_v6'); ?>
		<?php echo $form->textField($model,'port_v6'); ?>
		<?php echo $form->error($model,'port_v6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
		<?php echo $form->error($model,'last_update'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->