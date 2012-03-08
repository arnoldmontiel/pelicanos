<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
);
?>

<h1>Nzbs Episodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewEpisode',
)); ?>
