<?php

$this->menu=array(
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->Id)),
);
?>

<h1>Ripped</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewRipped',
)); ?>
