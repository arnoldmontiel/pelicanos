<?php

$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Add subtitle</h1>

<div class="form">
<?php

Yii::app()->clientScript->registerScript('findSubtitle', "

$('#cancelButton').click(function(){
	window.location = '".NzbController::createUrl('view',array('id'=>$modelNzb->Id))."';
	return false;
});

$('#searchButton').click(function(){
	
	$('#wating').dialog('open');
	$('#div-searchResult').animate({opacity: 'hide'},240);
	$('#downloadSubtitle').attr('disabled', 'disabled');
	$('#selectedRow').val('');
	$('#div-error').animate({opacity: 'hide'},2000);
	var dataString = $('#Subtitle_query').serialize() + '&' 
							+ $('#Subtitle_season').serialize() + '&'
							+ $('#Subtitle_episode').serialize() + '&'
							+ $('#Subtitle_idImdb').serialize() + '&'
							+ $('#Subtitle_movieHash').serialize() + '&'
							+ $('#Subtitle_movieSize').serialize() + '&'
							+ $('#div-language').find('input:checked').serialize();
							
	$.post(
			'".NzbController::createUrl('AjaxDoSearchSubtitle')."',
			 	dataString
			 ).success(
					function(data) 
					{ 
						$.fn.yiiGridView.update('subtitle-grid', {
							data: $(this).serialize()
						});				
					}
			).error(
				function(data)
				{
					$('#div-error').html(data.responseText);				
					$('#div-error').animate({opacity: 'show'},2000);					
					$('#wating').dialog('close');
			});

	return false;
	
});

$('#downloadSubtitle').click(function(){
	$('#wating').dialog('open');
});



$(function() {
		$( '#tabs' ).tabs(
		{
		
		select: function(event, ui) {
				
		        if($(ui.tab).attr('id') == 'Q')
		        {
			        $('#Subtitle_idImdb').val(null);
					$('#Subtitle_movieHash').val(null);
					$('#Subtitle_movieSize').val(null);
		        }
		        else
		        {
		        	if($(ui.tab).attr('id') == 'I')
		        	{
						$('#Subtitle_query').val(null);
						$('#Subtitle_movieHash').val(null);
						$('#Subtitle_movieSize').val(null);
		        	}
		        	else
		        	{
		        		$('#Subtitle_idImdb').val(null);
						$('#Subtitle_query').val(null);
		        	}
		        }
	    	}
    	
		}
		);
				
		if($('#Subtitle_idImdb').val() != '')
			$( '#tabs' ).tabs().tabs('select',1);
		else
		{
			if($('#Subtitle_movieHash').val() != '')
				$( '#tabs' ).tabs().tabs('select',2);
		}
});
$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	return false;
    }
  });
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'findSubtitle-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$modelNzb,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$modelNzb->getAttributeLabel('Imdb'),
				'type'=>'raw',
				'value'=>$modelNzb->myMovieDiscNzb->myMovieNzb->imdb, 
			),
			array('label'=>$modelNzb->getAttributeLabel('Title'),
				'type'=>'raw',
				'value'=>$modelNzb->myMovieDiscNzb->myMovieNzb->original_title, 
			),
			array('label'=>$modelNzb->getAttributeLabel('Year'),
				'type'=>'raw',
				'value'=>$modelNzb->myMovieDiscNzb->myMovieNzb->production_year,
			),
			'file_original_name',
			'subt_file_name',
			'subt_original_name'
		),
	)); ?>
<br>	
<div style="width:50%;float:left">
	<div id="tabs" >
		<ul>
			<li><a id="Q" href="#tabs-1">By String</a></li>
			<li><a id="I" href="#tabs-2">By Id Imdb</a></li>
			<li><a id="S" href="#tabs-3">By Size</a></li>
		</ul>
		<div id="tabs-1">
			<div >	
				<?php echo $form->labelEx($model,'query'); ?>
				<?php echo $form->textField($model,'query',array('size'=>30,'maxlength'=>100));?>
			</div>
		</div>
		<div id="tabs-2">
			<div >
				<?php echo $form->labelEx($model,'idImdb'); ?>
				<?php echo $form->textField($model,'idImdb',array('size'=>30,'maxlength'=>100));?>
			</div>
		</div>
		<div id="tabs-3">
			<div >
				<?php echo $form->labelEx($model,'movieHash'); ?>
				<?php echo $form->textField($model,'movieHash',array('size'=>30,'maxlength'=>100));?>
			</div>
			
			<div >
				<?php echo $form->labelEx($model,'movieSize'); ?>
				<?php echo $form->textField($model,'movieSize',array('size'=>30,'maxlength'=>100));?>
			</div>
		</div>
	</div>
	<div style="width:30%;float:left">
		<?php echo CHtml::submitButton('Search',array('id'=>'searchButton','name'=>'searchButton')); ?>
	</div>
	<div style="width:70%;float:left">
		<p id="loading">&nbsp;</p>
	</div>
	<p class="note" >To save a subtitle, first you must select a gird row.</p>
</div><!-- div left (with tabs) -->
<div style="width:50%;float:left">
	<div style="width:45%;float:left;margin:10px">
		<?php echo $form->labelEx($model,'season'); ?>
		<?php echo $form->textField($model,'season',array('size'=>5,'maxlength'=>5));?>
		<?php echo $form->labelEx($model,'episode'); ?>
		<?php echo $form->textField($model,'episode',array('size'=>5,'maxlength'=>5));?>
	</div>
	<div style="width:45%;float:left" id="div-language">
	<?php echo $form->labelEx($model,'Select language'); ?>
		<table>
		<?php 
		echo $form->checkBoxList($model, 'language',array('spa'=>'Spanish','ita'=>'Italian','fre'=>'French','eng'=>'English','pob'=>'Portuguese-BR','ger'=>'German')
		,array(
		'template'=>'<tr><td>{input}</td><td>{label}</td></tr>',
		'separator' => '',// es necesario eliminar el separador
		//Estos parametros son opcionales
		
		//'style' => 'width: 5px;',
		)
		
		); ?>
		</table>
	</div>
</div><!-- dib right (with season and language) -->

<div id="div-error" class="messageError" style="display:none;width:100%">
</div>	
<div id="div-searchResult" style="display:none;width:100%">
<?php 

$this->widget('ext.processingDialog.processingDialog', array(
					'buttons'=>array('none'),
					'idDialog'=>'wating',
));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subtitle-grid',
	'dataProvider'=>$modelOpenSubtitle->search(),
	'filter'=>$modelOpenSubtitle,
	'summaryText'=>'',
	'afterAjaxUpdate'=>'js:function(){
								$("#wating").dialog("close");
								$("#div-searchResult").animate({opacity: "show"},240);								
					}',
	'columns'=>array(
			'SubFileName',
			array(
	 			'name'=>'ZipDownloadLink',
				'value' => 'CHtml::link($data->ZipDownloadLink, $data->ZipDownloadLink, array(target=>_blank))',
            	'type'  => 'html',
			),
			'MovieName',
			'SeriesSeason',
			'SeriesEpisode',
			'LanguageName',
	),
	'selectionChanged'=>'js:function(){
						
						if($.fn.yiiGridView.getSelection("subtitle-grid") != ""){
							$("#selectedRow").val($.fn.yiiGridView.getSelection("subtitle-grid"));
							$("#downloadSubtitle").removeAttr("disabled");
						}
						else{
							$("#downloadSubtitle").attr("disabled","disabled");							
							$("#selectedRow").val("");
						}
					}',
)); ?>
</div><!-- girdView -->

<?php echo CHtml::hiddenField('selectedRow','',array('id'=>'selectedRow')); ?>

<div style="width:50%;float:left">
	<div style="width:40%;float:left">		<?php echo CHtml::submitButton('Save Subtitle',array('id'=>'downloadSubtitle','name'=>'downloadSubtitle', 'disabled'=>'disabled')); ?>
	</div>		
	<div style="width:58%;float:right"> 	
		 <p id="loadingSave" style="float:left;width:20px">&nbsp;</p>
	</div>
</div><!-- div button save -->
<div style="width:50%;float:right;position:relative">
<?php echo CHtml::submitButton('Cancel',array('id'=>'cancelButton','name'=>'cancelButton')); ?>
</div><!-- div button cancel -->
<?php $this->endWidget(); ?>
</div> <!-- form -->