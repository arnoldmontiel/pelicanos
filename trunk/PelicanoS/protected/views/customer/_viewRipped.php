<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('original_title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->myMovie->original_title), array('viewRipped', 'id'=>$data->Id_my_movie)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('production_year')); ?>:</b>
	<?php echo CHtml::encode($data->myMovie->production_year); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->myMovie->type); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
	<?php echo CHtml::encode($data->myMovie->genre); ?>
	<br />


</div>