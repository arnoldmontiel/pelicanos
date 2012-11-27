<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	'enableAjaxValidation'=>true,	
)); 
?>

	<?php echo $form->errorSummary($model); ?>
 	
 	<div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
		
 	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'type'); ?>
		<?php 
			$type = array('Actor'=>'Actor',
							'Director'=>'Director',
							'Writer'=>'Writer',
						);			
			echo CHtml::activeDropDownList($model, 'type', $type); ?>
	</div>	

    <div class="row">
    	<?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->textField($model,'role',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'role'); ?>
    </div>
			
<?php $this->endWidget(); ?>

</div><!-- form -->