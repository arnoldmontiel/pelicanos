<h1>Summary Customers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-summary-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
				'name'=>'reseller_desc',
				'value'=>'$data->reseller->description',
		),
		'name',
		'last_name',
		'address',
		array(
				'filter'=>false,
				'value'=>'CHtml::link("View Ripped",array("/customer/summaryRipped","id"=>$data->Id))',
				'type'=>'raw',
				'htmlOptions'=>array('width'=>'80px'),
		),
		array(
				'class'=>'CButtonColumn',
				'template'=>'',
		),
	),
)); ?>