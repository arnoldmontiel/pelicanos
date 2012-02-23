<?php

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Create Nzb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelUpload'=>$modelUpload, 'modelImdb'=>$modelImdb, 'ddlRsrcType'=>$ddlRsrcType)); ?>
<br>
<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'cancel',
			 	'name'=>'Cancel',
			 	'caption'=>'Cancel',
			 	'cssFile'=>'',
			 	'value'=>'Cancel',
			 	'onclick'=>'js:function(){
			 		window.location = "'.NzbController::createUrl('index').'";
			 		return false;
				}',
		 	)
		 );
	 ?>		
