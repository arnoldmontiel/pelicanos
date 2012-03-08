<?php

$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('index')),
	array('label'=>'Manage Series Tv', 'url'=>array('admin')),
);
?>

<h1>Create Serie Tv</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelSeason'=>$modelSeason)); ?>