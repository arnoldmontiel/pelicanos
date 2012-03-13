<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />

<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Customer Movies', 'url'=>array('customerMovies')),
);

Yii::app()->clientScript->registerScript('customerMovies', "
$('#Customer_Id').change(function(){
	if($(this).val()!= ''){
		$.fn.yiiGridView.update('relation-grid', {
			data: $(this).serialize()
		});
		$('#display').animate({opacity: 'show'},240);
	}
	else{
		$('#display').animate({opacity: 'hide'},240);	
	}
	return false;
});

");
?>

<h1>Customers Series</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'customerMovies-form',
		'enableAjaxValidation'=>true,
));
		
		?>
	
	<div id="customer" style="margin-bottom: 5px">
		
		<?php	$customers = CHtml::listData($ddlSource, 'Id', 'CustomerDesc');?>

		<?php echo $form->labelEx($model,'Customer'); ?>

		<?php echo $form->dropDownList($model, 'Id', $customers,		
			array(
				'prompt'=>'Select a Customer'
			)		
		);
		
		
		
		?>
		
	</div>
	<div id="display"
	style="display: none">
	<?php		
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'relation-grid',
		'dataProvider'=>$modelRelation->searchRelationSeries(),
		'filter'=>$modelRelation,
		'summaryText'=>'',	
		'columns'=>array(	
				array(
	 				    'name'=>'id_imdb',
					    'value'=>'$data->nzb->imdbDataTv->ID',
	
				),
				array(
	 				    'name'=>'title',
					    'value'=>'$data->nzb->imdbDataTv->Title',
	
				),
				array(
	 				    'name'=>'year',
					    'value'=>'$data->nzb->imdbDataTv->Year',
	
				),
				array(
	 				    'name'=>'genre',
					    'value'=>'$data->nzb->imdbDataTv->Genre',
	
				),
				array(
	 				    'name'=>'serie_title',
					    'value'=>'$data->nzb->imdbDataTv->idParent->Title',
	
				),	
				array(
	 				    'name'=>'season',
					    'value'=>'$data->nzb->imdbDataTv->Season',
	
				),
				array(
	 				    'name'=>'episode',
					    'value'=>'$data->nzb->imdbDataTv->Episode',
	
				),
				array(
	 				    'name'=>'movie_status',
					    'value'=>'$data->movieState->description',
	
				),
				date_sent,
				date_downloading,
				date_downloaded
			),
		));		
		?>
	
	</div><!-- display-->
	
<?php $this->endWidget(); ?>

</div><!-- form -->
