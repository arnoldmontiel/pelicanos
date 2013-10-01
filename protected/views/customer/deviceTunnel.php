<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'device-tunneling-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($modelDeviceTunnel,'external_port'); ?>
	    <?php echo $form->textField($modelDeviceTunnel,'external_port'); ?>
		<?php echo $form->labelEx($modelDeviceTunnel,'Id_port'); ?>
		<?php echo $form->dropDownList($modelDeviceTunnel, 'Id_port', $ddlPort);?>
		<?php echo CHtml::submitButton($modelDeviceTunnel->isNewRecord ? 'Create' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'device-grid',
	'dataProvider'=>$modelDeviceTunelGrid->search(),
	'filter'=>$modelDeviceTunelGrid,
	'summaryText'=>'',
	
	'columns'=>array(
		array(
 			'name'=>'interal_port',
			'value'=>'$data->port->description',
		),
		'external_port',
		array(
 			'name'=>"is_open",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("is_open",$data->is_open,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
				)
			,'id','value'
			),
		),
		array(
 			'name'=>"is_validated",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("is_validated",$data->is_validated,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
				)
			,'id','value'
			),
		),		
		array(
			'class'=>'CButtonColumn',
			//'template'=>'($data->is_open == 1)?{a}:{b}',
			'template'=>'{close}{open}',
			'buttons'=>array(
					'close' => array(
							'url'=>'Yii::app()->createUrl("customer/AjaxCloseDeviceTunnel", array("idDevice"=>$data->Id_device,"idPort"=>$data->Id_port))',
							'visible'=>'($data->is_open == 1)?true:false'
							),
					'open' => array(
							'url'=>'Yii::app()->createUrl("customer/AjaxOpenDeviceTunnel", array("idDevice"=>$data->Id_device,"idPort"=>$data->Id_port))',
							'visible'=>'($data->is_open == 0)?true:false'
							),
			),
		),
	),
)); ?>
