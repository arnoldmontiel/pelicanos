<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'episode-form',
	'enableAjaxValidation'=>true,	
)); ?>

	<div class="search-movie-data-fields">
		
		<div style="width:50%;display: inline-block;">
			<?php echo CHtml::activeLabelEx($modelMyMovieAPIRequest,'Episodenumber'); ?>
			<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'SerieGuid',array('style'=>'display:none')); ?>
			<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'Seasonnumber',array('style'=>'display:none')); ?>
			<?php 
				$season = array();
				for ($i = 1; $i <= 50; ++$i) {
					$season[$i] = $i;
				}
				
				echo CHtml::activeDropDownList($modelMyMovieAPIRequest, 'Episodenumber', $season); ?>
		</div>
		<div style="width:50%;display: inline-block;">
			<?php echo CHtml::activeLabelEx($modelMyMovieAPIRequest,'Country'); ?>
			<?php 
				$country = array('Argentina'=>'Argentina',
								'France'=>'France',
								'Germany'=>'Germany',
								'Italy'=>'Italy',
								'Mexico'=>'Mexico',
								'Spain'=>'Spain',
								'United Kingdom'=>'United Kingdom',
								'United States'=>'United States',);
				
				echo CHtml::activeDropDownList($modelMyMovieAPIRequest, 'Country', $country, array('prompt'=>'Select..')); ?>
		</div>
	</div>	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
      	<?php echo $form->textField($model,'Id_my_movie_season',array('style'=>'display:none')); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'episode_number'); ?>
        <?php echo $form->textField($model,'episode_number',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'episode_number'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->