<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-users-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("customerUsers/ajaxCreate")
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
	<?php echo $form->labelEx($model,'birth_date'); ?>
	 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		     // additional javascript options for the date picker plugin
	 		'language'=>'en',
	 		'model'=>$model,
	 		'attribute'=>'birth_date',
	 		'options'=>array(
				'showAnim'=>'fold',
	 			'yearRange'=>'1930',
				'changeYear'=>'true',
	 			'changeMonth'=>'true',
	 		),
		     'htmlOptions'=>array(
		         'style'=>'height:20px;'
		    ),
			));?>
			<?php echo $form->error($model,'birth_date'); ?>
		</div>
		
	

<?php $this->endWidget(); ?>

</div><!-- form -->