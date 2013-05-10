<?php

$confirm = '';
if($model->deleted == 1)
{
	$confirm = 'Are you sure you want to re-create this item?';
	$this->menu=array(
		array('label'=>'List Nzb Movies', 'url'=>array('index')),
		array('label'=>'Re-create Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>$confirm)),
		array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	);
}
else
{
	$confirm = 'Are you sure you want to delete this item?';
	$this->menu=array(
		array('label'=>'List Nzb Movies', 'url'=>array('index')),
		array('label'=>'Create Nzb', 'url'=>array('create')),
		array('label'=>'Update Nzb', 'url'=>array('updateNzb', 'id'=>$model->Id)),
		array('label'=>'Update Box', 'url'=>array('updateBox', 'id'=>$model->myMovieDiscNzb->Id_my_movie_nzb)),
		array('label'=>'Update Specification', 'url'=>array('selectSpecification', 'id'=>$model->Id, 'redirectActionPage'=>'view')),		
		array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>$confirm)),
		array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	);	
}


?>

<?php
Yii::app()->clientScript->registerScript('viewNZB', "
	$('#page').css('background-image','url(./images/".$model->myMovieDiscNzb->myMovieNzb->backdrop.")');
	
$('#publishButton').click(function(){

	if (confirm('Are you sure you want to publish this nzb?')) 
	{
		$.post('".NzbController::createUrl('AjaxPublishNzb')."',
		{
			nzbId : '".$model->Id."'											
		}
		).success(
			function(data) 
			{
				$('#publishButton').attr('disabled', 'disabled');
			}
		).error(
			function()
			{
				$('#publishButton').removeAttr('disabled');
			});
	}
	return false;

});
	
");
?>
<h1>View Nzb</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
		<b><?php echo CHtml::encode($model->getAttributeLabel('file_name')); ?>:</b>
		<?php echo CHtml::link($model->file_original_name, NzbController::createUrl('AjaxDownloadFile',array('fileName'=>$model->file_name, 'root'=>'nzb'))); ?>
		<br />
			
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id imdb')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->imdb); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('original_title')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->original_title); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('production_year')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->production_year); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('rating')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->rating); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('genre')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->genre); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('studio')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->studio); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->description); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('running_time')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->running_time); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_resource_type')); ?>:</b>
		<?php echo CHtml::encode($model->resourceType->description); ?>
		<br />
			
		<b><?php echo CHtml::encode($model->getAttributeLabel('points')); ?>:</b>
		<?php echo CHtml::encode($model->points); ?>
		<br />
		
		<?php if($model->deleted == 1){ ?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('State')); ?>:</b>
		<span class="deleted">Deleted</span>
		<br />
		<?php } ?>
		
		<?php
		$state = $model->getCreationState();
		if(isset($state)&&$state->Id_creation_state== 5)
		{
			echo CHtml::submitButton('Publish',array('id'=>'publishButton', 'disabled'=>($model->is_draft)?'':'disabled'));
		} 
		?>
		<br />
		
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->myMovieDiscNzb->myMovieNzb->poster, $model->myMovieDiscNzb->myMovieNzb->original_title,array('id'=>'poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>
<h1>Historial</h1>

<?php
$modelNzbCreationState = new NzbCreationState();
$modelNzbCreationState->Id_nzb = $model->Id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'history-grid',
	'dataProvider'=>$modelNzbCreationState->search(),
	'filter'=>$modelNzbCreationState,
	'columns'=>array(
		array('name'=>'user_username','value'=>'$data->user->username'),
		array('name'=>'Id_creation_state','value'=>'$data->creationState->description'),
		'date',
	),
)); ?>

