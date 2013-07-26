<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#update-auto-ripper', "

$('#cancelButton').click(function(){
	window.location = '".AutoRipperController::createUrl('admin')."';
	return false;
});

$('#btnSearch').click(function()
{
	$('#div-searchResult').animate({opacity: 'hide'},240);
	$('#saveButton').attr('disabled','disabled');
	$('#wating').dialog('open');
	$.fn.yiiGridView.update('search-result-grid', {
				data: $('#MyMovieAPIRequest_Title').serialize() + '&' + $('#MyMovieAPIRequest_Country').serialize() +
				'&' + $('input:radio').serialize()
	});
	
	return false;
});

$('.lnkMoreInfo').click(function(){
	$('#wating').dialog('open');
	var idTitle = $(this).attr('id');
	$.post('".AutoRipperController::createUrl('AjaxGetMovieMoreInfo')."',
		{
			titleId :idTitle											
		}
	).success(
		function(data) 
		{
			$('#popup-view-movie-info').html(data);
			$('#ViewMoreInfo').dialog('open');
			$('#wating').dialog('close');
		}
	).error(
		function()
		{
			$('#wating').dialog('close');
		});
		
	return false;
					
});

");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-ripper-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

echo CHtml::hiddenField("hiddenTitleId",'',array('id'=>'hiddenTitleId'));
echo CHtml::hiddenField("hiddenDiscName",'',array('id'=>'hiddenDiscName'));
?>

	<?php 
		$modelNzb = (isset($model->nzb))?$model->nzb:null;
		$title = '';
		$year = '';
		$description = '';
		$poster = '';
		if(isset($modelNzb))
		{
			$year = $modelNzb->myMovieDiscNzb->myMovieNzb->original_title;
			$title = $modelNzb->myMovieDiscNzb->myMovieNzb->production_year;
			$description = $modelNzb->myMovieDiscNzb->myMovieNzb->description;
			$poster = $modelNzb->myMovieDiscNzb->myMovieNzb->poster;
		}
		
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_disc'),
				'type'=>'raw',
				'value'=>$model->Id_disc, 
			),
			array('label'=>$model->getAttributeLabel('Id_auto_ripper_state'),
				'type'=>'raw',
				'value'=>$model->autoRipperState->description, 
			),
			array('label'=>$model->getAttributeLabel('name'),
				'type'=>'raw',
				'value'=>$model->name,
			),
			array('label'=>$model->getAttributeLabel('password'),
					'type'=>'raw',
					'value'=>$model->password,
			),
			array('label'=>$model->getAttributeLabel('Title'),
					'type'=>'raw',
					'value'=>$title,
			),
			array('label'=>$model->getAttributeLabel('Year'),
								'type'=>'raw',
								'value'=>$year,
			),
			array('label'=>$model->getAttributeLabel('Description'),
											'type'=>'raw',
											'value'=>$description,
			),
			array('label'=>$model->getAttributeLabel('Poster'),
								'type'=>'raw',
								'value'=>CHtml::image('images/'.$poster),
			),
		),
	)); ?>
<div id="search-movie-data">
	<div class="search-movie-data-fields">	
		<div style="width:40%;display: inline-block;">
			<?php
			echo CHtml::radioButtonList('rbnSearchField','imdb', array('title'=>'Title', 'imdb'=>'Imdb'), array(
									'labelOptions'=>array('style'=>'display:inline'),
                					'separator'=>' '
                					));
        	?>
        	<?php echo CHtml::activeTextField($modelMyMovieAPIRequest,'Title',array('maxlength'=>255)); ?>
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
				$modelMyMovieAPIRequest->Country = 'United States';
				echo CHtml::activeDropDownList($modelMyMovieAPIRequest, 'Country', $country, array('prompt'=>'Select..')); ?>
		</div>
		<div style="width:20%;display: inline-block;">
			<?php echo CHtml::button('Search', array('id'=>'btnSearch'));?>
		</div>
	</div>	
	<div id="div-searchResult" style=" width:100%">
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

					}',
			'selectionChanged'=>'js:function(){
						var titleId = $.fn.yiiGridView.getSelection("search-result-grid")
						var discName = $("#disc_name_"+titleId);
						if(titleId!=""){
							$("#hiddenTitleId").val(titleId);
							$("#hiddenDiscName").val(discName);
							$("#saveButton").removeAttr("disabled");
						}
						else
						{
							$("#hiddenTitleId").val("");
							$("#hiddenDiscName").val("");
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
		            'name' => 'disc name',
		            'type' => 'raw',
		            'value' => 'CHtml::hiddenField($data->id,$data->discname,array("id"=>"disc_name_".$data->id)).$data->discname'
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
							'value'=>'CHtml::image($data->thumbnail,"",array())',
							'type'=>'raw',					
							'htmlOptions'=>array("style"=>"text-align:right;"),
				),
		    ),
		));
		?>
	</div>
</div>

<div class="row buttons">
	<?php echo CHtml::submitButton('Save', array('id'=>'saveButton','disabled'=>'disabled')); 
		echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
	?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
//More info
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