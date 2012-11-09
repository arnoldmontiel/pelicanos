<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_device')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_device), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_v6')); ?>:</b>
	<?php echo CHtml::encode($data->ip_v6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_customer')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customer->last_name.' '.$data->customer->name), array('customer/view', 'id'=>$data->Id_customer)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_v4')); ?>:</b>
	<?php echo CHtml::encode($data->ip_v4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_v6')); ?>:</b>
	<?php echo CHtml::encode($data->ip_v6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('port_v4')); ?>:</b>
	<?php echo CHtml::encode($data->port_v4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('port_v6')); ?>:</b>
	<?php echo CHtml::encode($data->port_v6); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />


</div>