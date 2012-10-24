<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'serie-header-form',
	'enableAjaxValidation'=>true,	
)); ?>

	<div class="search-movie-data-fields">
		
		<div style="width:40%;display: inline-block;">
			<?php
			echo CHtml::radioButtonList('rbnSearchField','title', array('title'=>'Title', 'imdb'=>'Imdb'), array(
									'labelOptions'=>array('style'=>'display:inline'),
                					'separator'=>' '
                					));
        	?>
        	<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'Title',array('maxlength'=>255)); ?>
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
	<div id="div-error" class="messageError" style="display:none;width:100%">
	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->textArea($model,'Id',array('style'=>'display:none')); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'poster_original'); ?>
        <?php echo $form->textField($model,'poster_original',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'poster_original'); ?>
    </div>
	<?php echo CHtml::image( "", "",array('id'=>'serie_poster_img', 'style'=>'height: 320px;width: 220px;')); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'genre'); ?>
        <?php echo $form->textField($model,'genre',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'genre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sort_name'); ?>
        <?php echo $form->textField($model,'sort_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'sort_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'rating'); ?>
        <?php echo $form->textField($model,'rating',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_network'); ?>
        <?php echo $form->textField($model,'original_network',array('size'=>20,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'original_network'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_status'); ?>
        <?php echo $form->textField($model,'original_status',array('size'=>20,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'original_status'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->