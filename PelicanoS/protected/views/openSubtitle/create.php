<?php
$this->breadcrumbs=array(
	'Open Subtitles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OpenSubtitle', 'url'=>array('index')),
	array('label'=>'Manage OpenSubtitle', 'url'=>array('admin')),
);
?>

<h1>Create OpenSubtitle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>