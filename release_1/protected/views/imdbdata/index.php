<?php

$this->menu=array(
	array('label'=>'Create Imdbdata', 'url'=>array('create')),
	array('label'=>'Manage Imdbdata', 'url'=>array('admin')),
);
?>

<h1>Imdbdatas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
