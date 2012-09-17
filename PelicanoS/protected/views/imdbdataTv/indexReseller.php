<?php

$this->menu=array(
	array('label'=>'View Season', 'url'=>array('viewSeasonReseller')),
);
?>

<h1>Series Tvs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewReseller',
)); ?>
