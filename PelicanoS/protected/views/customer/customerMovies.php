<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />

<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Customer Series', 'url'=>array('customerSeries')),
	array('label'=>'Customer Points', 'url'=>array('customerPoints')),
	array('label'=>'Customer Transaction', 'url'=>array('customerTransaction')),
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
<h1>Customers Movies</h1>
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
		'dataProvider'=>$modelRelation->searchRelationMovies(),
		'filter'=>$modelRelation,
		'summaryText'=>'',	
		'columns'=>array(	
				array(
	 				    'name'=>'id_imdb',
					    'value'=>'$data->nzb->imdbData->ID',
	
				),
				array(
	 				    'name'=>'title',
					    'value'=>'$data->nzb->imdbData->Title',
	
				),
				array(
	 				    'name'=>'year',
					    'value'=>'$data->nzb->imdbData->Year',
	
				),
				array(
	 				    'name'=>'genre',
					    'value'=>'$data->nzb->imdbData->Genre',
	
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
