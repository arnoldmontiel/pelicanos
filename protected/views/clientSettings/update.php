<?php
$this->breadcrumbs=array(
	'Client Settings'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientSettings', 'url'=>array('index')),
	array('label'=>'Create ClientSettings', 'url'=>array('create')),
	array('label'=>'View ClientSettings', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage ClientSettings', 'url'=>array('admin')),
);
?>

<h1>Update ClientSettings <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
	'modelClientSettings'=>$modelClientSettings,
	'modelSettingsRipper'=>$modelSettingsRipper)); 
?>