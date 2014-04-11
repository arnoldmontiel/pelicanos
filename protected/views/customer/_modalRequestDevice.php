<form id="request-device-form" method="post">
	<?php
		echo CHtml::activeHiddenField($modelCustomer, 'Id');
		echo CHtml::activeHiddenField($modalCustomerUser, 'Id_customer');
	?>
	<div class="modal-dialog myModalRequestDevice">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Solicitar Dispositivo</h4>
      		</div>
      		<div class="modal-body">
      		
      		<!-- <div class="panel panel-default panelCliente">
  <div class="panel-body">
   Cliente
   <div class="infoPanelCliente">
   <div class="bold"><?php // echo $modelCustomer->fullName;?></div>
      		<div><?php // echo $modelCustomer->address;?></div>
  </div></div>
</div> -->

<div class="form-group">
			  		<label for="campoNombre">Cliente</label>
			  		<select class="form-group">
			  		<option>Elegir Cliente</option>
			  		<option>Arnold Montiel</option>
			  		</select>
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
  <td><input class="form-control" placeholder="Descripci&oacute;n"></td>
  <td class="align-right"><button type="button" class="btn btn-primary btn-sm noMargin disabled"><i class="fa fa-plus"></i> Agregar</button></td>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="col-sm-12 form-group">
  <div class="grid-view">
<div class="summary"></div>
<table class="table table-condensed tablaIndividual noMargin">
<tbody>
<tr>
<td>1</td>
<td>Comedor de Diario</td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
<tr>
<td>2</td>
<td>Dormitorio Juan</td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
</tbody>
</table>
<div class="keys" style="display:none" title="/GreenCliente/index.php?Id=4&amp;ajax=commissionist-grid&amp;r=budget%2FAjaxUpdateCommissionistGrid&amp;version_number=1"><span>4,1,184</span></div>
</div>  

<div class="alert alert-danger"><i class="fa fa-warning"></i> Debe indicar por lo menos 1 player para hacer una solicitud</div>

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
			var formURL = "<?php echo CustomerController::createUrl("AjaxSaveRequestDevice"); ?>";
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
		    	$.fn.yiiGridView.update("customer-grid");
	    		$('#myModalGeneric').trigger('click');
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