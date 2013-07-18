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

<h1>Manage Auto Ripper States</h1>

<h3><?php echo 'DISC ID: '. $model->autoRipper->Id_disc;?></h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-ripper-states-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
		array(
		    'name'=>'auto_ripper_state_description',
		    'value'=>'$data->autoRipperState->description',		    
		),
		'change_date',
		'description',				
	),
)); ?>
