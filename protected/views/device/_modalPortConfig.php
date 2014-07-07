<?php $isAdmin = User::isAdmin();?>
<div class="modal-dialog myModalConfigPuertos">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          	<h4 class="modal-title">Configurar </h4>
		</div>
        <div class="modal-body">
        
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabPuertos" data-toggle="tab">Puertos</a></li>
				<li><a  href="#tabGeneral" data-toggle="tab">General</a></li>
				<?php if($isAdmin):?>
				<li><a  href="#tabSabnzbd" data-toggle="tab">Sabnzbd</a></li>
				<?php endif;?>
				<li><a  href="#tabPlayer" data-toggle="tab">Player</a></li>				
				<li class="pull-right"><div class="panel panel-default panelCliente sideIDLabel">
  <div class="panel-body">
   <div class="infoPanelCliente">
   <div class="bold"><span id="device-desc"></span> (ID: <span id="device-id"></span>)</div>
  </div></div>
</div> </li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabPuertos">
			  <div class="inlineForm">
         	<form class="form-inline formAddPort" role="form">
         		<?php echo CHtml::hiddenField('Id_device', ''); ?>
  				<div class="form-group">
    				<label for="externalPort">Puertos Externos</label>
    				<input onkeyup="validateNumber(this);" type="text" class="form-control" id="externalPort" placeholder="nnnn">
  				</div>
  				<div class="form-group">
    				<label for="internalPort">Puertos Disponibles</label>		
					<?php echo CHtml::dropDownList('internalPort', '', array(), array('Id'=>'internalPort'));?>  
				</div>
				
  				<button id="btn-add-port" onclick="addPort();" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar</button>
			
				<div id="status-error" style="display:none;"  class="estadoModal">
      				<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
      					<span id="errorMsg">El puerto externo no puede estar vacio.</span>
 					</div>
				</div>
			
			</form>
			</div>	
			<div id="product-grid-add" class="grid-view">
			<?php 
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'device-tunel-grid',
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
								'value'=>function($data){
									$value = "<span class='label label-success'>Abierto</span>"; 
									if($data->is_open == 0)
										$value = "<span class='label label-danger'>Cerrado</span>";
									
									return $value;
								},
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
								'headerHtmlOptions'=>array("style"=>"text-align:right;"),
								'filter'=>CHtml::listData(
										array(
												array('id'=>'0','value'=>'Cerrado'),
												array('id'=>'1','value'=>'Abierto')
										)
										,'id','value'
								),
						),
						array(
								'header'=>"Validacion",
								'value'=>function($data){
									$value = "<span class='label label-primary'>Validado</span>";
									if($data->is_validated == 0)
										$value = "Esperando...";
										
									return $value;
								},
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
								'headerHtmlOptions'=>array("style"=>"text-align:right;"),
						),
						array(
								'header'=>"Acciones",
								'value'=>function($data){
									$id = "'$data->Id_device'";
									$value = '<button onclick="doTunnel('.$id.','.$data->Id_port.',0);" type="button" class="btn btn-default btn-sm"><i class="fa fa-circle fa-fw"></i> Cerrar</button>';
									if($data->is_open == 0)
										$value = '<button onclick="doTunnel('.$id.','.$data->Id_port.',1);" type="button" class="btn btn-default btn-sm"><i class="fa fa-circle-o fa-fw"></i> Abrir</button>';
									return $value;
								},
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
								'headerHtmlOptions'=>array("style"=>"text-align:right;"),
						),
					),
				)); ?>
              </div>
              </div><!-- tab-pane -->
                <div class="tab-pane" id="tabGeneral">
                
                <form id="general-config-form" role="form">
                <?php 
                	$modelDevice = new Device();
                	echo CHtml::activeHiddenField($modelDevice, 'Id');                	
                ?>    
  					<div class="inlineForm">
  					<label class="inlineFormLabel">Servidor Multimedia</label>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia IP</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	  					</div>
	  					<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Path Archivos</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_path', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	  					</div>
  					</div>  					
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Usuario</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_user', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia Password</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_passwd', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	  					</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Nombre</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_name', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	  				
	  					</div>	  					
  					</div>
  					</div>  					
  					<div class="inlineForm">
	  					<label class="inlineFormLabel">Varios</label>
	  					<div class="row">
	  						<div class="form-group col-sm-6">
		    					<label>Sabnzbd API Key</label>
		      						<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_key', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		  					</div>
		  					<div class="form-group col-sm-6 ">
		  					<?php if($isAdmin):?>
		    					<label>Es Tester</label>
	      							<?php echo CHtml::activeCheckBox($modelDevice, 'is_movie_tester', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	      					<?php endif;?>
		  					</div>
	  					</div>
  					</div>
  					<div class="form-group">
    					<div class="col-sm-12">    	
    						<button id="btn-save-config" onclick="submitGeneralConfig();" type="button" class="btn btn-primary pull-right"><i class="fa fa-save"></i> <span id="save-description">Guardar</span>    						
    						</button>
    					</div>
    				</div>
			</form>
                
              </div><!-- tab-pane -->
              <?php if($isAdmin):?>
              <div class="tab-pane" id="tabSabnzbd">
                <?php 
				  	echo $this->renderPartial('_sabnzbdConfig', array( 'modelSabNzbdConfigs'=>$modelSabNzbdConfigs, 'idDevice'=>$modelDevice->Id));
				  ?>
              </div><!-- tab-pane -->
              <?php endif;?>
              <div class="tab-pane" id="tabPlayer">
                <?php 
				  	echo $this->renderPartial('_playerConfig', array( 'modelPlayerConfigs'=>$modelPlayerConfigs, 'idDevice'=>$modelDevice->Id));
				  ?>
              </div><!-- tab-pane -->
              </div><!-- tab-content -->
			</div>
        	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
      	<!-- /.modal-content -->
      	
<script type="text/javascript">
function submitGeneralConfig()
{
	$('#general-config-form').submit();
}

$("#general-config-form").submit(function(e)
{
	var formURL = "<?php echo DeviceController::createUrl("AjaxSaveGeneralConfig"); ?>";	
	var formData = new FormData(this);

	$("#btn-save-config").attr("disabled","disabled");	
	
	$.ajax({
		   url: formURL,
		   type: 'POST',
		        data:  formData,
		   mimeType:"multipart/form-data",
		   contentType: false,
		   cache: false,
		   processData:false,
		   success: function(data, textStatus, jqXHR)
		   {	
				$("#btn-save-config").removeAttr("disabled");
				$("#save-description").html("Guardado");
					    		
		   },
		   error: function(jqXHR, textStatus, errorThrown)
		   {
			   	$("#btn-save-config").removeAttr("disabled");
			   	$("#save-description").html("Error");
		   }         
	});
	
	e.preventDefault();
	e.stopImmediatePropagation();
});	
</script>      	

</div>
<!-- /.modal-dialog -->