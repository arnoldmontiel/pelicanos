<?php

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Add subtitle</h1>

<div class="form">
<?php

Yii::app()->clientScript->registerScript('findSubtitle', "

$('#searchButton').click(function(){
			$(this).attr('disabled', 'disabled');
			$('downloadSubtitle').attr('disabled', 'disabled');
			$('#cancel').attr('disabled', 'disabled');
			$('#loading').addClass('input-loading');
			$('#selectedRow').val('');
			$(this).parents('form').submit();
			});
$('#downloadSubtitle').click(function(){
			$(this).attr('disabled', 'disabled');
			$('#searchButton').attr('disabled', 'disabled');
			$('#cancel').attr('disabled', 'disabled');
			$('#loadingSave').addClass('input-loading');
			$(this).parents('form').submit();
				});				
$(function() {

		$('#cancel').removeClass('ui-button ui-widget ui-state-default ui-corner-all');
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
			'Id_imdbdata',
			array('label'=>$modelNzb->getAttributeLabel('Title'),
				'type'=>'raw',
				'value'=>$modelNzb->imdbData->Title
			),
			array('label'=>$modelNzb->getAttributeLabel('Year'),
				'type'=>'raw',
				'value'=>$modelNzb->imdbData->Year
			),
			'file_name',
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
	<div style="width:45%;float:left">
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

	

<div class="rows">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subtitle-grid',
	'dataProvider'=>$modelOpenSubtitle->search(),
	'filter'=>$modelOpenSubtitle,
	'summaryText'=>'',
	'columns'=>array(
			'SubFileName',
			array(
	 			'name'=>'ZipDownloadLink',
				'value' => 'CHtml::link($data->ZipDownloadLink, $data->ZipDownloadLink, array(target=>_blank))',
            	'type'  => 'html',
			),
			'MovieNameEng',
			'SeriesSeason',
			'SeriesEpisode',
			'LanguageName',
	),
	'selectionChanged'=>'js:function(){
						
						if($.fn.yiiGridView.getSelection("subtitle-grid") != ""){
							$("#selectedRow").val($.fn.yiiGridView.getSelection("subtitle-grid"));
							$("#downloadSubtitle").show();
							}
						else{
							$("#downloadSubtitle").hide();
							$("#selectedRow").val("");
							}
					}',
)); ?>
</div><!-- girdView -->

<?php echo CHtml::hiddenField('selectedRow','',array('id'=>'selectedRow')); ?>

<div style="width:50%;float:left">
	<div style="width:40%;float:left">		<?php echo CHtml::submitButton('Save Subtitle',array('id'=>'downloadSubtitle','name'=>'downloadSubtitle', 'style'=>'display:none')); ?>
	</div>		
	<div style="width:58%;float:right"> 	
		 <p id="loadingSave" style="float:left;width:20px">&nbsp;</p>
	</div>
</div><!-- div button save -->
<div style="width:50%;float:right;position:relative">
<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'cancel',
			 	'name'=>'Cancel',
			 	'caption'=>'Cancel',
			 	'value'=>'Cancel',
		        //'cssFile'=>'',
			 	'onclick'=>'js:function(){
			 		window.location = "'.NzbController::createUrl('view',array('id'=>$modelNzb->Id)).'";
			 		return false;
				}',
		 	)
		 );
	 ?>		 
</div><!-- div button cancel -->
<?php $this->endWidget(); ?>
</div> <!-- form -->