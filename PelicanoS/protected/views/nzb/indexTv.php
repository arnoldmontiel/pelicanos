<?php

$this->menu=array(
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Manage Nzb', 'url'=>array('adminTv')),
	array('label'=>'Manage Box', 'url'=>array('adminBox')),
	array('label'=>'Manage Serie', 'url'=>array('adminSerie')),
	array('label'=>'Manage Season', 'url'=>array('adminSeason')),
	array('label'=>'Manage Episode', 'url'=>array('adminEpisode')),
);
?>

<h1>Tv series</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewTv',
)); ?>
