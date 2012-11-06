<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subtitle-form',
	'enableAjaxValidation'=>true,	
)); 
?>

	<?php echo $form->errorSummary($model); ?>
 	
 	<div class="row">
        <?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'language'); ?>
    </div>
			
<?php $this->endWidget(); ?>

</div><!-- form -->