<?php

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'View Nzb', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Update Nzb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelUpload'=>$modelUpload, 'modelImdb'=>$modelImdb, 'ddlRsrcType'=>$ddlRsrcType)); ?>
<br>
<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'cancel',
			 	'name'=>'Cancel',
			 	'caption'=>'Cancel',
			 	'value'=>'Cancel',
		 		'cssFile'=>'',
			 	'onclick'=>'js:function(){
			 		window.location = "'.NzbController::createUrl('view',array('id'=>$model->Id)).'";
			 		return false;
				}',
		 	)
		 );
	 ?>		 