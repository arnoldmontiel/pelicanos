<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'audio-track-form',
	'enableAjaxValidation'=>true,	
)); 
?>

	<?php echo $form->errorSummary($model); ?>
 	
 	<div class="row">
        <?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'language'); ?>
    </div>
		
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
    	<?php echo $form->labelEx($model,'chanel'); ?>
        <?php echo $form->textField($model,'chanel',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'chanel'); ?>
    </div>
			
<?php $this->endWidget(); ?>

</div><!-- form -->