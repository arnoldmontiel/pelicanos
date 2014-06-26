<script type="text/javascript">
function addSabnzbdAccount()
{	

	  $.post( 
			  "<?php echo DeviceController::createUrl('AjaxAddSabnzbdAccount'); ?>",
	             $("#form-new-sabnzbd-account").serialize(),
		             function(data) {
				  		$.fn.yiiGridView.update('sabnzbd-config-grid');
				  		$("#SabnzbdConfig_server_name").val('');
				  		$("#SabnzbdConfig_username").val('');
				  		$("#SabnzbdConfig_password").val('');
				  		$("#SabnzbdConfig_connections").val('');
				  		$("#SabnzbdConfig_port").val('');
				  		$("#SabnzbdConfig_timeout").val('');
				  		$("#SabnzbdConfig_retention").val('');
				  		$("#SabnzbdConfig_fill_server").val('');

				  		$("#SabnzbdConfig_ssl").removeAttr('checked');
				  		$("#SabnzbdConfig_enable").removeAttr('checked');
				  		$("#SabnzbdConfig_optional").removeAttr('checked');
				  		$('#btn-add-account').addClass("disabled");
	             }
	          );
	
}
function removeAccount(idAccount)
{		
	if(confirm("¿Seguro desea eliminar la cuenta?"))
	{
		
		$.post("<?php echo DeviceController::createUrl('AjaxRemoveSabnzbdAccount'); ?>",
			{
				idAccount:idAccount
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('sabnzbd-config-grid');
			});
		return false;
	}
}

function checkAddEnabled()
{
	var server = $("#SabnzbdConfig_server_name").val();
	var username = $("#SabnzbdConfig_username").val();
	var password = $("#SabnzbdConfig_password").val();
	var port = $("#SabnzbdConfig_port").val();
	
	if(server != "" && username != "" && password != "" && port > 0)
		$('#btn-add-account').removeClass("disabled");
	else
		$('#btn-add-account').addClass("disabled");		
}

function checkNumber(obj)
{
	var value=$(obj).val();
	if(value=="")
	{
    	$(obj).val("0");
	}
    var orignalValue=value;
    value=value.replace(/[0-9]*/g, "");			
   	var msg="Only Decimal Values allowed."; 						
   	value=value.replace(/\./, "");
    if (value!=""){
    	orignalValue=orignalValue.replace(value, "");
    	$(obj).val(orignalValue);
    	//alert(msg);
    }
    checkAddEnabled();
}
</script>

<div class="row">
  <form action="" id="form-new-sabnzbd-account">
  <div class="col-sm-12">
  <table class="table table-condensed tablaIndividual">
  <thead>
  <tr>
  <th>Servidor</th>
  <th>Usuario</th>
  <th>Clave</th>
  <th>Conexiones</th>
  <th>Puerto</th>
  <th>Tiempo out</th>
  <th>SSL</th>
  <th>Habilitado</th>
  <th>Opcional</th>
  <th>Retencion</th>
  <th>Fill Servidor</th>
  <th class="align-right">Acciones</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td colspan="13">Para agregar una cuenta complete los campos y presione <span class="bold">Agregar</span></td>
 </tr>
  <tr>
  <?php $newModel = new SabnzbdConfig();
  echo CHtml::activeHiddenField($newModel, 'Id_device');
  ?>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'server_name',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Servidor")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'username',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Usuario")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'password',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Clave")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'connections',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall')); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'port',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"Puerto")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'timeout',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"Tiempo out")); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'ssl',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'enable',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'optional',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'retention',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"Retencion")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'fill_server',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"Fill Servidor")); ?></td>
  <td class="align-right"><button id="btn-add-account" type="button" onclick="addSabnzbdAccount();" class="btn btn-primary btn-sm noMargin disabled"><i class="fa fa-plus"></i> Agregar</button></td>
  </tr>
  </tbody>
  </table>
  </div>
  </form>
  <div class="col-sm-12">
  <?php
  $this->widget('zii.widgets.grid.CGridView', array(
  		'id'=>'sabnzbd-config-grid',
  		'dataProvider'=>$modelSabNzbdConfigs->search(),
  		'selectableRows' => 0,
  		'summaryText'=>'',
		'hideHeader'=>true,
		'emptyText' => 'Este presupuesto a&uacute;n no tiene comisionistas.',
  		'itemsCssClass' => 'table table-condensed tablaIndividual',
		//'ajaxUrl'=>DeviceController::createUrl('AjaxUpdateCommissionistGrid',array("Id"=>$modelBudget->Id,"version_number"=>$modelBudget->version_number)),
  		'columns'=>array(
  				array(
  						'value'=>'$data->server_name',
						'htmlOptions'=>array("width"=>"210"),
  				),
  				array(
  						'value'=>'$data->username',
						'htmlOptions'=>array("width"=>"210"),
  				),
				array(
						'value'=>'$data->password',
						'htmlOptions'=>array("width"=>"210"),
				),
				array(
						'value'=>'$data->connections',
				),
				array(
						'value'=>'$data->port',
				),
				array(
						'value'=>'$data->timeout',
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->ssl == 1)
								$checked = 'checked';
  							return '<input type="checkbox" '.$checked.' disabled value="'.$data->ssl.'">';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->enable == 1)
								$checked = 'checked';
							return '<input type="checkbox" '.$checked.' disabled value="'.$data->enable.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->optional == 1)
								$checked = 'checked';
							return '<input type="checkbox" '.$checked.' disabled value="'.$data->optional.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>'$data->retention',
				),
				array(
						'value'=>'$data->fill_server',
				),
  				array(  						
  						'value'=>function($data){
  							return '<button type="button" onclick="removeAccount('.$data->Id.');" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button>';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
  		),
  		),
  ));
  ?>
  </div>
  </div>