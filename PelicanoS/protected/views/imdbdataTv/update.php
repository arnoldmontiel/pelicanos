<?php
$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('index')),
	array('label'=>'Create Serie Tv', 'url'=>array('create')),
	array('label'=>'View Serie Tv', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Series Tv', 'url'=>array('admin')),
);
?>

<h1>Update Serie Tv</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>