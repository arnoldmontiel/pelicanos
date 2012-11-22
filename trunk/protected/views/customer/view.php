<?php

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
	array('label'=>'Ripped', 'url'=>array('indexRipped', 'id'=>$model->Id)),
);
?>

<h1>View Customer</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'last_name',
		'address',
	),
)); 

?>

<br>
<div class="customer-assign-title">
		Device
	<div class="customer-button-box">
		<?php 
		echo CHtml::button('Nuevo Device', array(
				'onclick'=>'jQuery("#CreateDevice").dialog("open"); return false;',
		));

		?>
	</div>
</div>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'device-grid',
	'dataProvider'=>$modelCustDev->search(),
	'filter'=>$modelCustDev,
	'summaryText'=>'',
	'columns'=>array(
		'Id_device',
		array(
 			'name'=>'device_description',
			'value'=>'$data->device->description',
		),
		array(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array(
						'delete' => array(
								'url'=>'Yii::app()->createUrl("customer/AjaxRemoveCustomerDevice", array("idDevice"=>$data->Id_device,"idCustomer"=>$data->Id_customer))',
						),
				),
		),
	),
)); ?>
<br>
<div class="customer-assign-title">
		Usuarios
		<div class="customer-button-box">
			<?php 
			echo CHtml::button('Nuevo Usuario', array('class'=>'customer-new-user',
					'onclick'=>'jQuery("#CreateUser").dialog("open"); return false;',
			));

			?>
		</div>
</div>
	<?php 
	$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('save'),
			'idDialog'=>'wating',
	));
	
	//new user
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateUser',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Crear Usuario',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateUser").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("customerUsers/AjaxCreate").'", $("#customer-users-form").serialize(),
							function(data) {
								if(data!=null && data!="")
								{
									$.fn.yiiGridView.update("customer-users-grid", {
										data: $(this).serialize()
									});
									jQuery("#CreateUser").dialog( "close" );
								}
								jQuery("#wating").dialog("close");
							}
					);

				}'),
			),
	));
	$modelCustomerUsers = new CustomerUsers();
	$modelCustomerUsers->Id_customer = $model->Id;
	
	echo $this->renderPartial('../customerUsers/_formPopUp', array('model'=>$modelCustomerUsers));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
	//new device
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'CreateDevice',
	// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Crear Device',
						'autoOpen'=>false,
						'modal'=>true,
						'width'=> '500',
						'buttons'=>	array(
								'Cancelar'=>'js:function(){jQuery("#CreateDevice").dialog( "close" );
									$("#Device_description").val(null);	
								}',
								'Grabar'=>'js:function()
								{
								jQuery("#wating").dialog("open");
								jQuery.post("'.Yii::app()->createUrl("customer/AjaxSaveDevice").'", $("#device-form").serialize(),
								function(data) {
									$.fn.yiiGridView.update("device-grid", {
										data: $(this).serialize()
									});
									jQuery("#CreateDevice").dialog( "close" );
									jQuery("#wating").dialog("close");
									$("#Device_description").val(null);
								}
						);
	
					}'),
	),
	));
	$modelDevice = new Device();
	
	echo $this->renderPartial('_formDevice', array('model'=>$modelDevice, 'idCustomer'=>$model->Id));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-users-grid',
	'dataProvider'=>$modelCustUsr->search(),
	'filter'=>$modelCustUsr,
	'summaryText'=>'',
	'columns'=>array(
		'username',
		'password',
		array(
 			'name'=>"adult_section",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("adult_section",$data->adult_section,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
					)
					,'id','value'
			),
		),
		array(
 			'name'=>"deleted",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("deleted",$data->deleted,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
					)
					,'id','value'
			),
		),
		'birth_date',
		'email',
		array(
				'class'=>'CButtonColumn',
				'template'=>'{update}',
				'buttons'=>array(
						'delete' => array(
								'url'=>'Yii::app()->createUrl("customerUsers/AjaxRemoveUserCustomer", array("id"=>$data->username))',
						),
						'update' => array(
								'url'=>'Yii::app()->createUrl("customerUsers/AjaxUpdateUserCustomer", array("username"=>$data->username, "idCustomer"=>$data->Id_customer))',
						),
				),
		),
	),
)); ?>