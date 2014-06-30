<script type="text/javascript">
function addNewPlayer()
{	
	  $.post( 
			  "<?php echo DeviceController::createUrl('AjaxAddNewPlayer'); ?>",
	             $("#form-new-player").serialize(),
		             function(data) {
				  		$.fn.yiiGridView.update('player-config-grid');
				  		$.fn.yiiGridView.update('customer-device-grid');
				  		$("#DevicePlayer_description").val('');
				  		$("#DevicePlayer_url").val('');
				  		$('#btn-add-player').addClass("disabled");
	             }
	          );
	
}

function savePlayer(id)
{
	var row = $("#player-config-grid :input[idconfig='"+id+"']").serialize();
	$.post("<?php echo DeviceController::createUrl('AjaxUpdatePlayerConfig'); ?>",
			
			$("#player-config-grid :input[idconfig='"+id+"']").serialize() + '&idPlayer='+id,
				
			 function(data) {
  				$.fn.yiiGridView.update('player-config-grid');
  				$.fn.yiiGridView.update('customer-device-grid');  		
 });

	
}
function removePlayer(idPlayer)
{		
	if(confirm("¿Seguro desea eliminar el player?"))
	{
		
		$.post("<?php echo DeviceController::createUrl('AjaxRemovePlayer'); ?>",
			{
			idPlayer:idPlayer
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('player-config-grid');
  				$.fn.yiiGridView.update('customer-device-grid');
			});
		return false;
	}
}

function updatePlayer(id)
{
	$("#edit_"+id).addClass('hidden');
	$("#remove_"+id).addClass('hidden');
	$("#save_"+id).removeClass('hidden');
	$("#cancel_"+id).removeClass('hidden');
		
	$(".mainEdit").addClass('disabled');
	$("#player-config-grid :input[idconfig='"+id+"']").each(function(){
    	$(this).removeAttr('disabled');
	});
}
function cancelEdit(id)
{
	$.fn.yiiGridView.update('player-config-grid');
}
function checkAddEnabled()
{
	var description = $("#DevicePlayer_description").val();
	var url = $("#DevicePlayer_url").val();
	
	if(description != "" && url != "")
		$('#btn-add-player').removeClass("disabled");
	else
		$('#btn-add-player').addClass("disabled");		
}

</script>

<div class="row">
  <form action="" id="form-new-player">
  <div class="col-sm-12">
  <table class="table table-condensed tablaIndividual">
  <thead>
  <tr>
  <th>Nombre</th>
  <th>Url</th>
  <th>Tipo</th>  
  <th class="align-right">Acciones</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td colspan="13">Para agregar un player complete los campos y presione <span class="bold">Agregar</span></td>
 </tr>
  <tr>
  <?php $newModel = new DevicePlayer();
  echo CHtml::activeHiddenField($newModel, 'Id_device');
  
  $typeList = CHtml::listData(  array(
  										array('id'=>'0','value'=>'Dune'),
  										array('id'=>'1','value'=>'Oppo')
  									)
  								,'id','value');
  $fileProtocolList = CHtml::listData(  array(
										array('id'=>'smb','value'=>'Smb'),
										array('id'=>'nfs','value'=>'Nfs')
									)
								,'id','value');
  ?>
  <td style="width:20%;"><?php echo CHtml::activeTextField($newModel, 'description',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Description")); ?></td>
  <td style="width:20%;"><?php echo CHtml::activeTextField($newModel, 'url',array('onkeyup'=>'checkAddEnabled()','class'=>'form-control', 'placeholder'=>"Url")); ?></td>
  <td style="width:20%;"><?php echo CHtml::activeDropDownList($newModel, 'type', $typeList, array('class'=>'form-control')); ?></td>  
  <td style="width:20%;"><?php echo CHtml::activeDropDownList($newModel, 'file_protocol', $fileProtocolList, array('class'=>'form-control')); ?></td>
  <td class="align-right"><button id="btn-add-player" type="button" onclick="addNewPlayer();" class="btn btn-primary btn-sm noMargin disabled"><i class="fa fa-plus"></i> Agregar</button></td>
  </tr>
  </tbody>
  </table>
  </div>
  </form>
  <div class="col-sm-12">
  <?php
  $this->widget('zii.widgets.grid.CGridView', array(
  		'id'=>'player-config-grid',
  		'dataProvider'=>$modelPlayerConfigs->search(),
  		'selectableRows' => 0,
  		'summaryText'=>'',
		'hideHeader'=>true,
		'emptyText' => 'No existe a&uacute;n ning&uacute;n player.',
  		'itemsCssClass' => 'table table-condensed tablaIndividual',
		//'ajaxUrl'=>DeviceController::createUrl('AjaxUpdateCommissionistGrid',array("Id"=>$modelBudget->Id,"version_number"=>$modelBudget->version_number)),
  		'columns'=>array(
  				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" class="form-control" name="description_'.$data->Id.'" id="description_'.$data->Id.'" disabled value="'.$data->description.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"width:20%"),
  				),
  				array(
						'value'=>function($data){
							return '<input type="text" idconfig="'.$data->Id.'" class="form-control" name="url_'.$data->Id.'" id="url_'.$data->Id.'" disabled value="'.$data->url.'">';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"width:20%"),
  				),
  				array(

					'value'=>function($data){
							$typeList = CHtml::listData(  array(
									array('id'=>'0','value'=>'Dune'),
									array('id'=>'1','value'=>'Oppo')
							)
									,'id','value');
							$value = CHtml::activeDropDownList($data, 'type', $typeList, array('class'=>'form-control', 'idconfig'=>$data->Id, 'disabled'=>'disabled', 'name'=>'type_'.$data->Id));
						return $value;
					},
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"width:20%"),
  				),
  				array(
  				
  						'value'=>function($data){
  							$fileProtocolList = CHtml::listData(  array(
  									array('id'=>'smb','value'=>'Smb'),
  									array('id'=>'nfs','value'=>'Nfs')
  							)
  									,'id','value');
  							$value = CHtml::activeDropDownList($data, 'file_protocol', $fileProtocolList, array('class'=>'form-control', 'idconfig'=>$data->Id, 'disabled'=>'disabled', 'name'=>'file_protocol_'.$data->Id));
  							return $value;
  						},
  						'type'=>'raw',
  						'htmlOptions'=>array("style"=>"width:20%"),
  				),
  				array(  						
						'value'=>function($data){
  							return '<button id="edit_'.$data->Id.'" type="button" onclick="updatePlayer('.$data->Id.');" class="btn btn-default btn-sm btn50 noMargin mainEdit"><i class="fa fa-pencil"></i> Editar</button>
									<button id="remove_'.$data->Id.'" type="button" onclick="removePlayer('.$data->Id.');" class="btn btn-default btn-sm btn50 noMargin mainEdit"><i class="fa fa-trash-o"></i> Borrar</button>
  									<button id="save_'.$data->Id.'" type="button" onclick="savePlayer('.$data->Id.');" class="hidden btn btn-default btn-sm btn50 noMargin pull-left"><i class="fa fa-save"></i></button>
  									<button id="cancel_'.$data->Id.'" type="button" onclick="cancelEdit('.$data->Id.');" class="hidden btn btn-default btn-sm btn50 noMargin pull-right"><i class="fa fa-times-circle"></i></button>';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
  		),
  		),
  ));
  ?>
  </div>
  </div>