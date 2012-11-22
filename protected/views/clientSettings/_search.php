<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip_v4'); ?>
		<?php echo $form->textField($model,'ip_v4',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip_v6'); ?>
		<?php echo $form->textField($model,'ip_v6',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'port_v4'); ?>
		<?php echo $form->textField($model,'port_v4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'port_v6'); ?>
		<?php echo $form->textField($model,'port_v6'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_customer'); ?>
		<?php echo $form->textField($model,'Id_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->