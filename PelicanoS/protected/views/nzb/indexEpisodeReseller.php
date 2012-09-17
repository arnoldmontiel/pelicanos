<?php

$this->menu=array(
	array('label'=>'List Movies', 'url'=>array('indexReseller')),
);
?>

<h1>Episodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewEpisodeReseller',
)); ?>
