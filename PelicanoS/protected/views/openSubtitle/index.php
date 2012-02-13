<?php
$this->breadcrumbs=array(
	'Open Subtitles',
);

$this->menu=array(
	array('label'=>'Create OpenSubtitle', 'url'=>array('create')),
	array('label'=>'Manage OpenSubtitle', 'url'=>array('admin')),
);
?>

<h1>Open Subtitles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
