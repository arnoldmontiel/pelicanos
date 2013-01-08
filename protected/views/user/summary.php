<h1>Summary Users</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-summary-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
				'name'=>'reseller_desc',
				'value'=>'isset($data->reseller)?$data->reseller->description:""',
		),
		'username',
		'password',
		'email',
		array(
				'class'=>'CButtonColumn',
				'template'=>'{update}',
				'buttons'=>array(
						'update' => array(
								'url'=>'Yii::app()->createUrl("user/summaryUpdate", array("id"=>$data->username))',
						),
				),
		),
	),
)); ?>
