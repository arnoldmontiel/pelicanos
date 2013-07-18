<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */

$this->breadcrumbs=array(
	'Auto Rippers'=>array('index'),
	$model->name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AutoRipper', 'url'=>array('index')),
	array('label'=>'Create AutoRipper', 'url'=>array('create')),
	array('label'=>'View AutoRipper', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage AutoRipper', 'url'=>array('admin')),
);
?>

<h1>Update AutoRipper <?php echo $model->Id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
										'arrayDataProvider'=>$arrayDataProvider,
										'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,)); ?>