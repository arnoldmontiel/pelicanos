<?php

$this->menu=array(
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
	array('label'=>'Customer Movies', 'url'=>array('customerMovies')),
	array('label'=>'Customer Series', 'url'=>array('customerSeries')),
	array('label'=>'Customer Points', 'url'=>array('customerPoints')),
	array('label'=>'Customer Transactions', 'url'=>array('customerTransaction')),
);
?>

<h1>Customers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
