<?php
$this->breadcrumbs=array(
	'Customer Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerUsers', 'url'=>array('index')),
	array('label'=>'Manage CustomerUsers', 'url'=>array('admin')),
);
?>

<h1>Create CustomerUsers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>