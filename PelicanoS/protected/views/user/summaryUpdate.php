<?php

$this->menu=array(
	array('label'=>'Summary', 'url'=>array('summary')),
);
?>
<h1>Update User <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>