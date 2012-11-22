<?php

$this->menu=array(
	array('label'=>'List OpenSubtitle', 'url'=>array('index')),
	array('label'=>'Create OpenSubtitle', 'url'=>array('create')),
	array('label'=>'View OpenSubtitle', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage OpenSubtitle', 'url'=>array('admin')),
);
?>

<h1>Update OpenSubtitle <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>