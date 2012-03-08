<div class="form">
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/detail-view-blue.css');
Yii::app()->clientScript->registerScript(__CLASS__.'#create_imdbdataTV', "
function fillIMDBDataField(data)
{
	$('#ImdbdataTv_ID').val(data.ID);
	$('#ImdbdataTv_Year').val(data.Year);
	$('#ImdbdataTv_Title').val(data.Title);
	$('#ImdbdataTv_Rated').val(data.Rated);
	$('#ImdbdataTv_Released').val(data.Released);
	$('#ImdbdataTv_Genre').val(data.Genre);
	$('#ImdbdataTv_Director').val(data.Director);
	$('#ImdbdataTv_Writer').val(data.Writer);
	$('#ImdbdataTv_Actors').val(data.Actors);
	$('#ImdbdataTv_Plot').val(data.Plot);
	$('#ImdbdataTv_Runtime').val(data.Runtime);
	$('#ImdbdataTv_Rating').val(data.Rating);
	$('#ImdbdataTv_Votes').val(data.Votes);
	$('#ImdbdataTv_Response').val(data.Response);
	$('#ImdbdataTv_Poster').val(data.Poster);
	$('#ImdbdataTv_Poster_img').attr('alt',data.Title);
	$('#ImdbdataTv_Poster_img').attr('src',data.Poster);
	$('.nzb-poster').attr('style','background-image:url('+data.Poster+')');

}

$('#cancel').removeClass('ui-button');


$('#ImdbdataTv_ID').change(function(){
$(this).removeClass('error');
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?i='+$(this).val(),
      dataType: 'jsonp',
      success: function(data) {
	      	fillIMDBDataField(data);
	      	$('#ImdbdataTv_ID').removeClass('input-loading');
	      	$('#saveButton').removeAttr('disabled');
		}
    });
});
$('#ImdbdataTv_Title').change(function(){

$(this).removeClass('error');
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?t='+$(this).val(),
      dataType: 'jsonp',
      success:
      	function(data) {
      		fillIMDBDataField(data);
	      	$('#ImdbdataTv_Title').removeClass('input-loading');
	      	$('#saveButton').removeAttr('disabled');
		}
    });
});

$('#ImdbdataTv_Title').keypress(function() {
  $('#saveButton').attr('disabled','disabled');
});

$('#ImdbdataTv_ID').keypress(function() {
  $('#saveButton').attr('disabled','disabled');
});

$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	if($('*:focus').attr('id') == 'ImdbdataTv_Title' && $('*:focus').val() != '')
    	{
    		$('#ImdbdataTv_Title').change();
    		return false;
    	}
    	
    	if($('*:focus').attr('id') == 'ImdbdataTv_ID' && $('*:focus').val() != '')
    	{
    		$('#ImdbdataTv_ID').change();
    		return false;
    	}
		return false; 
    }
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

	<div id="resourceType" style="margin-bottom: 5px">
		<?php	$rsrcType = CHtml::listData($ddlRsrcType, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($model,'Id_resource_type'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_resource_type', $rsrcType);?>
		<?php echo CHtml::error($model,'Id_resource_type'); ?>
	</div>

<div class="row"> 
	<div id="tvShow" style="margin-bottom: 5px;display: inline-block;">
		<?php $tvShows = CHtml::listData($ddlTvShow, 'ID', 'Title');?>
		<?php echo CHtml::activeLabelEx($modelImdb,'Id_parent'); ?>
		<?php echo CHtml::activeDropDownList($modelImdb, 'Id_parent', $tvShows,
			array(
			'ajax' => array(
			'type'=>'POST', 
			'dataType'=>'json',
			'url'=>CController::createUrl('AjaxFillSeason'), 
			'success'=>'function(data) {
			     $("#ImdbdataTv_Season").html(data.season);
			     $("#ImdbdataTv_Episode").html(data.episode);
			  }',
			//'update'=>'#ImdbdataTv_Season',
			)));?>
		<?php echo CHtml::error($modelImdb,'Id_parent'); ?>
	</div>
	
	<div id="Season" style="margin-bottom: 5px;display: inline-block;">

		<?php $season = CHtml::listData($ddlSeason, 'season', 'season');?>
		<?php echo CHtml::activeLabelEx($modelImdb,'Season'); ?>
		<?php echo CHtml::activeDropDownList($modelImdb, 'Season', $season,
		array(
					'ajax' => array(
					'type'=>'POST', 
					'url'=>CController::createUrl('AjaxFillEpisodes'), 
					'update'=>'#ImdbdataTv_Episode',
		)));?>
		<?php echo CHtml::error($modelImdb,'Season'); ?>
	</div>
	
	<div id="Episode" style="margin-bottom: 5px;display: inline-block;">
		<?php $episode = CHtml::listData($ddlEpisode, 'episode', 'episode');?>
		<?php echo CHtml::activeLabelEx($modelImdb,'Episode'); ?>
		<?php echo CHtml::activeDropDownList($modelImdb, 'Episode', $episode);?>
		<?php echo CHtml::error($modelImdb,'Episode'); ?>
	</div>
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
			<?php if($model->isNewRecord)
					echo CHtml::activeTextField($modelImdb,'ID',array('size'=>45,'maxlength'=>45));
				  else
					echo CHtml::activeTextField($modelImdb,'ID',array('size'=>45,'maxlength'=>45, 'readonly'=>true));
			?>
			<?php echo CHtml::error($modelImdb,'ID'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Title'); ?>

		<?php if($model->isNewRecord)
				echo CHtml::activeTextField($modelImdb,'Title',array('size'=>45,'maxlength'=>255)); 
			  else
			  	echo CHtml::activeTextField($modelImdb,'Title',array('size'=>45,'maxlength'=>255, 'readonly'=>true));
		?>
			<?php echo CHtml::error($modelImdb,'Title'); ?>
		</div>
	
	<table id="yw0" class="detail-view">
		<tbody>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Year'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Year',array('readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Rated'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Rated',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Released'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Released',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Genre'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Genre',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Director'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Director',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Writer'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Writer',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Actors'); ?></th>
				<td><?php echo CHtml::activeTextArea($modelImdb,'Actors',array('rows'=>6, 'cols'=>40,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Plot'); ?></th>
				<td><?php echo CHtml::activeTextArea($modelImdb,'Plot',array('rows'=>6, 'cols'=>40,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Runtime'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Runtime',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Rating'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Rating',array('readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Votes'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Votes',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($modelImdb,'Response'); ?></th>
				<td><?php echo CHtml::activeTextField($modelImdb,'Response',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>			
		</tbody>
	</table>

	</div>
	<div id="right" style="display: inline-block; vertical-align: top;">
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelImdb,'Poster'); ?>
			<?php echo CHtml::activeTextField($modelImdb,'Poster',array('size'=>30,'maxlength'=>255,'readonly'=>true)); ?>
			<?php echo CHtml::error($modelImdb,'Poster'); ?>			
		</div>
		
		<div class="nzb-poster" style="background-image: url(<?php echo "./images/".$modelImdb->Poster_local; ?>)">
		</div>
	</div>
</div>
<div class="left" style="display: inline-block;">
	
</div>
	
	<div class="left">
		<div class="row buttons">

			<?php if($model->isNewRecord)
					echo CHtml::submitButton($model->isNewRecord ? 'Create and find Subtitle' : 'Save', array('id'=>'saveButton','disabled'=>'disabled'));
				  else
					echo CHtml::submitButton($model->isNewRecord ? 'Create and find Subtitle' : 'Save');
			?>		
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->