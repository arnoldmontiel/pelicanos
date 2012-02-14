
<div class="form">
<?php

Yii::app()->clientScript->registerScript('findSubtitle', "

$('input[name=searchFilter]').click(function(){
	
	if($(this).val() == 'Q')
	{
		$('#Subtitle_idImdb').attr( 'disabled', true );
		$('#Subtitle_idImdb').val(null);
		$('#Subtitle_movieHash').attr( 'disabled', true );
		$('#Subtitle_movieHash').val(null);
		$('#Subtitle_movieSize').attr( 'disabled', true );
		$('#Subtitle_movieSize').val(null);
		
		$('#Subtitle_query').attr( 'disabled', false );
		$('#Subtitle_query').focus();
	}
	else
	{
		if($(this).val() == 'I')
		{
			$('#Subtitle_query').attr( 'disabled', true );
			$('#Subtitle_query').val(null);
			$('#Subtitle_movieHash').attr( 'disabled', true );
			$('#Subtitle_movieHash').val(null);
			$('#Subtitle_movieSize').attr( 'disabled', true );
			$('#Subtitle_movieSize').val(null);
			
			$('#Subtitle_idImdb').attr( 'disabled', false );
			$('#Subtitle_idImdb').focus();
		}
		else
		{
			$('#Subtitle_idImdb').attr( 'disabled', true );
			$('#Subtitle_idImdb').val(null);
			$('#Subtitle_query').attr( 'disabled', true );
			$('#Subtitle_query').val(null);
			
			$('#Subtitle_movieHash').attr( 'disabled', false );
			$('#Subtitle_movieSize').attr( 'disabled', false );
			$('#Subtitle_movieHash').focus();
		}
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
			'file_name'
		),
	)); ?>
	
<div id="byQuery" style="float:left;position:relative;display:block;width:30%;left:0px;margin:4px">
	<input name="searchFilter" value="Q" checked type="radio" type="text" value=""/>
	<div >	
		<?php echo $form->labelEx($model,'query'); ?>
		<?php echo $form->textField($model,'query',array('size'=>30,'maxlength'=>100));?>
	</div>
</div>
<div id="byImdb" style="float:left;position:relative;display:block;width:30%;left:0px;margin:4px">
	<input name="searchFilter" value="I" type="radio" type="text" value=""/>
	<div >
		<?php echo $form->labelEx($model,'idImdb'); ?>
		<?php echo $form->textField($model,'idImdb',array('size'=>30,'maxlength'=>100,'disabled'=>true));?>
	</div>
</div>
<div id="bySize" style="float:left;position:relative;display:block;width:33%;left:0px;margin:4px">
	<input name="searchFilter" value="S" type="radio" type="text" value=""/>	
	<div >
		<?php echo $form->labelEx($model,'movieHash'); ?>
		<?php echo $form->textField($model,'movieHash',array('size'=>30,'maxlength'=>100,'disabled'=>true));?>
	</div>
	
	<div >
		<?php echo $form->labelEx($model,'movieSize'); ?>
		<?php echo $form->textField($model,'movieSize',array('size'=>30,'maxlength'=>100,'disabled'=>true));?>
	</div>
</div>	
<br>

	<div class="rows">
		<?php echo $form->labelEx($model,'season'); ?>
		<?php echo $form->textField($model,'season',array('size'=>30,'maxlength'=>100));?>
		<?php echo $form->labelEx($model,'episode'); ?>
		<?php echo $form->textField($model,'episode',array('size'=>30,'maxlength'=>100));?>
	</div>
	
	<br>
	<div class="rows">
		<?php echo $form->labelEx($model,'Select language'); ?>
		<table>
			<tr>
		<?php 
		echo $form->checkBoxList($model, 'language',array('spa'=>'Spanish','ita'=>'Italian','fre'=>'French','eng'=>'English','pob'=>'Portuguese-BR','ger'=>'German')
		,array(
		'template'=>'<td>{input}</td><td>{label}</td>',
		'separator' => '',// es necesario eliminar el separador
		//Estos parametros son opcionales
		
		'style' => 'width: 50px;',
		)
		
		); ?>
		</tr>
		</table>
	</div>	
<div class="right" style="margin-left:1px; width: 48%; ">
		<div class="row buttons">
			<?php echo CHtml::submitButton('Search'); ?>
		</div>
	</div>
	<br>
	<br>
<div class="rows">
<p class="note">Select row to save subtitle.</p>
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
						$("#downloadSubtitle").show();
					}',
)); ?>
</div>


<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'downloadSubtitle',
			 	'name'=>'download',
			 	'caption'=>'Save Subtitle',
			 	'value'=>'Click to download subtitle',
			 	'onclick'=>'js:function(){
			 		if(confirm("Save button clicked" + $.fn.yiiGridView.getSelection("subtitle-grid")))
			 		{
						$.post("'.NzbController::createUrl('AjaxDownloadSubtitle').'",
								{idOpenSubtitle: $.fn.yiiGridView.getSelection("subtitle-grid"),
								 idNzb:"'.$modelNzb->Id.'"
								}
						).success(
							function(data) 
							{
	 							window.location = "'.NzbController::createUrl('view',array('id'=>$modelNzb->Id)).'";
							}
						);
		 
			 		}
			 		return false;
				}',
				'htmlOptions'=>array('style'=>'display: none;')
		 	)
		 );
	 ?>	
<?php $this->endWidget(); ?>
</div> <!-- form -->