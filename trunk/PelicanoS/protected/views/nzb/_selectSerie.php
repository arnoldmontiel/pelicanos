<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#selectSerie', "

$('#saveButton').click(function(){
	$('#wating').dialog('open');
});

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('index')."';
	return false;
});
 
$('#Nzb_points').keyup(function(){
	validateNumber($(this));
});  
");
?>

<?php echo CHtml::beginForm('','post');

	echo CHtml::hiddenField("hiddenSerieId",'',array('id'=>'hiddenSerieId'));
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
		Serie Data
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Serie','#',array('onclick'=>'jQuery("#newSerie").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-movie-serie-header-grid',
	'dataProvider'=>$modelMyMovieSerieHeader->search(),
	'filter'=>$modelMyMovieSerieHeader,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){
							var idHeader = $.fn.yiiGridView.getSelection("my-movie-serie-header-grid")
							if(idHeader!=""){
								$("#hiddenSerieId").val(idHeader);								
								$("#saveButton").removeAttr("disabled");
							}
							else
							{
								$("#hiddenSerieId").val("");
								$("#saveButton").attr("disabled","disabled");
							}
						}',
	'columns'=>array(
		'name',
		'genre',
		'description',
		'original_status',
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
			'id'=>'newSerie',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'New Serie',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Guardar'=>'js:function(){							
									jQuery("#waiting").dialog("open");
									jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveSerieHeader").'", $("#serie-header-form").serialize(),
									function(data) {
										$.fn.yiiGridView.update("my-movie-serie-header-grid", {
											data:$("#MyMovieSerieHeader_name").serialize()
										});									
										jQuery("#waiting").dialog("close");
										$("#MyMovieSerieHeader_Id").val(null);
										$("#MyMovieSerieHeader_description").val(null);
										$("#MyMovieSerieHeader_poster_original").val(null);
										$("#MyMovieSerieHeader_genre").val(null);
										$("#MyMovieSerieHeader_name").val(null);
										$("#MyMovieSerieHeader_sort_name").val(null);
										$("#MyMovieSerieHeader_rating").val(null);
										$("#MyMovieSerieHeader_original_network").val(null);
										$("#MyMovieSerieHeader_original_status").val(null);
										jQuery("#newSerie").dialog( "close" );
									},"json"
								);
							}',
							'Cancelar'=>'js:function(){
										$("#MyMovieSerieHeader_Id").val(null);
										$("#MyMovieSerieHeader_description").val(null);
										$("#MyMovieSerieHeader_poster_original").val(null);
										$("#MyMovieSerieHeader_genre").val(null);
										$("#MyMovieSerieHeader_name").val(null);
										$("#MyMovieSerieHeader_sort_name").val(null);
										$("#MyMovieSerieHeader_rating").val(null);
										$("#MyMovieSerieHeader_original_network").val(null);
										$("#MyMovieSerieHeader_original_status").val(null);
										$("#serie_poster_img").attr("src", "");
										jQuery("#newSerie").dialog( "close" );
							}',
							'Buscar'=>'js:function()
								{
								jQuery("#waiting").dialog("open");
								jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSearchSerieHeader").'", $("#serie-header-form").serialize(),
								function(data) {
									if(data!=null)
									{
										$("#MyMovieSerieHeader_Id").val(data.Id);
										$("#MyMovieSerieHeader_description").val(data.description);
										$("#MyMovieSerieHeader_poster_original").val(data.poster_original);
										$("#MyMovieSerieHeader_genre").val(data.genre);
										$("#MyMovieSerieHeader_name").val(data.name);
										$("#MyMovieSerieHeader_sort_name").val(data.sort_name);
										$("#MyMovieSerieHeader_rating").val(data.rating);
										$("#MyMovieSerieHeader_original_network").val(data.original_network);
										$("#MyMovieSerieHeader_original_status").val(data.original_status);
										$("#serie_poster_img").attr("src", data.poster_original);
									}
									else
									{
										$("#MyMovieSerieHeader_Id").val(null);
										$("#MyMovieSerieHeader_description").val(null);
										$("#MyMovieSerieHeader_poster_original").val(null);
										$("#MyMovieSerieHeader_genre").val(null);
										$("#MyMovieSerieHeader_name").val(null);
										$("#MyMovieSerieHeader_sort_name").val(null);
										$("#MyMovieSerieHeader_rating").val(null);
										$("#MyMovieSerieHeader_original_network").val(null);
										$("#MyMovieSerieHeader_original_status").val(null);
										$("#serie_poster_img").attr("src", "");
									}
								jQuery("#waiting").dialog("close");
								},"json"
						);
		
				}',
					),
			),
	));
	
	$modelNewSerie = new MyMovieSerieHeader();
	$modelMyMovieAPIRequest = new MyMovieAPIRequest();
	echo $this->renderPartial('_formSerie', array('model'=>$modelNewSerie,
														'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,
													));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>