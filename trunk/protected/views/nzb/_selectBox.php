<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#selectBox', "
$('#Upload_file').change(function() {
	if($('#hiddenMyMovieNzbId').val() != '' && $(this).val() != '')
  		$('#saveButton').removeAttr('disabled');
});

$('#saveButton').click(function(){
	$('#waiting').dialog('open');
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

<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'));

	echo CHtml::hiddenField("hiddenMyMovieNzbId",'',array('id'=>'hiddenMyMovieNzbId'));
?>

<div class="row"> 
	<?php echo CHtml::activeLabelEx($modelUpload,'File *.nzb'); ?>
	<?php echo CHtml::activeFileField($modelUpload, 'file',array('size'=>50))?>
	<?php echo CHtml::error($modelUpload, 'file')?>
</div>	

	<div id="resourceType" style="margin-bottom: 5px">
		<?php	$rsrcType = CHtml::listData($ddlRsrcType, 'Id', 'description');?>
		<?php echo CHtml::activeLabelEx($model,'Id_resource_type'); ?>
		<?php echo CHtml::activeDropDownList($model, 'Id_resource_type', $rsrcType);?>
		<?php echo CHtml::error($model,'Id_resource_type'); ?>
	</div>

	<div id="points" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($model,'points'); ?>
		<?php echo CHtml::activeTextField($model, 'points');?>
		<?php echo CHtml::error($model,'points'); ?>
	</div>
	
	<div id="name" style="margin-bottom: 5px">
		<?php echo CHtml::activeLabelEx($modelMyMovieDiscNzb,'name'); ?>
		<?php echo CHtml::activeTextField($modelMyMovieDiscNzb, 'name');?>
		<?php echo CHtml::error($modelMyMovieDiscNzb,'name'); ?>
	</div>
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Box Data
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Box','#',array('onclick'=>'jQuery("#newBox").dialog("open"); return false;'));?>
		</div>
	</div>
</div>

<div  style="display: inline-block;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-movie-nzb-grid',
	'dataProvider'=>$modelMyMovieNzb->searchSerie(),
	'filter'=>$modelMyMovieNzb,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(){
							var idMyMovieNzb = $.fn.yiiGridView.getSelection("my-movie-nzb-grid")
							if(idMyMovieNzb!=""){
								$("#hiddenMyMovieNzbId").val(idMyMovieNzb);
								if($("#Upload_file").val() != "")
									$("#saveButton").removeAttr("disabled");
							}
							else
							{
								$("#hiddenMyMovieNzbId").val("");
								$("#saveButton").attr("disabled","disabled");
							}
						}',
	'columns'=>array(
		'original_title',
		'type',
		'description',
		'production_year',
		'studio',
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
			'id'=>'newBox',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'New Box',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Guardar'=>'js:function(){							
									jQuery("#waiting").dialog("open");
									jQuery.post("'.Yii::app()->createUrl("nzb/ajaxSaveBox").'", $("#box-form").serialize(),
									function(data) {
										$.fn.yiiGridView.update("my-movie-nzb-grid", {
											data:$("#MyMovieNzb_original_title").serialize()
										});									
										jQuery("#waiting").dialog("close");
										$("#MyMovieNzb_description").val(null);
										$("#MyMovieNzb_original_title").val(null);										
										$("#MyMovieNzb_type").val(null);										
										$("#MyMovieNzb_production_year").val(null);										
										$("#MyMovieNzb_studio").val(null);
										$("#MyMovieNzb_poster_original").val(null);										
										$("#MyMovieNzb_backdrop_original").val(null);
										jQuery("#newBox").dialog( "close" );
									},"json"
								);
							}',
							'Cancelar'=>'js:function(){								
										$("#MyMovieNzb_description").val(null);												
										$("#MyMovieNzb_original_title").val(null);										
										$("#MyMovieNzb_type").val(null);										
										$("#MyMovieNzb_production_year").val(null);										
										$("#MyMovieNzb_studio").val(null);
										$("#MyMovieNzb_poster_original").val(null);										
										$("#MyMovieNzb_backdrop_original").val(null);
										jQuery("#newBox").dialog( "close" );
							}',
					),
			),
	));
	
	$modelNewBox = new MyMovieNzb();
	$ddlParentalControl = ParentalControl::model()->findAll();
	echo $this->renderPartial('_formBox', array('model'=>$modelNewBox,
												'ddlParentalControl'=>$ddlParentalControl,
													));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>