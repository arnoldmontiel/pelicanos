<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$modelNzb->imdbData->ID=>array('view','id'=>$modelNzb->Id),
	'Upload subtitle',
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Upload subtitle</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uploadSubtitle-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$modelNzb,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			'Id_imdbdata',
			array('label'=>$modelNzb->getAttributeLabel('Title'),
				'type'=>'raw',
				'value'=>$modelNzb->imdbData->Title
			),
			array('label'=>$modelNzb->getAttributeLabel('Year'),
				'type'=>'raw',
				'value'=>$modelNzb->imdbData->Year
			),
			'file_name',
			'subt_file_name'
		),
	)); ?>

<br>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file  *.srt , *.txt'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div style="width:50%;float:left">
		<?php echo CHtml::submitButton('Upload'); ?>
	</div><!-- div button save -->
	<div style="width:50%;float:right;position:relative">
	<?php
			 $this->widget('zii.widgets.jui.CJuiButton',
				 array(
				 	'id'=>'cancel',
				 	'name'=>'Cancel',
				 	'caption'=>'Cancel',
				 	'value'=>'Cancel',
				 	'onclick'=>'js:function(){
				 		window.location = "'.NzbController::createUrl('view',array('id'=>$modelNzb->Id)).'";
				 		return false;
					}',
			 	)
			 );
		 ?>		 
	</div><!-- div button cancel -->
	
<?php $this->endWidget(); ?>

</div><!-- form -->