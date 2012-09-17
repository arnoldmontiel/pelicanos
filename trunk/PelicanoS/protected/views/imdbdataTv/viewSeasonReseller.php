<?php

$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('indexReseller')),
);
?>

<h1>View Season</h1>

<div class="form">
<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'))?>

<div class="row"> 
	<div id="tvShow" style="margin-bottom: 5px;display: inline-block;">
		<?php $tvShows = CHtml::listData($ddlTvShow, 'ID', 'Title');?>
		<?php echo CHtml::activeLabelEx($model,'Id_parent'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_parent', $tvShows,
			array(
			'prompt'=>'Select ..',
			'ajax' => array(
			'type'=>'POST', 
			'dataType'=>'json',
			'url'=>CController::createUrl('AjaxFillSeason'), 
			'success'=>'function(data) {
			     $("#ImdbdataTv_Season").html(data.season);
			  }',
			//'update'=>'#ImdbdataTv_Season',
			)));?>
		<?php echo CHtml::error($model,'Id_parent'); ?>
	</div>
	
	<div id="Season" style="margin-bottom: 5px;display: inline-block;">
		<?php $season = CHtml::listData($ddlSeason, 'season', 'season');?>
		<?php echo CHtml::activeLabelEx($model,'Season'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Season', $season,
			array(
				'prompt'=>'Select ..',
			)
		);?>
		<?php echo CHtml::error($model,'Season'); ?>
	</div>
	
</div>


<div id="imdb_index">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewReseller',
	'summaryText' =>"",
)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#ImdbdataTv_viewSeason', "
$('#ImdbdataTv_Season').change(
					function(){				
					$.post('".ImdbdataTvController::createUrl('AjaxSearchReseller')."',
							{
								season: $(this).val(),
								idParent: $('#ImdbdataTv_Id_parent').val()
							}
					).success(
						function(data) 
						{
 							$('#imdb_index').html(data);
						}
					);
				});
$('#ImdbdataTv_Id_parent').change(
					function(){				
					$.post('".ImdbdataTvController::createUrl('AjaxSearchReseller')."',
							{
								season: '',
								idParent: $(this).val()
							}
					).success(
						function(data) 
						{
 							$('#imdb_index').html(data);
						}
					);
				});
");
?>
<?php echo CHtml::endForm()?>

</div><!-- form -->