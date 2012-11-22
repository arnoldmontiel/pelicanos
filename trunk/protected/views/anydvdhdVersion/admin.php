<?php
$this->breadcrumbs=array(
	'Anydvdhd Versions',
);


Yii::app()->clientScript->registerScript('anydvdvhd_version', "
$('#update-button').click(function(){
	jQuery('#waiting').dialog('open');
	$.post('".AnydvdhdVersionController::CreateUrl('ajaxUpdateWithLastVersion')."',
	function(){
		jQuery('#waiting').dialog('close');
		$.fn.yiiGridView.update('anydvdhd-version-grid', {
			data: $('.search-form form').serialize()
			});
		});
	return false;
});

");

$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('none'),
			'idDialog'=>'waiting',
));

?>

<h1>Anydvdhd Versions</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'anydvdhd-version-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'version',
		array('name'=>'file_name','type'=>'html','value'=>'CHtml::link($data->file_name,"./downloads/".$data->file_name)'),
		'date',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
<?php 
	echo CHtml::button('Update',array('id'=>'update-button'));
?>
