<?php

$this->menu=array(
	array('label'=>'List Series Tv', 'url'=>array('index')),
	array('label'=>'View Serie Tv', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Series Tv', 'url'=>array('admin')),
);
?>

<h1>Set Season</h1>

<div class="form">
<?php

Yii::app()->clientScript->registerScript('findSubtitle', "


$(function() {
$.fn.yiiGridView.update('seasons-grid', {
			data: $(this).serialize()
		});
 });				
$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	$('.txtEpisodes').blur();
    	return false;
    }
  });
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setSeason-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			'ID',
			'Title',
			'Year',
			'Plot'
		),
	)); ?>
<br>
<br>	
<div id="display" style="widht:100%;">
	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
			Actions
		</div>
	</div>
	<div style="width:50%;display: inline-block;float: left;">
		
		<div class="row" id="generate">
			<div style="display: inline-block;">
				<p class="note">Add season quantity.</p>
			</div>
			<div style="display: inline-block;">
				<?php echo CHtml::textField('seasonQty','',array('id'=>'seasonQty','size'=>5));?>
			</div>
			<div style="display: inline-block;">
				<?php
					echo CHtml::imageButton(
		                                'images/generate.png',
		                                array(
		                                'title'=>'Generate seasons',
		                                'width'=>'50px',
		                                'id'=>'deleteAlls',
		                                	'ajax'=> array(
												'type'=>'POST',
												'url'=>ImdbdataTvController::createUrl('AjaxAddSeasons', array('id'=>$model->ID)),
												'beforeSend'=>'function(){
															if(!confirm("Are you sure?")) 
																return false;
																}',
												'success'=>'js:function(data)
												{
													$.fn.yiiGridView.update("seasons-grid", {
														data: $(this).serialize()
													});
													$("#seasonQty").val(null);
												}'
		                                	)
		                                )
		                                                         
		                            ); 
				?>
			</div>
		</div>

		<div class="row">
			<div style="display: inline-block;">
				<p class="note">Add new season.</p>
			</div>
			<div style="display: inline-block;">
			<?php
					echo CHtml::imageButton(
			                                'images/add.png',
			                                array(
			                                'title'=>'Add new season',
			                                'width'=>'25px',
			                                'id'=>'deleteAll',
			                                	'ajax'=> array(
													'type'=>'POST',
													'url'=>ImdbdataTvController::createUrl('AjaxAddNewSeason', array('id'=>$model->ID)),
													'success'=>'js:function(data)
													{
														$.fn.yiiGridView.update("seasons-grid", {
															data: $(this).serialize()
														});
													}'
			                                	)
			                                )
			                                                         
			                            ); 
					?>
			</div>
		</div>
		<div class="row">
			<div style="display: inline-block;">
				<p class="note">Delete last season.</p>
			</div>
			<div style="display: inline-block;">
			<?php
					echo CHtml::imageButton(
			                                'images/delete.png',
			                                array(
			                                'title'=>'Remove last season',
			                                'width'=>'25px',
			                                'id'=>'deleteAlld',
			                                	'ajax'=> array(
													'type'=>'POST',
													'url'=>ImdbdataTvController::createUrl('AjaxDeleteSeason', array('id'=>$model->ID)),
													'beforeSend'=>'function(){
																if(!confirm("Are you sure you want to delete last season?")) 
																return false;
													}',
													'success'=>'js:function(data)
													{
														$.fn.yiiGridView.update("seasons-grid", {
															data: $(this).serialize()
														});
													}'
			                                	)
			                                )
			                                                         
			                            ); 
					?>
			</div>
		</div>
	</div>
	<div style="width:30%;display: inline-block;">
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'seasons-grid',
		'dataProvider'=>$modelSeason->search(),
	 	//'selectableRows'=>0,
		'summaryText'=>'',
		'afterAjaxUpdate'=>'function(id, data){
									
											var childCount = 0;
	 										$("#seasons-grid").find("input.txtEpisodes").each(
													function(index, item){
																	childCount = childCount + 1;
																	$(item).keyup(function(){
				        												validateNumber($(this));
																	});
													
																	$(item).change(function(){
																		
																		var target = $(this);
																		
																		var keys = $.fn.yiiGridView.getSelection("seasons-grid")[0].split(",");
																		
																		$.post(
																			"'. ImdbdataTvController::createUrl('AjaxUpdateEpisode').'",
																		{
																			id: keys[0],
																			season: keys[1],
																			episodes: $(this).val()
																		}).success(
																		function()
																		{
																			$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000);
																			$(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);
																		});
																		
														});
											});
											if(childCount == 0)
												$("#generate").animate({opacity: "show"},500);
											else
												$("#generate").animate({opacity: "hide"},500);
		}',	
		'columns'=>array(
					season,
					array(
						'name'=>'episodes',
						'value'=>
								'CHtml::textField("txtEpisodes",
													$data->episodes,
													array(
															"id"=>$data->season,
															"class"=>"txtEpisodes",
															"style"=>"width:50px",
														)
												)',
	
						'type'=>'raw',
	
				        'htmlOptions'=>array('width'=>5),
					),
					array(
						'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
						'type'=>'raw',
						'htmlOptions'=>array('width'=>25),
					),
				),
	)); ?>
	</div>
</div>
	
<div style="width:50%;float:left">
	<div style="width:40%;float:left">
		<?php echo CHtml::submitButton('Save Subtitle',array('id'=>'downloadSubtitle','name'=>'downloadSubtitle', 'style'=>'display:none')); ?>
	</div>		
	<div style="width:58%;float:right"> 	
		 <p id="loadingSave" style="float:left;width:20px">&nbsp;</p>
	</div>
</div><!-- div button save -->

<?php $this->endWidget(); ?>
</div> <!-- form -->