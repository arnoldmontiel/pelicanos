<table class="table table-striped table-bordered tablaIndividual">
	<tr>
		<td class="align-right">Valor del punto</td>
		<td>
			<form class="form-inline" role="form">
					<?php
						echo CHtml::activeHiddenField($modelConsumptionConfig, 'username'); 
						echo CHtml::hiddenField('old-value',$modelConsumptionConfig->value,array('id'=>'old-value'));
						echo CHtml::hiddenField('old-currency',$modelConsumptionConfig->Id_currency,array('id'=>'old-currency'));
					?>
				<div class="form-group">
					<?php
						echo CHtml::activeTextField($modelConsumptionConfig, 'value', array('placeholder'=>0, 'class'=>'form-control', 'onkeyup'=>'checkNumber(this);checkChange();')); 
					?>
				</div>
				<div class="form-group">
					<?php 
						$list = CHtml::listData(Currency::model()->findAll(), 'Id', 'short_description');										
						echo CHtml::activeDropDownList($modelConsumptionConfig, 'Id_currency', $list, array('onchange'=>'checkChange();'));
					?>
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
			<button id="save-consumption-config-btn" onclick="saveConsumptionConfig();" disabled type="button" class="btn btn-primary">
				<i class="fa fa-save"></i> Guardar
			</button>
			<button id="saved-consumption-config-btn" disabled style="display: none" type="button" class="btn btn-primary">
				<i class="fa fa-check"></i> Guardado
			</button>
		</td>
	</tr>
</table>
