<div class="inlineForm">
	<label class="inlineFormLabel">Claves</label>
  	<div class="row">
		<div class="form-group col-sm-6">
    		<label>Id instalaci&oacute;n</label>
      		<?php echo CHtml::textField('DevicePassword_Id','',array('Id'=>'DevicePassword_Id', 'class'=>'form-control', 'disabled'=>'disabled'));?>
  		</div>
  		<div class="form-group col-sm-6">
	  		<label>Disco</label>
	  		<?php echo CHtml::textField('DevicePassword_password','',array('Id'=>'DevicePassword_password', 'class'=>'form-control', 'disabled'=>'disabled'));?>
    	</div>
	</div>
  	<div class="row">
		<div class="form-group col-sm-6">
	    	<label>Sistema Operativo</label>
	    	<?php echo CHtml::textField('DevicePassword_password_os','',array('Id'=>'DevicePassword_password_os', 'class'=>'form-control', 'disabled'=>'disabled'));?>
	  	</div>
	  	<div class="form-group col-sm-6">
	    	<label>Base de Datos</label>
	    	<?php echo CHtml::textField('DevicePassword_password_db','',array('Id'=>'DevicePassword_password_db', 'class'=>'form-control', 'disabled'=>'disabled'));?>
		</div>
	</div>
</div>
<div class="inlineForm">
	<label class="inlineFormLabel">Datos Usuario</label>
  	<div class="row">
		<div class="form-group col-sm-6">
    		<label>Usuario</label>
      		<?php echo CHtml::textField('CustomerUser_username','',array('Id'=>'CustomerUser_username', 'class'=>'form-control', 'disabled'=>'disabled'));?>
  		</div>
  		<div class="form-group col-sm-6">
	  		<label>Clave</label>
	  		<?php echo CHtml::textField('CustomerUser_password','',array('Id'=>'CustomerUser_password', 'class'=>'form-control', 'disabled'=>'disabled'));?>
    	</div>
	</div>
</div>