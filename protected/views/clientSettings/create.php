<?php
$this->breadcrumbs=array(
	'Client Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientSettings', 'url'=>array('index')),
	array('label'=>'Manage ClientSettings', 'url'=>array('admin')),
);
?>

<h1>Create ClientSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>