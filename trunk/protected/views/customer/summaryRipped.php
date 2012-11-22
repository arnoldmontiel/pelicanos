<?php

$this->menu=array(
	array('label'=>'Summary', 'url'=>array('summary')),
);
?>

<h1>Ripped</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewSummaryRipped',
)); ?>
