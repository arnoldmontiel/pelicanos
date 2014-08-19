<script type="text/javascript">
function openConsumptionDetail(idCustomer, month, year)
{
	var param = 'idCustomer= '+idCustomer + '&month='+month + '&year='+year; 
	$.ajax({
		type: 'POST',
		url: "<?php echo ConsumptionController::createUrl('AjaxConsumptionDetail')?>",
		data: param,
	}).success(function(data)
	{		
		$('#myModalConsumptionDetail').html(data);	
		$('#myModalConsumptionDetail').modal({
			show: true
		})		
	});
	return false;	
}

function openConsumptionDetailByReseller(idReseller, month, year)
{
	var param = 'idReseller= '+idReseller + '&month='+month + '&year='+year; 
	$.ajax({
		type: 'POST',
		url: "<?php echo ConsumptionController::createUrl('AjaxConsumptionDetailByReseller')?>",
		data: param,
	}).success(function(data)
	{		
		$('#myModalConsumptionDetail').html(data);	
		$('#myModalConsumptionDetail').modal({
			show: true
		})		
	});
	return false;	
}

function registerPayment(idCustomer, month, year, fullName)
{
	if(confirm("Registrar pago cliente " + fullName + " año: " + year + " mes: " + month))
	{
		$.post("<?php echo ConsumptionController::createUrl('AjaxRegisterCustomerPayment'); ?>",
				{
					idCustomer:idCustomer,
					year:year,
					month:month
				}
			).success(
				function(data){
					var obj = jQuery.parseJSON(data);				
					if(obj != null)
					{
						$("#qty-by-customer").text(obj.qtyByCustomer);
						$("#qty-by-reseller").text(obj.qtyByReseller);
						$("#points-paid-by-customer").text(obj.pointsPaid);
						$("#points-pending-by-customer").text(obj.pointsPending);
						$("#points-paid-by-reseller").text(obj.pointsPaid);
						$("#points-pending-by-reseller").text(obj.pointsPending);
					}		
					$.fn.yiiGridView.update('pending-customer-grid');
					$.fn.yiiGridView.update('payment-customer-grid');
					$.fn.yiiGridView.update('pending-reseller-grid');
					$.fn.yiiGridView.update('payment-reseller-grid');
				});
	}
	return false;
		
}

function registerResellerPayment(idReseller, month, year, fullName)
{
	if(confirm("Registrar pago reseller " + fullName + " año: " + year + " mes: " + month))
	{
		$.post("<?php echo ConsumptionController::createUrl('AjaxRegisterResellerPayment'); ?>",
				{
					idReseller:idReseller,
					year:year,
					month:month
				}
			).success(
				function(data){
					var obj = jQuery.parseJSON(data);				
					if(obj != null)
					{
						$("#qty-by-customer").text(obj.qtyByCustomer);
						$("#qty-by-reseller").text(obj.qtyByReseller);
						$("#points-paid-by-customer").text(obj.pointsPaid);
						$("#points-pending-by-customer").text(obj.pointsPending);
						$("#points-paid-by-reseller").text(obj.pointsPaid);
						$("#points-pending-by-reseller").text(obj.pointsPending);
					}
					$.fn.yiiGridView.update('pending-customer-grid');
					$.fn.yiiGridView.update('payment-customer-grid');
					$.fn.yiiGridView.update('pending-reseller-grid');
					$.fn.yiiGridView.update('payment-reseller-grid');
				});
	}
	return false;
		
}

function generateTicket(id, month, year, type)
{
	var params = "&id="+id+"&month="+month+"&year="+year+"&type="+type;
	window.open("<?php echo ConsumptionController::createUrl('GeneratePDF'); ?>" + params, "_blank");
	return false;	
}

function openConsumptionConfig()
{
	//var param = 'idReseller= '+idReseller + '&month='+month + '&year='+year; 
	$.ajax({
		type: 'POST',
		url: "<?php echo ConsumptionController::createUrl('AjaxConsumptionConfig')?>"
	}).success(function(data)
	{		
		$('#myModalConsumptionConfig').html(data);	
		$('#myModalConsumptionConfig').modal({
			show: true
		})		
	});
	return false;	
}
</script>
<div class="container" id="screenConsumos">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="pageTitle">Consumos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabReseller" data-toggle="tab">Resellers</a></li>
				<li><a href="#tabClientes" data-toggle="tab">Clientes</a></li>
				<li><a onclick="openConsumptionConfig();" href="#tabConfig" data-toggle="tab"><i
						class="fa fa-cog"></i> Configuraci&oacute;n</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabReseller">
					<div class="row">
						<div class="col-sm-3">
							<!-- tabs left -->
							<div class="tabbable tabs-left tabsLeftCustom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tabResellerPendiente" data-toggle="tab">Pendiente <span id="qty-by-reseller" class="badge"><?php echo Consumption::pendingQtyByReseller();?></span></a></li>
									<li><a href="#tabResellerPagos" data-toggle="tab">Pagos</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="tab-content">
								<div class="tab-pane active" id="tabResellerPendiente">									
									<?php echo $this->renderPartial('_tabPendingReseller',array('model'=>$model)); ?>									
								</div>
								<div class="tab-pane" id="tabResellerPagos">
									<?php echo $this->renderPartial('_tabPaymentReseller',array('model'=>$model)); ?>
								</div>
								<div class="tab-pane" id="tabResellerHistorico">Secondo sed ac
									orci quis tortor imperdiet venenatis. Duis elementum auctor
									accumsan. Aliquam in felis sit amet augue.</div>
							</div>
						</div>
					</div>
					<!-- /tabsLeft -->
				</div>
				<!-- /.tabReseller -->

				<div class="tab-pane" id="tabClientes">
					<div class="row">
						<div class="col-sm-3">
							<!-- tabs left -->
							<div class="tabbable tabs-left tabsLeftCustom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tabClientesPendiente" data-toggle="tab">Pendiente <span id="qty-by-customer" class="badge"><?php echo Consumption::pendingQtyByCustomer();?></span></a></li>
									<li><a href="#tabClientesPagos" data-toggle="tab">Pagos</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="tab-content">
								<div class="tab-pane active" id="tabClientesPendiente">
									<?php echo $this->renderPartial('_tabPending',array('model'=>$model)); ?>
								</div>
								<div class="tab-pane" id="tabClientesPagos">
									<?php echo $this->renderPartial('_tabPayment',array('model'=>$model)); ?>
								</div>
								<div class="tab-pane" id="tabResellerHistorico">Secondo sed ac
									orci quis tortor imperdiet venenatis. Duis elementum auctor
									accumsan. Aliquam in felis sit amet augue.</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.tabClientes -->
				<div class="tab-pane" id="tabConfig">
					<table class="table table-striped table-bordered tablaIndividual">
						<tr>
							<td class="align-right">Valor del punto</td>
							<td>
								<form class="form-inline" role="form">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="0">
									</div>
									<div class="form-group">
										<select class="form-control">
											<option>US Dollar</option>
											<option>Soles</option>
											<option>Peso Argentino</option>
										</select>
									</div>
								</form>
							</td>
						</tr>
						<tr>
							<td class="align-right">&nbsp;</td>
							<td class="bold">ATENCI&Oacute;N: Al modificar el valor solo se
								veran afectadas las facturas y consumos pendientes.</td>
						</tr>

						<tr>
							<td class="align-right">&nbsp;</td>
							<td>
								<button type="button" class="btn btn-primary">
									<i class="fa fa-save"></i> Guardar
								</button>
							</td>
						</tr>
					</table>

				</div>
				<!-- /.tabConfig -->
			</div>
		</div>
	</div>
</div>
