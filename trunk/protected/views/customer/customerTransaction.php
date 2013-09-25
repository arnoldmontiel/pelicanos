<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />

<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Customer Series', 'url'=>array('customerSeries')),
	array('label'=>'Customer Movies', 'url'=>array('customerMovies')),
	array('label'=>'Customer Points', 'url'=>array('customerPoints')),
);

Yii::app()->clientScript->registerScript('customerMovies', "
$('#Customer_Id').change(function(){
	if($(this).val()!= ''){
		$.fn.yiiGridView.update('transaction-grid', {
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
<h1>Customers Transaction</h1>
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
		'id'=>'transaction-grid',
		'dataProvider'=>$modelRelation->searchTransaction(),
		'filter'=>$modelRelation,
		'summaryText'=>'',	
		'columns'=>array(	
				array(
	 				    'name'=>'date',
					    'value'=>'$data->date',	
						'htmlOptions' => array('style' => 'width: 150px;'),
				),
				array(
			 			'name'=>"Id_transaction_type",
			 			'type'=>'raw',
			 			'value'=>'$data->transactionType->description',
			 			'filter'=>CHtml::listData(array(
														array('id'=>'1','value'=>'Debit'),
														array('id'=>'2','value'=>'Credit')
														)
														,'id','value'
												),
						'htmlOptions' => array('style' => 'width: 50px;'),
				),
				array(
	 				    'name'=>'points',
					    'value'=>'$data->points',
					    'htmlOptions' => array('style' => 'width: 50px;'),
				),
				'description',
			),
		));		
		?>
	
	</div><!-- display-->
	
<?php $this->endWidget(); ?>

</div><!-- form -->
