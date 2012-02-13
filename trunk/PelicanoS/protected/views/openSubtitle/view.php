<?php
$this->breadcrumbs=array(
	'Open Subtitles'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List OpenSubtitle', 'url'=>array('index')),
	array('label'=>'Create OpenSubtitle', 'url'=>array('create')),
	array('label'=>'Update OpenSubtitle', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete OpenSubtitle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenSubtitle', 'url'=>array('admin')),
);
?>

<h1>View OpenSubtitle #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'MatchedBy',
		'IDSubMovieFile',
		'MovieHash',
		'MovieByteSize',
		'MovieTimeMS',
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
	),
)); ?>
