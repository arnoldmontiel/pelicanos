<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#newEpisode', "

$('#finishButton').click(function(){
	window.location = '".NzbController::createUrl('view',array('id'=>$model->Id))."';
	return false;
});

 
");
?>

<?php echo CHtml::beginForm('','post');
?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Serie'),
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->name, 
			),
			array('label'=>$model->getAttributeLabel('Season'),
				'type'=>'raw',
				'value'=>$modelMyMovieEpisode->myMovieSeason->season_number, 
			),
			array('label'=>'Original Status',
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->original_status,
			),
		),
	)); ?>
<br>	
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Episode Data
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Episode','#',array('onclick'=>'jQuery("#newEpisode").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-movie-episode-grid',
	'dataProvider'=>$modelMyMovieEpisode->search(),
	'filter'=>$modelMyMovieEpisode,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){							
						$.get(	"'.NzbController::createUrl('AjaxAddDiscEpisode').'",
						{
							idEpisode:$.fn.yiiGridView.getSelection("my-movie-episode-grid"),
							idDisc: "'.$model->Id_my_movie_disc_nzb.'"
						}).success(
							function() 
							{
								$.fn.yiiGridView.update("disc-episodes-grid", {
									data: $(this).serialize()
								});
								unselectRow("my-movie-episode-grid");		
							}
						);
				}',
	'columns'=>array(
		'name',
		'episode_number',
		'description',
	),
)); ?>
</div>

<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Disc Episode
		</div>
</div>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'disc-episodes-grid',
			'dataProvider'=>$modelDiscEpisodes->search(),
			'filter'=>$modelDiscEpisodes,
			'summaryText'=>'',
			'columns'=>array(	
						array(
				 			'name'=>'episode_number',
							'value'=>'$data->myMovieEpisode->episode_number',
						),
						array(
				 			'name'=>'episode_name',
							'value'=>'$data->myMovieEpisode->name',
						),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array
					(
				        'delete' => array
						(
				            'url'=>'Yii::app()->createUrl("nzb/AjaxRemoveDiscEpisode", array("idEpisode"=>$data->Id_my_movie_episode,"idDisc"=>$data->Id_my_movie_disc_nzb))',
						),
					),
				),
		
			),			
			));		
		?>
	
	<div class="left">
		<div class="row buttons">
			<?php 			
									
				echo CHtml::submitButton('Finish', array('id'=>'finishButton'));
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
			'id'=>'newEpisode',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'New Episode',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Guardar'=>'js:function(){							
									jQuery("#waiting").dialog("open");
									jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveEpisode").'", $("#episode-form").serialize(),
									function(data) {
										$.fn.yiiGridView.update("my-movie-episode-grid");										
										jQuery("#waiting").dialog("close");
										$("#MyMovieEpisode_name").val(null);
										$("#MyMovieEpisode_description").val(null);
										$("#MyMovieEpisode_episode_number").val(null);
										jQuery("#newEpisode").dialog( "close" );
									},"json"
								);
							}',
							'Cancelar'=>'js:function(){
										$("#MyMovieEpisode_name").val(null);
										$("#MyMovieEpisode_description").val(null);
										$("#MyMovieEpisode_episode_number").val(null);
										jQuery("#newEpisode").dialog( "close" );
							}',
							'Buscar'=>'js:function()
								{
								jQuery("#waiting").dialog("open");
								jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSearchEpisode").'", $("#episode-form").serialize(),
								function(data) {
									if(data!=null)
									{
										$("#MyMovieEpisode_name").val(data.name);
										$("#MyMovieEpisode_description").val(data.description);
										$("#MyMovieEpisode_episode_number").val(data.episode_number);
									}
									else
									{
										$("#MyMovieEpisode_name").val(null);
										$("#MyMovieEpisode_description").val(null);
										$("#MyMovieEpisode_episode_number").val(null);
									}
								jQuery("#waiting").dialog("close");
								},"json"
						);
		
				}',
					),
			),
	));
	
	$modelNewEpisode = new MyMovieEpisode();
	$modelMyMovieAPIRequest = new MyMovieAPIRequest();
	$modelMyMovieAPIRequest->SerieGuid = $modelMyMovieEpisode->myMovieSeason->Id_my_movie_serie_header;
	$modelMyMovieAPIRequest->Seasonnumber = $modelMyMovieEpisode->myMovieSeason->season_number ;
	
	$modelNewEpisode->Id_my_movie_season = $modelMyMovieEpisode->Id_my_movie_season;
	
	echo $this->renderPartial('_formEpisode', array('model'=>$modelNewEpisode,
														'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,
													));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>