<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$idImdb=>array('view','id'=>$id),
	'Backdrop',
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Backdrop</h1>

<div class="form">
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/detail-view-blue.css');
Yii::app()->clientScript->registerScript(__CLASS__.'movieImages', "

$(document).ready(function() {
 
$.ajax({
      url: 'http://api.themoviedb.org/2.1/Movie.getImages/en/json/cb1fddfd86177c7df456045bddbbc762/".$idImdb."',
      dataType: 'jsonp',
      success: function(data) {      		
			$.each(data[0].backdrops, function(j,item){
				if(data[0].backdrops[j].image.size == 'thumb')
					$('<img/>').attr('src', data[0].backdrops[j].image.url).appendTo('#images');
				
				if(data[0].backdrops[j].image.size == 'original')
				{
					var radio = $('<input>').attr({type: 'radio', name: 'img', value: data[0].posters[j].image.url, id: 'img'});
					radio.appendTo('#images');
				}	
			});		      		
		}
    });
});



");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-subtitle-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo CHtml::hiddenField('idImdb',$idImdb,array('id'=>'idImdb')); ?>
	
	<div id="images"></div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create and find Subtitle' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->