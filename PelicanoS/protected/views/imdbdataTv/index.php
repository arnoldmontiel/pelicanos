<?php

$this->menu=array(
	array('label'=>'Create Serie Tv', 'url'=>array('create')),
	array('label'=>'Manage Series Tv', 'url'=>array('admin')),
);
?>

<h1>Series Tvs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
