<?php
$this->breadcrumbs=array(
	'Anydvdhd Versions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AnydvdhdVersion', 'url'=>array('index')),
	array('label'=>'Manage AnydvdhdVersion', 'url'=>array('admin')),
);
?>

<h1>Create AnydvdhdVersion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>