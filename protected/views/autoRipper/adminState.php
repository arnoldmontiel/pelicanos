<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */

Yii::app()->clientScript->registerScript('admin-auto-ripper-state', "

setInterval(function() {
   $.fn.yiiGridView.update('auto-ripper-states-grid');
}, 1000*90)

");

$this->menu=array(	
	array('label'=>'Manage AutoRipper', 'url'=>array('admin')),
);

?>

<h1>Manage Auto Rippers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-ripper-states-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id_auto_ripper',
		'Id_auto_ripper_state',
		'change_date',
		'description',				
	),
)); ?>
