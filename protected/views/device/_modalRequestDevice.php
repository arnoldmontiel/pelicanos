<form id="request-device-form">	
	<div class="modal-dialog myModalRequestDevice">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Solicitar Dispositivo</h4>
      		</div>
      		<div class="modal-body">
				<div class="form-group">
					<label for="campoNombre">Cliente</label>
					<?php echo CHtml::activeDropDownList($modelCustomerDevice, 'Id_customer', CHtml::listData($modelCustomers, 'Id', 'fullName')); ?>
				</div>
				<div class="form-group">
					<label for="campoNombre">Descripci&oacute;n Dispositivo</label>
					<?php echo CHtml::activeTextField($modelDevice, 'description', array('class'=>'form-control')); ?>
				</div>
				<div class="form-group">
					<label for="campoNombre">Agregar NAS</label>
					<input type="checkbox" >
				</div>
				<div class="row">
			  		<div class="col-sm-12 form-group">
			  			<label>  Indique los players que necesita:</label>
			  			<table class="table table-condensed tablaIndividual noMargin">
			  				<thead>
			  					<tr>
			  						<th>Player</th>
			  						<th class="align-right">Acciones</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<tr>
			  						<td><input id="player-desc" class="form-control" placeholder="Descripci&oacute;n"></td>
			  						<td class="align-right"><button onclick="addPlayer();" type="button" class="btn btn-primary btn-sm noMargin"><i class="fa fa-plus"></i> Agregar</button></td>
			  					</tr>
			  				</tbody>
			  			</table>
			  		</div>
  					<div class="col-sm-12 form-group">
  						<div class="grid-view">
							<div class="summary"></div>
							<table id="body-players" class="table table-condensed tablaIndividual noMargin">
								<tbody>
								</tbody>
							</table>
						</div>  
						<div id="error-div" style="display:none" class="alert alert-danger"><i class="fa fa-warning"></i><span id="error-msg"></span></div>
					</div>
				</div>
			</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button onclick="saveRequest();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-arrow-right"></i> Solicitar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
<script type="text/javascript">

		$("#request-device-form").submit(function(e)
		{
			var playerNum = $("#body-players > tbody > tr").length;
			if(playerNum == 0)
			{
				$("#error-msg").html("  Debe indicar por lo menos 1 player para hacer una solicitud");
				$("#error-div").show();
				return false;
			}
			
			var formURL = "<?php echo DeviceController::createUrl("AjaxSaveRequestDevice"); ?>";
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
		    	var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					if(obj.qtyPending > 0)
					{
						$("#qty-pending").show();
						$("#qty-pending").html(obj.qtyPending);
					}
					else
						$("#qty-pending").hide();
				}				
				$.fn.yiiGridView.update("pending-customer-device-grid");
	    		$('#myModalRequestDevice').trigger('click');
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function saveRequest()
	{
		$('#request-device-form').submit();
	}
</script>