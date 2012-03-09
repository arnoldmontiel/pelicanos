<div class="form">
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/detail-view-blue.css');
Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdataTv', "
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

<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Imdb Data Tv
	</div>
</div>
	
<div id="conteiner" style="display: inline-block;">

	<div id="left" style="display: inline-block;">

		<div class="row">			
			<?php echo CHtml::activeLabelEx($model,'ID'); ?>
			<?php if($model->isNewRecord)
					echo CHtml::activeTextField($model,'ID',array('size'=>45,'maxlength'=>45));
				  else
					echo CHtml::activeTextField($model,'ID',array('size'=>45,'maxlength'=>45, 'readonly'=>true));
			?>
			<?php echo CHtml::error($model,'ID'); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::activeLabelEx($model,'Title'); ?>

		<?php if($model->isNewRecord)
				echo CHtml::activeTextField($model,'Title',array('size'=>45,'maxlength'=>255)); 
			  else
			  	echo CHtml::activeTextField($model,'Title',array('size'=>45,'maxlength'=>255, 'readonly'=>true));
		?>
			<?php echo CHtml::error($model,'Title'); ?>
		</div>
	
	<table id="yw0" class="detail-view">
		<tbody>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Year'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Year',array('readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Rated'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Rated',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Released'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Released',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Genre'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Genre',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Director'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Director',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Writer'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Writer',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Actors'); ?></th>
				<td><?php echo CHtml::activeTextArea($model,'Actors',array('rows'=>6, 'cols'=>40,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Plot'); ?></th>
				<td><?php echo CHtml::activeTextArea($model,'Plot',array('rows'=>6, 'cols'=>40,'readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Runtime'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Runtime',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Rating'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Rating',array('readonly'=>true)); ?></td>
			</tr>
			<tr class="odd">
				<th><?php echo CHtml::activeLabelEx($model,'Votes'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Votes',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>
			<tr class="even">
				<th><?php echo CHtml::activeLabelEx($model,'Response'); ?></th>
				<td><?php echo CHtml::activeTextField($model,'Response',array('size'=>45,'maxlength'=>45,'readonly'=>true)); ?></td>
			</tr>			
		</tbody>
	</table>

	</div>
	<div id="right" style="display: inline-block; vertical-align: top;">
		<div class="row">
			<?php echo CHtml::activeLabelEx($model,'Poster'); ?>
			<?php echo CHtml::activeTextField($model,'Poster',array('size'=>30,'maxlength'=>255,'readonly'=>true)); ?>
			<?php echo CHtml::error($model,'Poster'); ?>			
		</div>
		
		<div class="nzb-poster" style="background-image: url(<?php echo "./images/".$model->Poster_local; ?>)">
		</div>
	</div>
</div>
<div class="left" style="display: inline-block;">
	
</div>
	
	<div class="left">
		<div class="row buttons">

			<?php if($model->isNewRecord)
					echo CHtml::submitButton($model->isNewRecord ? 'Create and define Seasons' : 'Save', array('id'=>'saveButton','disabled'=>'disabled'));
				  else
					echo CHtml::submitButton($model->isNewRecord ? 'Create and define Seasons' : 'Save');
			?>		
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->