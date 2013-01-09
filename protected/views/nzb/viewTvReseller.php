<?php


$this->menu=array(
	array('label'=>'List Series', 'url'=>array('indexTvReseller')),
);	

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
<h1>View Disc</h1>

<div class="movie-detail-view" >
	<div class="left-movie-detail-view" >
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->name); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('serie')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader->name); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('season')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->getSeasonNumber()); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('episodes')); ?>:</b>
		<?php echo CHtml::encode($model->myMovieDiscNzb->getEpisodes()); ?>
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
		
	<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'disc-episodes-grid',
			'dataProvider'=>$modelDiscEpisodes->search(),
			'filter'=>$modelDiscEpisodes,
			'summaryText'=>'',
			'columns'=>array(	
						array(
				 			'name'=>'episode_number',
							'value'=>'$data->myMovieEpisode->episode_number',
						),
						array(
				 			'name'=>'episode_name',
							'value'=>'$data->myMovieEpisode->name',
						),
		
			),			
			));		
		?>			
		<br />
		
	</div>
	<div class="right-movie-detail-view">
		<?php echo CHtml::image( "./images/".$model->myMovieDiscNzb->myMovieNzb->poster, $model->myMovieDiscNzb->myMovieNzb->original_title,array('id'=>'poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
</div>

