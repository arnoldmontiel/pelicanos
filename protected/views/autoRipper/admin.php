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
	'columns'=>array(
		'Id',
		'Id_disc',
		'Id_auto_ripper_state',
		'name',
		'password',
		'Id_nzb',
		'percentage',
		array(
				'name'=>"name",
				'htmlOptions' => array('style'=>'width:100px;'),
			 	'type'=>'raw',
			 	'value'=>'CHtml::button("Ver Estado",array("id"=>$data->Id, "class"=>"btn-admin-state"))',			 			
			),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
