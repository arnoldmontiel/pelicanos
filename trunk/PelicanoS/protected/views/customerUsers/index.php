<?php
$this->breadcrumbs=array(
	'Customer Users',
);

$this->menu=array(
	array('label'=>'Create CustomerUsers', 'url'=>array('create')),
	array('label'=>'Manage CustomerUsers', 'url'=>array('admin')),
);
?>

<h1>Customer Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
