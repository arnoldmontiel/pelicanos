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

function saveAccount(id)
{
	var row = $("#sabnzbd-config-grid :input[idconfig='"+id+"']").serialize();
	$.post("<?php echo DeviceController::createUrl('AjaxUpdateSabnzbdAccount'); ?>",
			
			$("#sabnzbd-config-grid :input[idconfig='"+id+"']").serialize() + '&idAccount='+id,
				
			 function(data) {
  				$.fn.yiiGridView.update('sabnzbd-config-grid');  		
 });

	
}

function updateAccount(id)
{
	$("#edit_"+id).addClass('hidden');
	$("#save_"+id).removeClass('hidden');
	$("#cancel_"+id).removeClass('hidden');
		
	$("#sabnzbd-config-grid :input[idconfig='"+id+"']").each(function(){
    	$(this).removeAttr('disabled');
	});
}
function cancelEdit(id)
{
	$.fn.yiiGridView.update('sabnzbd-config-grid');
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

function checkTimeOut(obj)
{
	checkNumber(obj);
	var value=$(obj).val();
	if(value < 30)
		$(obj).val("30");
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
  <td colspan="13">Para agregar una cuenta complete los campos y presione <span class="bold">Agregar</span> (Tiempo out minimo 30)</td>
 </tr>
  <tr>
  <?php $newModel = new SabnzbdConfig();
  echo CHtml::activeHiddenField($newModel, 'Id_device');
  ?>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'server_name',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Servidor")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'username',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Usuario")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'password',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Clave")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'connections',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"0")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'port',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"0")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'timeout',array('onkeyup'=>'checkTimeOut(this);','class'=>'form-control inputSmall', 'placeholder'=>"30")); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'ssl',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'enable',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeCheckBox($newModel, 'optional',array('class'=>'form-control')); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'retention',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"0")); ?></td>
  <td width="210"><?php echo CHtml::activeTextField($newModel, 'fill_server',array('onkeyup'=>'checkNumber(this);','class'=>'form-control inputSmall', 'placeholder'=>"0")); ?></td>
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
		'emptyText' => 'No existe a&uacute;n ninguna cuenta configurada.',
  		'itemsCssClass' => 'table table-condensed tablaIndividual',
		//'ajaxUrl'=>DeviceController::createUrl('AjaxUpdateCommissionistGrid',array("Id"=>$modelBudget->Id,"version_number"=>$modelBudget->version_number)),
  		'columns'=>array(
  				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" class="form-control" name="server_name_'.$data->Id.'" id="server_name_'.$data->Id.'" disabled value="'.$data->server_name.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"210"),
  				),
  				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" class="form-control" name="username_'.$data->Id.'" id="username_'.$data->Id.'" disabled value="'.$data->username.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"210"),
  				),
				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" class="form-control" name="password_'.$data->Id.'" id="password_'.$data->Id.'" disabled value="'.$data->password.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("width"=>"210"),
				),
				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" onkeyup="checkNumber(this);" class="form-control inputSmall" name="connections_'.$data->Id.'" id="connections_'.$data->Id.'" disabled value="'.$data->connections.'">';
						},
						'type'=>'raw',
				),
				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" onkeyup="checkNumber(this);" class="form-control inputSmall" name="port_'.$data->Id.'" id="port_'.$data->Id.'" disabled value="'.$data->port.'">';
						},
						'type'=>'raw',
				),
				array(
						'value'=>function($data){
							return '<input type="text" onkeyup="checkTimeOut(this);" idconfig="'.$data->Id.'" class="form-control inputSmall" name="timeout_'.$data->Id.'" id="timeout_'.$data->Id.'" disabled value="'.$data->timeout.'">';
						},
						'type'=>'raw',
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->ssl == 1)
								$checked = 'checked';
  							return '<input idconfig="'.$data->Id.'" type="checkbox" '.$checked.' name="ssl_'.$data->Id.'" id="ssl_'.$data->Id.'" disabled >';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->enable == 1)
								$checked = 'checked';
							return '<input idconfig="'.$data->Id.'" type="checkbox" '.$checked.' name="enable_'.$data->Id.'" id="enable_'.$data->Id.'" disabled >';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>function($data){
							$checked = '';
							if($data->optional == 1)
								$checked = 'checked';
							return '<input idconfig="'.$data->Id.'" type="checkbox" '.$checked.' name="optional_'.$data->Id.'" id="optional_'.$data->Id.'" disabled >';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" onkeyup="checkNumber(this);" class="form-control inputSmall" name="retention_'.$data->Id.'" id="retention_'.$data->Id.'" disabled value="'.$data->retention.'">';
						},
						'type'=>'raw',
				),
				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" onkeyup="checkNumber(this);" class="form-control inputSmall" name="fill_server_'.$data->Id.'" id="fill_server_'.$data->Id.'" disabled value="'.$data->fill_server.'">';
						},
						'type'=>'raw',
				),
  				array(  						
  						'value'=>function($data){
  							return '<button id="edit_'.$data->Id.'" type="button" onclick="updateAccount('.$data->Id.');" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Editar</button>
  									<button id="save_'.$data->Id.'" type="button" onclick="saveAccount('.$data->Id.');" class="hidden btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Guardar</button>
  									<button id="cancel_'.$data->Id.'" type="button" onclick="cancelEdit('.$data->Id.');" class="hidden btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Cancelar</button>';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
  		),
  		),
  ));
  ?>
  </div>
  </div>