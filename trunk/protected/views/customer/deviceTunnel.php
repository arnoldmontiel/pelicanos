<div class="container" id="screenInicio">
	<h1 class="pageTitle">Administrar Puertos</h1>
	<div class="row">
	    <div class="col-sm-12">
	   <form class="form-inline formAddPort" role="form">
  <div class="form-group">
    <label  for="internalPortID">Internal Port</label>
    <input type="email" class="form-control" id="internalPortID" placeholder="nnnn">
  </div>
  <div class="form-group">
    <label for="externalPortID">Puertos Disponibles</label>
<select class="form-control" id="externalPortID">
  <option>HTTP</option>
  <option>SSH</option>
  <option>MySQL</option>
</select>  </div>
  <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Agregar</button>
</form>
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Puerto Interno</th>
<th>Puerto Externo</th>
<th>Estado</th>
<th>Validaci&oacute;n</th>
<th class="align-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td>SSH</td>
<td>5555</td>
<td><span class="label label-success">Abierto</span></td>
<td>Esperando...</td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-circle fa-fw"></i> Cerrar</button></td>
</tr>
<tr>
<td>HTTP</td>
<td>5556</td>
<td><span class="label label-success">Abierto</span></td>
<td><span class="label label-primary">Validado</span></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-circle fa-fw"></i> Cerrar</button></td>
</tr>
<tr>
<td>MySQL</td>
<td>5557</td>
<td><span class="label label-danger">Cerrado</span></td>
<td>Esperando...</td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-circle-o fa-fw"></i> Abrir</button></td>
</tr>
</tbody>
</table>
	    
<div class="estoesloviejo" style="margin-top:120px;">
ACA EMPIEZA LO VIEJO
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

</div>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'device-grid',
	'dataProvider'=>$modelDeviceTunelGrid->search(),
	'filter'=>$modelDeviceTunelGrid,
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
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

	   </div><!-- /.col-sm-12 --> 
	</div><!-- /.row --> 
</div><!-- /container --> 
