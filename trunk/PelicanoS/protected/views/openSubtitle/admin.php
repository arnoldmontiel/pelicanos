<?php

$this->menu=array(
	array('label'=>'List OpenSubtitle', 'url'=>array('index')),
	array('label'=>'Create OpenSubtitle', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('open-subtitle-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Open Subtitles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'open-subtitle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'MatchedBy',
		'IDSubMovieFile',
		'MovieHash',
		'MovieByteSize',
		'MovieTimeMS',
		/*
		'IDSubtitleFile',
		'SubFileName',
		'SubActualCD',
		'SubSize',
		'SubHash',
		'IDSubtitle',
		'UserID',
		'SubLanguageID',
		'SubFormat',
		'SubSumCD',
		'SubAuthorComment',
		'SubAddDate',
		'SubBad',
		'SubRating',
		'SubDownloadsCnt',
		'MovieReleaseName',
		'IDMovie',
		'IDMovieImdb',
		'MovieName',
		'MovieNameEng',
		'MovieYear',
		'MovieImdbRating',
		'SubFeatured',
		'UserNickName',
		'ISO639',
		'LanguageName',
		'SubComments',
		'SubHearingImpaired',
		'UserRank',
		'SeriesSeason',
		'SeriesEpisode',
		'MovieKind',
		'QueryNumber',
		'SubDownloadLink',
		'ZipDownloadLink',
		'SubtitlesLink',
		'Id_user',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
