<?php

$this->menu=array(
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Select Serie</h1>

<?php 
echo $this->renderPartial('_selectSerie', array('model'=>$model,
											'modelMyMovieSerieHeader'=>$modelMyMovieSerieHeader,
									));
?>
	
