<div class="modal-dialog myModalViewInfo">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
          	<h4 class="modal-title">Informaci&oacute;n </h4>
		</div>
        <div class="modal-body">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabDescargas" data-toggle="tab">Descargas</a></li>
				<li><a href="#tabErrorLog" data-toggle="tab">Informes</a></li>
				<li class="pull-right">
					<div class="panel panel-default panelCliente sideIDLabel">
  						<div class="panel-body">
   							<div class="infoPanelCliente">
   								<div class="bold"><span id="device-desc"></span> (ID: <span id="download-device-id"></span>)</div>
  							</div>
  						</div>
					</div>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabDescargas">
			  		<?php 
				  		echo $this->renderPartial('_downloads', array('modelNzbDevice'=>$modelNzbDevice));
				  	?>
              	</div><!-- tab-pane -->                
              	<div class="tab-pane" id="tabErrorLog">
                	<?php 
				  		echo $this->renderPartial('_errorLogs', array('modelErrorLog'=>$modelErrorLog));
				  	?>
              	</div><!-- tab-pane -->
			</div><!-- tab-content -->
		</div>
        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
		</div>
	</div>
      	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->