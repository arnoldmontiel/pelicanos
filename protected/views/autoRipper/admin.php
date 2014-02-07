<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */
Yii::app()->clientScript->registerScript('admin-auto-ripper', "

$('.btn-admin-state').click(function(){
	var id = $(this).attr('id');
	window.location = '".AutoRipperController::createUrl('adminState')."' + '&id='+id;
	return false;
});

$('.update').click(function(){
	$('#wating').dialog('open');
});
");

?>

<?php
$this->widget('ext.processingDialog.processingDialog', array(
					'buttons'=>array('none'),
					'idDialog'=>'wating',
));
 
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-ripper-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>'js:function(){
				$("#auto-ripper-grid").find(".update").each(
						function(index, item){
							$(item).click(function(){
								$("#wating").dialog("open");								
															
							});
						});
				
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
