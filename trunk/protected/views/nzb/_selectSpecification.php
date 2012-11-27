<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#selectEpisode', "

$('#finishButton').click(function(){
	window.location = '".NzbController::createUrl('findSubtitle',array('id'=>$model->Id))."';
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
			array('label'=>$model->getAttributeLabel('original_title'),
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->original_title, 
			),
			array('label'=>$model->getAttributeLabel('production_year'),
				'type'=>'raw',
				'value'=>$model->myMovieDiscNzb->myMovieNzb->production_year, 
			),
		),
	)); ?>
<br>	
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Audio Track
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Audio Track','#',array('onclick'=>'jQuery("#newAudioTrack").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audio-track-grid',
	'dataProvider'=>$modelAudioTrack->search(),
	'filter'=>$modelAudioTrack,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){							
						$.get(	"'.NzbController::createUrl('AjaxAddAudioTrack').'",
						{
							idAudioTrack:$.fn.yiiGridView.getSelection("audio-track-grid"),
							idMyMovieNzb: "'.$model->myMovieDiscNzb->Id_my_movie_nzb.'"
						}).success(
							function() 
							{
								$.fn.yiiGridView.update("my-movie-nzb-audio-track-grid", {
									data: $(this).serialize()
								});
								unselectRow("audio-track-grid");		
							}
						);
				}',
	'columns'=>array(
		'language',
		'type',
		'chanel',
	),
)); ?>
</div>

<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Audio Track Selected
		</div>
</div>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'my-movie-nzb-audio-track-grid',
			'dataProvider'=>$modelNzbAudioTrack->search(),
			'filter'=>$modelNzbAudioTrack,
			'summaryText'=>'',
			'columns'=>array(	
						array(
				 			'name'=>'language',
							'value'=>'$data->audioTrack->language',
						),
						array(
				 			'name'=>'type',
							'value'=>'$data->audioTrack->type',
						),
						array(
				 			'name'=>'chanel',
							'value'=>'$data->audioTrack->chanel',
						),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array
					(
				        'delete' => array
						(
				            'url'=>'Yii::app()->createUrl("nzb/AjaxRemoveAudioTrack", array("idAudioTrack"=>$data->Id_audio_track,"idMyMovieNzb"=>$data->Id_my_movie_nzb))',
						),
					),
				),
		
			),			
			));		
		?>

<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Subtitle
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Subtitle','#',array('onclick'=>'jQuery("#newSubtitle").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subtitle-grid',
	'dataProvider'=>$modelSubtitle->search(),
	'filter'=>$modelSubtitle,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){							
						$.get(	"'.NzbController::createUrl('AjaxAddSubtitle').'",
						{
							idSubtitle:$.fn.yiiGridView.getSelection("subtitle-grid"),
							idMyMovieNzb: "'.$model->myMovieDiscNzb->Id_my_movie_nzb.'"
						}).success(
							function() 
							{
								$.fn.yiiGridView.update("my-movie-nzb-subtitle-grid", {
									data: $(this).serialize()
								});
								unselectRow("subtitle-grid");		
							}
						);
				}',
	'columns'=>array(
		'language',
	),
)); ?>
</div>

<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Subtitle Selected
		</div>
</div>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'my-movie-nzb-subtitle-grid',
			'dataProvider'=>$modelNzbSubtitle->search(),
			'filter'=>$modelNzbSubtitle,
			'summaryText'=>'',
			'columns'=>array(	
						array(
				 			'name'=>'language',
							'value'=>'$data->subtitle->language',
						),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array
					(
				        'delete' => array
						(
				            'url'=>'Yii::app()->createUrl("nzb/AjaxRemoveSubtitle", array("idSubtitle"=>$data->Id_subtitle,"idMyMovieNzb"=>$data->Id_my_movie_nzb))',
						),
					),
				),
		
			),			
			));		
		?>	

<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Person
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Person','#',array('onclick'=>'jQuery("#newPerson").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'person-grid',
	'dataProvider'=>$modelPerson->search(),
	'filter'=>$modelPerson,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){							
						$.get(	"'.NzbController::createUrl('AjaxAddPerson').'",
						{
							idPerson:$.fn.yiiGridView.getSelection("person-grid"),
							idMyMovieNzb: "'.$model->myMovieDiscNzb->Id_my_movie_nzb.'"
						}).success(
							function() 
							{
								$.fn.yiiGridView.update("my-movie-nzb-person-grid", {
									data: $(this).serialize()
								});
								unselectRow("person-grid");		
							}
						);
				}',
	'columns'=>array(
		'name',
		'type',
		'role',
	),
)); ?>
</div>

<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Person Selected
		</div>
</div>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'my-movie-nzb-person-grid',
			'dataProvider'=>$modelNzbPerson->search(),
			'filter'=>$modelNzbPerson,
			'summaryText'=>'',
			'columns'=>array(	
						array(
				 			'name'=>'name',
							'value'=>'$data->person->name',
						),
						array(
				 			'name'=>'type',
							'value'=>'$data->person->type',
						),
						array(
				 			'name'=>'role',
							'value'=>'$data->person->role',
						),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array
					(
				        'delete' => array
						(
				            'url'=>'Yii::app()->createUrl("nzb/AjaxRemovePerson", array("idPerson"=>$data->Id_person,"idMyMovieNzb"=>$data->Id_my_movie_nzb))',
						),
					),
				),
		
			),			
			));		
		?>	
	
	<div class="left">
		<div class="row buttons">
			<?php 			
									
				echo CHtml::submitButton('Next', array('id'=>'finishButton'));
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
//New audioTrack dialog
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'newAudioTrack',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'New Audio Track',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Guardar'=>'js:function(){							
									jQuery("#waiting").dialog("open");
									jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveAudioTrack").'", $("#audio-track-form").serialize(),
									function(data) {
										$.fn.yiiGridView.update("audio-track-grid", {
											data:$("#AudioTrack_language").serialize() + "&" + $("#AudioTrack_type").serialize() + "&" + $("#AudioTrack_chanel").serialize() 
										});									
										jQuery("#waiting").dialog("close");
										$("#AudioTrack_language").val(null);												
										$("#AudioTrack_type").val(null);										
										$("#AudioTrack_chanel").val(null);
										jQuery("#newAudioTrack").dialog( "close" );
									},"json"
								);
							}',
							'Cancelar'=>'js:function(){								
										$("#AudioTrack_language").val(null);												
										$("#AudioTrack_type").val(null);										
										$("#AudioTrack_chanel").val(null);										
										jQuery("#newAudioTrack").dialog( "close" );
							}',
					),
			),
	));
	
	$modelNewAudioTrack = new AudioTrack();
	echo $this->renderPartial('_formAudioTrack', array('model'=>$modelNewAudioTrack,
													));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
//New subtitle dialog
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'newSubtitle',
	// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'New Subtitle',
						'autoOpen'=>false,
						'modal'=>true,
						'width'=> '600',
						'buttons'=>	array(
								'Guardar'=>'js:function(){							
										jQuery("#waiting").dialog("open");
										jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveSubtitle").'", $("#subtitle-form").serialize(),
										function(data) {
											$.fn.yiiGridView.update("subtitle-grid", {
												data:$("#Subtitle_language").serialize() 
											});									
											jQuery("#waiting").dialog("close");
											$("#Subtitle_language").val(null);												
											jQuery("#newSubtitle").dialog( "close" );
										},"json"
									);
								}',
								'Cancelar'=>'js:function(){								
											$("#Subtitle_language").val(null);												
											jQuery("#newSubtitle").dialog( "close" );
								}',
	),
	),
	));
	
	$modelNewSubtitle = new Subtitle();
	echo $this->renderPartial('_formSubtitle', array('model'=>$modelNewSubtitle,
	));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	

//New person dialog
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
					'id'=>'newPerson',
	// additional javascript options for the dialog plugin
					'options'=>array(
							'title'=>'New Person',
							'autoOpen'=>false,
							'modal'=>true,
							'width'=> '600',
							'buttons'=>	array(
									'Guardar'=>'js:function(){							
											jQuery("#waiting").dialog("open");
											jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSavePerson").'", $("#person-form").serialize(),
											function(data) {
												$.fn.yiiGridView.update("person-grid", {
													data:$("#Person_name").serialize() 
												});									
												jQuery("#waiting").dialog("close");
												$("#Person_name").val(null);												
												$("#Person_role").val(null);
												jQuery("#newPerson").dialog( "close" );
											},"json"
										);
									}',
									'Cancelar'=>'js:function(){								
												$("#Person_name").val(null);												
												$("#Person_role").val(null);												
												jQuery("#newPerson").dialog( "close" );
									}',
	),
	),
	));
	
	$modelNewPerson = new Person();
	echo $this->renderPartial('_formPerson', array('model'=>$modelNewPerson,
	));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>