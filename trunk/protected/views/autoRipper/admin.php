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
		    'value'=>'$data->autoRipperState->description',		    
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
