<?php
$this->breadcrumbs=array(
	'Client Settings',
);

$this->menu=array(
	array('label'=>'Create ClientSettings', 'url'=>array('create')),
	array('label'=>'Manage ClientSettings', 'url'=>array('admin')),
);
?>

<h1>Client Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
