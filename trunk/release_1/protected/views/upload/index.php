<h1>Create Link</h1>

<div class="form">
<?php if($uploaded):?>
	<p>File was uploaded.</p>
<?php endif ?>

<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'))?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($modelLink,'description'); ?>
		<?php echo CHtml::activeTextField($modelLink, 'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo CHtml::error($modelLink, 'description')?>
	</div>
	
	<div class="row">
		<?php echo CHtml::error($model, 'file')?>
		<?php echo CHtml::activeFileField($model, 'file')?>
		<?php echo CHtml::submitButton('Upload')?>
	</div>
	
<?php echo CHtml::endForm()?>
</div><!-- form -->