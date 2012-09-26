<?php

$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'View Nzb', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Update Nzb</h1>

<?php echo $this->renderPartial('_updateMovie', array('model'=>$model, 
													'modelUpload'=>$modelUpload, 
													'modelMyMovieMovie'=>$modelMyMovieMovie, 
													'ddlRsrcType'=>$ddlRsrcType)); 
?>
 