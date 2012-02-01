<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Customer Movies',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
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
		'dataProvider'=>$modelRelation->searchRelation(),
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
			),
		));		
		?>
	
	</div><!-- display-->
	
<?php $this->endWidget(); ?>

</div><!-- form -->
