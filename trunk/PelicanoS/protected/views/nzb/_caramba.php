<div class="form">
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/detail-view-blue.css');
Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdata', "
$('#btnSearch').click(function()
{
	$('#div-searchResult').animate({opacity: 'hide'},240);
	$('#wating').dialog('open');
	$.fn.yiiGridView.update('search-result-grid', {
				data: $('#SearchDiscRequest_Title').serialize() + '&' + $('#SearchDiscRequest_Country').serialize()
	});
	
	return false;
});

$('#cancel').removeClass('ui-button');

$('#Imdbdata_Title').keypress(function() {
  $('#saveButton').attr('disabled','disabled');
});

$('#Imdbdata_ID').keypress(function() {
  $('#saveButton').attr('disabled','disabled');
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
	
<div id="conteiner" style="display: inline-block;">
	<div id="left" style="display: inline-block;">	
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelSearchDiscRequest,'Title'); ?>
			<?php echo CHtml::activeTextField($modelSearchDiscRequest,'Title',array('size'=>35,'maxlength'=>255)); ?>
		</div>
		<div class="row">
			<?php echo CHtml::activeLabelEx($modelSearchDiscRequest,'Country'); ?>
			<?php 
				$country = array('Argentina'=>'Argentina',
								'France'=>'France',
								'Germany'=>'Germany',
								'Italy'=>'Italy',
								'Mexico'=>'Mexico',
								'Spain'=>'Spain',
								'United Kingdom'=>'United Kingdom',
								'United States'=>'United States',);
				
				echo CHtml::activeDropDownList($modelSearchDiscRequest, 'Country', $country, array('prompt'=>'Select..')); ?>
		</div>
		<div class="row">
			<?php echo CHtml::button('Search', array('id'=>'btnSearch'));?>
		</div>
		<div id="div-searchResult" style="display: none; width:70%">
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
																var idTitle = $(this).attr("id");
																$.post("'.NzbController::createUrl('AjaxGetMovieMoreInfo').'",
																{
																	titleId :idTitle											
																}
															).success(
																function(data) 
																{
																	$("#movie-info").html(data);
																	
																}
															);
															return false;
																	
												});
								});	
					}',
			'selectionChanged'=>'js:function(){
								$.post("'.NzbController::createUrl('AjaxGetMovieMoreInfo').'",
										{
											titleId :$.fn.yiiGridView.getSelection("search-result-grid")											
										}
									).success(
										function(data) 
										{
											$("#movie-info").html(data);
											
										}
									);
					}',
		    'columns' => array(
		        array(
		            'name' => 'Title',
		            'type' => 'raw',
		            'value' => '$data->title'
		        ),
				array(
		            'name' => 'Original Title',
		            'type' => 'raw',
		            'value' => '$data->originalTitle'
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
					'name'=>'moreInfo',
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
		            'name' => 'Thumbnail',
		            'type' => 'raw',
		            'value' => 'CHtml::image(CHtml::encode($data->thumbnail), "image")',
				),
		
		    ),
		));
		CHtml::link($text)
		?>
		</div>
	</div>
	<div id="right" style="display: inline-block;width:200px; vertical-align: top;">
		<div id="movie-info"></div>
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