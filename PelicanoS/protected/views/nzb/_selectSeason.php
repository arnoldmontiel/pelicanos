<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#newSeason', "

$('#saveButton').click(function(){
	$('#wating').dialog('open');
});

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('index')."';
	return false;
});

$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	if($('*:focus').attr('id') == 'Imdbdata_Title' && $('*:focus').val() != '')
    	{
    		$('#Imdbdata_Title').change();
    		return false;
    	}
    	
    	if($('*:focus').attr('id') == 'Imdbdata_ID' && $('*:focus').val() != '')
    	{
    		$('#Imdbdata_ID').change();
    		return false;
    	}
		return false; 
    }
  });
 
$('#Nzb_points').keyup(function(){
	validateNumber($(this));
});  
");
?>

<?php echo CHtml::beginForm('','post');
	echo CHtml::hiddenField("hiddenSeasonId",'',array('id'=>'hiddenSeasonId'));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Serie'),
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->name, 
			),
			array('label'=>'Original Status',
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->original_status,
			),
			array('label'=>'Rating',
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->rating,
			),
			'file_original_name',
			'subt_file_name',
			'subt_original_name'
		),
	)); ?>
<br>	
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Season Data
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Season','#',array('onclick'=>'jQuery("#newSeason").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-movie-season-grid',
	'dataProvider'=>$modelMyMovieSeason->search(),
	'filter'=>$modelMyMovieSeason,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){
							var idSeason = $.fn.yiiGridView.getSelection("my-movie-season-grid")
							if(idSeason!=""){
								$("#hiddenSeasonId").val(idSeason);
								$("#saveButton").removeAttr("disabled");
							}
							else
							{
								$("#hiddenSeasonId").val("");
								$("#saveButton").attr("disabled","disabled");
							}
						}',
	'columns'=>array(
		'season_number',
	),
)); ?>
</div>

	<div class="left">
		<div class="row buttons">
			<?php 			
									
				echo CHtml::submitButton('Next', array('id'=>'saveButton','disabled'=>'disabled'));
				echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
			?>		
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->

<?php

$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('none'),
			'idDialog'=>'waiting',
));
//New serie dialog
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'newSeason',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'New Season',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Guardar'=>'js:function(){							
									jQuery("#waiting").dialog("open");
									jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveSeason").'", $("#season-form").serialize(),
									function(data) {
										$.fn.yiiGridView.update("my-movie-season-grid");										
										jQuery("#waiting").dialog("close");
										$("#MyMovieSeason_season_number").val(null);
										$("#MyMovieSeason_banner_original").val(null);
										$("#season_banner_img").attr("src", "");
										jQuery("#newSeason").dialog( "close" );
									},"json"
								);
							}',
							'Cancelar'=>'js:function(){
										$("#MyMovieSeason_season_number").val(null);
										$("#MyMovieSeason_banner_original").val(null);
										$("#season_banner_img").attr("src", "");
										jQuery("#newSeason").dialog( "close" );
							}',
							'Buscar'=>'js:function()
								{
								jQuery("#waiting").dialog("open");
								jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSearchSeason").'", $("#season-form").serialize(),
								function(data) {
									if(data!=null)
									{
										$("#MyMovieSeason_season_number").val(data.season_number);
										$("#MyMovieSeason_banner_original").val(data.banner_original);
										$("#season_banner_img").attr("src", data.banner_original);
									}
									else
									{
										$("#MyMovieSeason_season_number").val(null);
										$("#MyMovieSeason_banner_original").val(null);
										$("#season_banner_img").attr("src", "");
									}
								jQuery("#waiting").dialog("close");
								},"json"
						);
		
				}',
					),
			),
	));
	
	$modelNewSeason = new MyMovieSeason();
	$modelMyMovieAPIRequest = new MyMovieAPIRequest();
	$modelMyMovieAPIRequest->Id = $model->myMovieDiscNzb->myMovieNzb->Id_my_movie_serie_header;
	$modelNewSeason->Id_my_movie_serie_header = $modelMyMovieAPIRequest->Id;
	
	echo $this->renderPartial('_formSeason', array('model'=>$modelNewSeason,
														'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,
													));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>