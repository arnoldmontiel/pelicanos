<div class="modal-dialog myModalConfigPuertos">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          	<h4 class="modal-title">Configurar </h4>
		</div>
        <div class="modal-body">
        <div class="panel panel-default panelCliente">
  <div class="panel-body">
   <div class="infoPanelCliente">
   <div class="bold"><span id="device-desc"></span> (ID: <span id="device-id"></span>)</div>
  </div></div>
</div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabPuertos" data-toggle="tab">Puertos</a></li>
				<li><a  href="#tabGeneral" data-toggle="tab">General</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabPuertos">			
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
                	$isAdmin = User::isAdmin();
                ?>    
  					<div class="row">        
	  					<div class="form-group col-sm-6 ">
	    					<label>Sabnzb API URL</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_url', array('class'=>'form-control', 'placeholder'=>'Url'));?>
	  					</div>
	  					<div class="form-group col-sm-6">
	  					<?php if($isAdmin):?>
	    					<label>Sabnzb API Key</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'sabnzb_api_key', array('class'=>'form-control'));?>
	  					<?php endif;?>	
	  					</div>  	
  					</div>			
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Path Sabnzb Descarga</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'path_sabnzbd_download', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Path Nzb Pendientes</label>
	    						<?php echo CHtml::activeTextField($modelDevice, 'path_pending', array('class'=>'form-control'));?>
	  					</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Path Nzb Listos</label>
	    						<?php echo CHtml::activeTextField($modelDevice, 'path_ready', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Path Imagenes</label>
	    						<?php echo CHtml::activeTextField($modelDevice, 'path_images', array('class'=>'form-control'));?>
	  					</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Path Compartidos</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'path_shared', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6 ">
	  					<?php if($isAdmin):?>
	    					<label>Host Path</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_path', array('class'=>'form-control'));?>
	  					<?php endif;?>
	  					</div>
  					</div>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Host File Server</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server', array('class'=>'form-control'));?>
	  					</div>
	  					<div class="form-group col-sm-6">
	    					<label>Host File Server Path</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'host_file_server_path', array('class'=>'form-control'));?>
	  					</div>
  					</div>
  					<?php if($isAdmin):?>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Tmdb API Key</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'tmdb_api_key', array('class'=>'form-control'));?>
	  					</div>  					
	  					<div class="form-group col-sm-6">
	    					<label>Tmdb API Lang</label>
	      						<?php echo CHtml::activeTextField($modelDevice, 'tmdb_lang', array('class'=>'form-control'));?>
	  					</div>
  					</div>
  					<?php endif;?>
  					<div class="form-group">
    					<div class="col-sm-12">
    						<button onclick="submitGeneralConfig();" type="button" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
    					</div>
    				</div>
			</form>
                
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
	    		$('#myModalPorts').trigger('click');
	    		return false;
		   },
		   error: function(jqXHR, textStatus, errorThrown)
		   {
		   }         
	});
	e.preventDefault(); //Prevent Default action.
});	
</script>      	

</div>
<!-- /.modal-dialog -->