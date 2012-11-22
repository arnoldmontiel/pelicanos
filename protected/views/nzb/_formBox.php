<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'box-form',
	'enableAjaxValidation'=>true,	
)); 
?>

	<?php echo $form->errorSummary($model); ?>
 	
 	<div class="row">
        <?php echo $form->labelEx($model,'original_title'); ?>
        <?php echo $form->textField($model,'original_title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'original_title'); ?>
    </div>
    
   <div class="row">
			<?php echo CHtml::activeLabelEx($model,'type'); ?>
			<?php 
				$type = array('Blu-ray'=>'Blu-ray',
								'DVD'=>'DVD',
								);
				
				echo CHtml::activeDropDownList($model, 'type', $type); ?>
	</div>
		
    <div class="row">
        <?php echo $form->labelEx($model,'production_year'); ?>
        <?php echo $form->textField($model,'production_year',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'production_year'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>
    
	<div id="resourceType" style="margin-bottom: 5px">
		<?php	$parentalControl = CHtml::listData($ddlParentalControl, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($model,'Id_parental_control'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_parental_control', $parentalControl);?>
		<?php echo CHtml::error($model,'Id_parental_control'); ?>
	</div>
	
    <div class="row">
    	<?php echo $form->labelEx($model,'studio'); ?>
        <?php echo $form->textField($model,'studio',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'studio'); ?>
    </div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'poster_original'); ?>
        <?php echo $form->textField($model,'poster_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'poster_original'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'backdrop_original'); ?>
        <?php echo $form->textField($model,'backdrop_original',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'backdrop_original'); ?>
	</div>
			
<?php $this->endWidget(); ?>

</div><!-- form -->