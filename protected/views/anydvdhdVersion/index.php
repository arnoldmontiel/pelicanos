<?php
$this->breadcrumbs=array(
	'Anydvdhd Versions',
);

$this->menu=array(
	array('label'=>'Create AnydvdhdVersion', 'url'=>array('create')),
	array('label'=>'Manage AnydvdhdVersion', 'url'=>array('admin')),
);
?>

<h1>Anydvdhd Versions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
