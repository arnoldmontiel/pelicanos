<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */

$this->menu=array(
	array('label'=>'Update AutoRipper', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Manage AutoRipper', 'url'=>array('admin')),
);
?>

<h1>View AutoRipper</h1>
<h3><?php echo 'DISC ID: '. $model->Id_disc;?></h3>

<?php 
		$modelNzb = (isset($model->nzb))?$model->nzb:null;
		$title = '';
		$year = '';
		$description = '';
		$poster = '';
		if(isset($modelNzb))
		{
			$year = $modelNzb->myMovieDiscNzb->myMovieNzb->original_title;
			$title = $modelNzb->myMovieDiscNzb->myMovieNzb->production_year;
			$description = $modelNzb->myMovieDiscNzb->myMovieNzb->description;
			$poster = $modelNzb->myMovieDiscNzb->myMovieNzb->poster;
		}
		
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_disc'),
				'type'=>'raw',
				'value'=>$model->Id_disc, 
			),
			array('label'=>$model->getAttributeLabel('Id_auto_ripper_state'),
				'type'=>'raw',
				'value'=>$model->autoRipperState->description, 
			),
			array('label'=>$model->getAttributeLabel('name'),
				'type'=>'raw',
				'value'=>$model->name,
			),
			array('label'=>$model->getAttributeLabel('password'),
					'type'=>'raw',
					'value'=>$model->password,
			),
			array('label'=>$model->getAttributeLabel('Title'),
					'type'=>'raw',
					'value'=>$title,
			),
			array('label'=>$model->getAttributeLabel('Year'),
								'type'=>'raw',
								'value'=>$year,
			),
			array('label'=>$model->getAttributeLabel('Description'),
											'type'=>'raw',
											'value'=>$description,
			),
			array('label'=>$model->getAttributeLabel('Poster'),
								'type'=>'raw',
								'value'=>CHtml::image('images/'.$poster),
			),
		),
	)); ?>
