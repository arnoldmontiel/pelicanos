<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Customer Movies', 'url'=>array('customerMovies')),
);

?>

<h1>Manage Customers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'name',
		'last_name',
		'address',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
