<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id',array('size'=>45,'maxlength'=>45,'disabled'=>$model->isNewRecord ?'':'disabled')); ?>
		<?php echo $form->hiddenField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelClientSettings,'Id_customer'); ?>
		<?php echo $form->dropDownList($modelClientSettings, 'Id_customer', CHtml::listData(
		Customer::model()->findAll(), 'Id', 'last_name' ));
		?>
		<?php echo $form->error($modelClientSettings,'Id_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelClientSettings,'ip_v4'); ?>
		<?php echo $form->textField($modelClientSettings,'ip_v4',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelClientSettings,'ip_v4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelClientSettings,'ip_v6'); ?>
		<?php echo $form->textField($modelClientSettings,'ip_v6',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelClientSettings,'ip_v6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelClientSettings,'port_v4'); ?>
		<?php echo $form->textField($modelClientSettings,'port_v4'); ?>
		<?php echo $form->error($modelClientSettings,'port_v4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelClientSettings,'port_v6'); ?>
		<?php echo $form->textField($modelClientSettings,'port_v6'); ?>
		<?php echo $form->error($modelClientSettings,'port_v6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'drive_letter'); ?>
		<?php echo $form->textField($modelSettingsRipper,'drive_letter',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelSettingsRipper,'drive_letter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'temp_folder_ripping'); ?>
		<?php echo $form->textField($modelSettingsRipper,'temp_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($modelSettingsRipper,'temp_folder_ripping'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'final_folder_ripping'); ?>
		<?php echo $form->textField($modelSettingsRipper,'final_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($modelSettingsRipper,'final_folder_ripping'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'time_from_reboot'); ?>
		<?php echo $form->textField($modelSettingsRipper,'time_from_reboot'); ?>
		<?php echo $form->error($modelSettingsRipper,'time_from_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'time_to_reboot'); ?>
		<?php echo $form->textField($modelSettingsRipper,'time_to_reboot'); ?>
		<?php echo $form->error($modelSettingsRipper,'time_to_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'mymovies_username'); ?>
		<?php echo $form->textField($modelSettingsRipper,'mymovies_username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelSettingsRipper,'mymovies_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelSettingsRipper,'mymovies_password'); ?>
		<?php echo $form->textField($modelSettingsRipper,'mymovies_password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelSettingsRipper,'mymovies_password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->