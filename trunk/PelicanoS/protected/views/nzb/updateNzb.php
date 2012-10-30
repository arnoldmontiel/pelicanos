<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'View Nzb', 'url'=>array('view', 'id'=>$model->Id)),
);
?>

<h1>Update Nzb</h1>

<?php echo $this->renderPartial('_updateNzb', array('model'=>$model, 
													'modelUpload'=>$modelUpload, 
													'modelMyMovieDiscNzb'=>$modelMyMovieDiscNzb, 
													'ddlRsrcType'=>$ddlRsrcType)); 
?>
 