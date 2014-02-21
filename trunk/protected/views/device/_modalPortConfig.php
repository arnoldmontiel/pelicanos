<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          	<h4 class="modal-title">Configurar Puertos </h4>
		</div>
        <div class="modal-body">
			<ul class="nav nav-tabs">
				<li class="active"><a><span id="device-desc"></span> (ID: <span id="device-id"></span>)</a></li>
			</ul>			
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
				<div id="status-error" style="display:none;"  class="estadoModal">
					<label for="campoLineal">Estado</label>
      				<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
      					<span id="errorMsg">El puerto externo no puede estar vacio.</span>
 					</div>
				</div>
				
  				<button id="btn-add-port" onclick="addPort();" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar</button>
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
			</div>
        	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
      	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->