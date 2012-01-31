<div class="form">
<?php

Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdata', "
function fillIMDBDataField(data)
{
	$('#Imdbdata_ID').val(data.ID);
	$('#Imdbdata_Year').val(data.Year);
	$('#Imdbdata_Title').val(data.Title);
	$('#Imdbdata_Rated').val(data.Rated);
	$('#Imdbdata_Released').val(data.Released);
	$('#Imdbdata_Genre').val(data.Genre);
	$('#Imdbdata_Director').val(data.Director);
	$('#Imdbdata_Writer').val(data.Writer);
	$('#Imdbdata_Actors').val(data.Actors);
	$('#Imdbdata_Plot').val(data.Plot);
	$('#Imdbdata_Runtime').val(data.Runtime);
	$('#Imdbdata_Rating').val(data.Rating);
	$('#Imdbdata_Votes').val(data.Votes);
	$('#Imdbdata_Response').val(data.Response);
	$('#Imdbdata_Poster').val(data.Poster);
	$('#Imdbdata_Poster_img').attr('alt',data.Title);
	$('#Imdbdata_Poster_img').attr('src',data.Poster);

}
$('#Imdbdata_ID').change(function(){
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?i='+$(this).val(),
      dataType: 'jsonp',
      success: function(data) {
	      	fillIMDBDataField(data);
	      	$('#Imdbdata_ID').removeClass('input-loading');
		}
    });
});
$('#Imdbdata_Title').change(function(){
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?t='+$(this).val(),
      dataType: 'jsonp',
      success:
      	function(data) {
      		fillIMDBDataField(data);
	      	$('#Imdbdata_Title').removeClass('input-loading');
		}
    });
});

");
?>

<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'))?>

<div class="row">
	<?php echo CHtml::activeLabelEx($modelUpload,'File *.nzb'); ?>
	<?php echo CHtml::activeFileField($modelUpload, 'file')?> <?php echo CHtml::link($model->file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
	<?php echo CHtml::error($modelUpload, 'file')?>
</div>	

<div class="row">
	<?php echo CHtml::activeLabelEx($modelUpload,'Subtitle *.srt'); ?>
	<?php echo CHtml::activeFileField($modelUpload, 'subt_file')?> <?php echo CHtml::link($model->subt_file_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->subt_file_name, 'root'=>'subtitles'))); ?>
	<?php echo CHtml::error($modelUpload, 'subt_file')?>
</div>	

<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Imdb Data
	</div>
</div>
	
<div id="conteiner" style="display: inline-block;">

	<div id="left" style="display: inline-block;">

		<div class="row">			
			<?php echo CHtml::activeLabelEx($modelImdb,'ID'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'ID',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'ID'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Title'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Title',array('size'=>45,'maxlength'=>255)); ?>
			<?php echo CHtml::error($modelImdb,'Title'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Year'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Year'); ?>
			<?php echo CHtml::error($modelImdb,'Year'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Rated'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Rated',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Rated'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Released'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Released',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Released'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Genre'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Genre',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Genre'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Director'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Director',array('size'=>45,'maxlength'=>255)); ?>
			<?php echo CHtml::error($modelImdb,'Director'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Writer'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Writer',array('size'=>45,'maxlength'=>255)); ?>
			<?php echo CHtml::error($modelImdb,'Writer'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Actors'); ?>
			<?php echo CHtml::activeTextArea($modelImdb,'Actors',array('rows'=>6, 'cols'=>40)); ?>
			<?php echo CHtml::error($modelImdb,'Actors'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Plot'); ?>
			<?php echo CHtml::activeTextArea($modelImdb,'Plot',array('rows'=>6, 'cols'=>40)); ?>
			<?php echo CHtml::error($modelImdb,'Plot'); ?>
		</div>
		
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Runtime'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Runtime',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Runtime'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Rating'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Rating'); ?>
			<?php echo CHtml::error($modelImdb,'Rating'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Votes'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Votes',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Votes'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Response'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Response',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo CHtml::error($modelImdb,'Response'); ?>
		</div>

	</div>
	<div id="right" style="display: inline-block; vertical-align: top;">
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Poster'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Poster',array('size'=>45,'maxlength'=>255)); ?>
			<?php echo CHtml::error($modelImdb,'Poster'); ?>			
		</div>
		
		
		<?php echo CHtml::image( $modelImdb->Poster, $modelImdb->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>	
	</div>
</div>
	
	<div class="left">
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->