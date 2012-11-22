<?php

$this->menu=array(
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
	array('label'=>'Manage Box', 'url'=>array('adminBox')),
);
?>

<h1>Movies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
