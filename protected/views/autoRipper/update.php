<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */


$this->menu=array(
	array('label'=>'View AutoRipper', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage AutoRipper', 'url'=>array('admin')),
);
?>

<h1>Update AutoRipper</h1>

<?php $this->renderPartial('_form', array('model'=>$model,
										'arrayDataProvider'=>$arrayDataProvider,
										'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,)); ?>