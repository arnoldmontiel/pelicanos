<div class="form">
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#newMovie', "
$('#btnSearch').click(function()
{
	$('#div-searchResult').animate({opacity: 'hide'},240);
	$('#saveButton').attr('disabled','disabled');
	$('#wating').dialog('open');
	$.fn.yiiGridView.update('search-result-grid', {
				data: $('#MyMovieAPIRequest_Title').serialize() + '&' + $('#MyMovieAPIRequest_Country').serialize()
	});
	
	return false;
});


$('#Upload_file').change(function() {
	if($('#hiddenTitleId').val() != '' && $(this).val() != '')
  		$('#saveButton').removeAttr('disabled');
});

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

<?php echo CHtml::beginForm('','post',array
		('enctype'=>'multipart/form-data'));

	echo CHtml::hiddenField("hiddenTitleId",'',array('id'=>'hiddenTitleId'));
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
	
<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Movie Data
	</div>
</div>
	
<div id="search-movie-data">
	<div class="search-movie-data-fields">	
		<div style="width:40%;display: inline-block;">
			<?php echo CHtml::activeLabelEx($modelMyMovieAPIRequest,'Title'); ?>
			<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'Title',array('size'=>35,'maxlength'=>255)); ?>
		</div>
		<div style="width:20%;display: inline-block;">
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
		<div style="width:20%;display: inline-block;">
			<?php echo CHtml::button('Search', array('id'=>'btnSearch'));?>
		</div>
	</div>	
	<div id="div-searchResult" style="display: none; width:100%">
		<?php
		
		$this->widget('ext.processingDialog.processingDialog', array(
					'buttons'=>array('none'),
					'idDialog'=>'wating',
		));
		
		$this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider' => $arrayDataProvider,
		    'id'=>'search-result-grid',
			'summaryText'=>'',
			'afterAjaxUpdate'=>'js:function(){
						$("#wating").dialog("close");
						$("#div-searchResult").animate({opacity: "show"},240);
						
						$("#search-result-grid").find(".lnkMoreInfo").each(
											function(index, item){
															$(item).click(function(){
																$("#wating").dialog("open");
																var idTitle = $(this).attr("id");
																$.post("'.NzbController::createUrl('AjaxGetMovieMoreInfo').'",
																{
																	titleId :idTitle											
																}
															).success(
																function(data) 
																{
																	$("#popup-view-movie-info").html(data);
																	$("#ViewMoreInfo").dialog("open");
																	$("#wating").dialog("close");
																}
															).error(
																function()
																{
																	$("#wating").dialog("close");
																});
															return false;
																	
												});
								});

						$("#search-result-grid").find(".lnkImage").each(
											function(index, item){
														$(item).click(function(){
															return false;
														});
														$(item).hover(
															function () {
    															$(this).find("spam").hide();
    															$(this).find("img").show();
  															}, 
  															function () {
  																$(this).find("img").hide();
  																$(this).find("spam").show();
  															}															
																	
												);
								});	
					}',
			'selectionChanged'=>'js:function(){
						var titleId = $.fn.yiiGridView.getSelection("search-result-grid")
						if(titleId!=""){
							$("#hiddenTitleId").val(titleId);
							if($("#Upload_file").val() != "")
								$("#saveButton").removeAttr("disabled");
						}
						else
						{
							$("#hiddenTitleId").val("");
							$("#saveButton").attr("disabled","disabled");
						}
					}',
		    'columns' => array(
		        array(
		            'name' => 'Title',
		            'type' => 'raw',
		            'value' => '$data->title'
		        ),
		        array(
		            'name' => 'country',
		            'type' => 'raw',
		            'value' => '$data->country'
		        ),
				array(
		            'name' => 'year',
		            'type' => 'raw',
		            'value' => '$data->year'
				),
				array(
		            'name' => 'edition',
		            'type' => 'raw',
		            'value' => '$data->edition'
				),
				array(
		            'name' => 'Imdb Id',
		            'type' => 'raw',
		            'value' => '$data->imdb'
				),
				array(
		            'name' => 'type',
		            'type' => 'raw',
		            'value' => '$data->type'
				),
				array(
					'name'=>'',
					'value'=>'CHtml::link("more info",
												"#",
												array(
														"id"=>$data->id,
														"class"=>"lnkMoreInfo",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',					
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
							'name'=>'',
							'value'=>'CHtml::link("<spam>image</spam>". CHtml::image($data->thumbnail,"",array("style"=>"display:none",)) ,
														"#",
														array(
																"id"=>$data->id. "_img",
																"class"=>"lnkImage",
															)
													)',
		
							'type'=>'raw',					
							'htmlOptions'=>array("style"=>"text-align:right;"),
				),
		    ),
		));
		?>
	</div>
</div>

<div class="left" style="display: inline-block;">
	
</div>

	
	<div class="left">
		<div class="row buttons">
			<?php 			
									
				echo CHtml::submitButton($model->isNewRecord ? 'Create and find Subtitle' : 'Save', array('id'=>'saveButton','disabled'=>'disabled'));
				echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
			?>		
		</div>
	</div>
<?php echo CHtml::endForm()?>

</div><!-- form -->

<?php
//ProductType
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'ViewMoreInfo',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Movie Info',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							'Aceptar'=>'js:function(){jQuery("#ViewMoreInfo").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'popup-view-movie-info','style'=>'position:relative;display:inline-block;width:97%'));
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>