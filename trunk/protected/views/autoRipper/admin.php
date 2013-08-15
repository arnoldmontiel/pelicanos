<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */
Yii::app()->clientScript->registerScript('admin-auto-ripper', "

$('.btn-admin-state').click(function(){
	var id = $(this).attr('id');
	window.location = '".AutoRipperController::createUrl('adminState')."' + '&id='+id;
	return false;
});
");


// $fileName1 = '520295e3e2848'; //13 valores alfanumericos generados por uniqid()

// // $fileName1 = '1111111111111'; //13 valores alfanumericos generados por uniqid()
// // $fileName1 = 'aaaaaaaaaaaaa'; //13 valores alfanumericos generados por uniqid()
// // $fileName1 = '0000000000000'; //13 valores alfanumericos generados por uniqid()
// echo CHtml::textField('txt15',generatePassword15($fileName1),array('size'=>100));
// echo '<br>';
// echo CHtml::textField('txt59',generatePassword59($fileName1),array('size'=>100));

// function generatePassword15($fileName)
// {
// 	$reverseName = strrev($fileName);
// 	$password = '';
// 	$i = 0;
// 	for($index = 0; $index < strlen($reverseName); $index++)
// 	{	
// 		$i++;
		
// 		$currChar = $reverseName[$index];
// 		$asciiValue	= ord($currChar);
		
// 		if ($index % 2 == 0)
// 		{						
// 			$sum = (int)(($asciiValue / 2) + $i * 2.4 + 6.4);
// 		}
// 		else
// 		{							
// 			$sum = (int)(($asciiValue / 2.8) + $i * 3.7 + 35.2);
// 		}

// 		if($index == 7)
// 		{
// 			if(((int)$asciiValue) < 120)
// 				$newVal = (int)$asciiValue + 3;
// 			else 
// 				$newVal = (int)$asciiValue - 2;
			
// 			$password .= chr($newVal);
// 		}
		
// 		if($index == 10)
// 		{
// 			if(((int)$asciiValue) < 110)
// 				$newVal = (int)$asciiValue + 4;
// 			else 
// 				$newVal = (int)$asciiValue - 7;
			
// 			$password .= chr($newVal);
// 		}
		
// 		$password .= chr($sum);
// 	}
	
// 	$password = str_replace('"','~',$password);
// 	$password = str_replace("\\",'*',$password);
// 	return $password;
// }

// function generatePassword59($fileName)
// {
// 	$reverseName = strrev($fileName);
// 	$password = '';
// 	$i = 0;
// 	for($index = 0; $index < strlen($reverseName); $index++)
// 	{
// 		$i++;

// 		$currChar = $reverseName[$index];
// 		$asciiValue	= ord($currChar);

// 		for($j = 0; $j < 4; $j++)
// 		{
// 			if ($index % 2 == 0)
// 			{				
// 				$sum = (int)((int)((3.5+$asciiValue / 1.65)) + (14-$i) * ($j+1) * 0.97);				
// 			}
// 			else
// 			{				
// 				$sum = (int)((int)((2.4+$asciiValue / 2.65)) + (16-$i) * ($j+1) * 0.87 + 11);
		
// 			}		
						
// 			$password .= chr($sum);
// 		}
		
// 		if($index == 3)
// 			$password .= extraValue(4, $asciiValue);
		
// 		if($index == 11)
// 			$password .= extraValue(3, $asciiValue);
				
// 	}
// 	$password = str_replace('"','~',$password);
// 	$password = str_replace("\\",'*',$password);
	
// 	return $password;
// }

// function extraValue($qty, $asciiValue)
// {
// 	$newString = '';
// 	for($j = 0; $j < $qty; $j++)
// 	{
// 		if($j == 2)
// 			if(((int)$asciiValue) < 110)
// 				$newValue = (int)$asciiValue + $j +8 + $qty;
// 			else 
// 				$newValue = (int)$asciiValue + $j -9;
// 		else
// 			$newValue = (int)$asciiValue + $j +1;
		
// 		$newString .= chr($newValue); 
// 	}
	
// 	return $newString;
// }

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-ripper-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>'js:function(){
				$("#auto-ripper-grid").find(".btn-admin-state").each(
						function(index, item){
							$(item).click(function(){
								var id = $(this).attr("id");
								window.location = "'.AutoRipperController::createUrl('adminState').'" + "&id="+id;
								return false;								
															
							});
						});

		}',
	'columns'=>array(		
		'Id_disc',
		array(
		    'name'=>'auto_ripper_state_description',
		    'value'=>'(isset($data->autoRipperState))?$data->autoRipperState->description:""',		    
		),
		'name',
		'password',
		'Id_nzb',
		'percentage',
		array(				
				'htmlOptions' => array('style'=>'width:100px;'),
			 	'type'=>'raw',
			 	'value'=>'CHtml::button("Ver Estado",array("id"=>$data->Id, "class"=>"btn-admin-state"))',			 			
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
		),
	),
)); ?>
