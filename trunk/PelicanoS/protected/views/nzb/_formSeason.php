<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'season-form',
	'enableAjaxValidation'=>true,	
)); 

echo CHtml::hiddenField("hiddenSerieId",$modelMyMovieAPIRequest->Id,array('id'=>'hiddenSerieId'));
?>

	<div class="search-movie-data-fields">
		<div style="width:50%;display: inline-block;">
			<?php echo CHtml::activeLabelEx($modelMyMovieAPIRequest,'Seasonnumber'); ?>
			<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'Id',array('style'=>'display:none')); ?>
			<?php 
				$season = array();
				for ($i = 1; $i <= 50; ++$i) {
					$season[$i] = $i;
				}
				
				echo CHtml::activeDropDownList($modelMyMovieAPIRequest, 'Seasonnumber', $season); ?>
		</div>
	</div>	

	<?php echo $form->errorSummary($model); ?>

 	<div class="row">
        <?php echo $form->labelEx($model,'season_number'); ?>
        <?php echo $form->textField($model,'season_number',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'season_number'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'banner_original'); ?>
        <?php echo $form->textField($model,'Id_my_movie_serie_header',array('style'=>'display:none')); ?>
        <?php echo $form->textField($model,'banner_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'banner_original'); ?>
    </div>

			
<?php $this->endWidget(); ?>

</div><!-- form -->