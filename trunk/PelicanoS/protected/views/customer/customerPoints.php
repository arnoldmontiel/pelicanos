<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />

<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Customer Series', 'url'=>array('customerSeries')),
	array('label'=>'Customer Movies', 'url'=>array('customerMovies')),
	array('label'=>'Customer Transaction', 'url'=>array('customerTransaction')),
);

Yii::app()->clientScript->registerScript('customerMovies', "
$('#Customer_Id').change(function(){
	if($(this).val()!= ''){
		$.post('".CustomerController::createUrl('AjaxGetCurrentPoints')."',
					{idCustomer: $(this).val()
					} 
				).success(
					function(data) 
					{
						$('#currentPoints').text(data);
						$('#pointsDesc').val('Carga manual de credito');
						$('#pointsQty').val(null);
						$('#rbnTransType_0').attr('checked','checked');
					}
				);
		$('#display').animate({opacity: 'show'},240);
	}
	else{
		$('#display').animate({opacity: 'hide'},240);	
	}
	return false;
});
$('#pointsQty').keyup(function(){
	validateNumber($(this));
});
$('input:radio').change(function(){
	if($(this).val() == 1){ //Debit
		//$('#doTransaction').attr('src','images/deposit_out.png');
		$('#pointsDesc').val('Extraccion manual de credito');
	}	
	else{ //Credit
		//$('#doTransaction').attr('src','images/deposit_in.png');
		$('#pointsDesc').val('Carga manual de credito');
	}
})
");
?>
<h1>Customers Points</h1>
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
			echo CHtml::radioButtonList('rbnTransType','', array('2'=>'Credit', '1'=>'Debit'), array(
																									'labelOptions'=>array('style'=>'display:inline'),
                																					'separator'=>' '
                																					));
        ?>
    
    <div class="row">
    	<?php echo CHtml::label('Description', 'pointsDesc'); ?>
		<?php echo CHtml::textArea('pointsDesc','Carga manual de credito',array('id'=>'pointsDesc','maxlength'=>100));?>
    </div>
    <div class="row">
    	<div style="display: inline-block;">
	    	<?php echo CHtml::label('Points', 'pointsQty'); ?>
			<?php echo CHtml::textField('pointsQty','',array('id'=>'pointsQty','size'=>5));?>
		</div>
		<div style="display: inline-block;">
			Current Points: <span id="currentPoints"></span>
		</div>
    </div>    
	<div class="row" id="generate">
		
		<div style="display: inline-block;widht:100px;">
					<?php
						echo CHtml::imageButton(
			                                'images/deposit.png',
			                                array(
			                                'title'=>'Do transaction',
			                                'width'=>'100px',
			                                'id'=>'doTransaction',
			                                	'ajax'=> array(
													'type'=>'POST',
													'url'=>CustomerController::createUrl('AjaxDoTransaction'),
													'beforeSend'=>'function(){
																if(!$("#pointsQty").val()){
																	alert("Points can not be empty");
																	return false;
																}
																if(Number($("#pointsQty").val()) > Number($("#currentPoints").text()) && $("input[name=rbnTransType]:checked").val() == 1){
																	alert("You can not debit more than current points");
																	return false;
																}
																if(!confirm("Are you sure?")) 
																	return false;
																	}',
													'success'=>'js:function(data)
													{
														$("#currentPoints").text(data);
													}'
			                                	)
			                                )
			                                                         
			                            ); 
					?>
		</div>
	</div>
	
	</div><!-- display-->
	
<?php $this->endWidget(); ?>

</div><!-- form -->
