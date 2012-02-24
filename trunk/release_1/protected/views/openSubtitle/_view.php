<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MatchedBy')); ?>:</b>
	<?php echo CHtml::encode($data->MatchedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDSubMovieFile')); ?>:</b>
	<?php echo CHtml::encode($data->IDSubMovieFile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieHash')); ?>:</b>
	<?php echo CHtml::encode($data->MovieHash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieByteSize')); ?>:</b>
	<?php echo CHtml::encode($data->MovieByteSize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieTimeMS')); ?>:</b>
	<?php echo CHtml::encode($data->MovieTimeMS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDSubtitleFile')); ?>:</b>
	<?php echo CHtml::encode($data->IDSubtitleFile); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SubFileName')); ?>:</b>
	<?php echo CHtml::encode($data->SubFileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubActualCD')); ?>:</b>
	<?php echo CHtml::encode($data->SubActualCD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubSize')); ?>:</b>
	<?php echo CHtml::encode($data->SubSize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubHash')); ?>:</b>
	<?php echo CHtml::encode($data->SubHash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDSubtitle')); ?>:</b>
	<?php echo CHtml::encode($data->IDSubtitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubLanguageID')); ?>:</b>
	<?php echo CHtml::encode($data->SubLanguageID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubFormat')); ?>:</b>
	<?php echo CHtml::encode($data->SubFormat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubSumCD')); ?>:</b>
	<?php echo CHtml::encode($data->SubSumCD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubAuthorComment')); ?>:</b>
	<?php echo CHtml::encode($data->SubAuthorComment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubAddDate')); ?>:</b>
	<?php echo CHtml::encode($data->SubAddDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubBad')); ?>:</b>
	<?php echo CHtml::encode($data->SubBad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubRating')); ?>:</b>
	<?php echo CHtml::encode($data->SubRating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubDownloadsCnt')); ?>:</b>
	<?php echo CHtml::encode($data->SubDownloadsCnt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieReleaseName')); ?>:</b>
	<?php echo CHtml::encode($data->MovieReleaseName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDMovie')); ?>:</b>
	<?php echo CHtml::encode($data->IDMovie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDMovieImdb')); ?>:</b>
	<?php echo CHtml::encode($data->IDMovieImdb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieName')); ?>:</b>
	<?php echo CHtml::encode($data->MovieName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieNameEng')); ?>:</b>
	<?php echo CHtml::encode($data->MovieNameEng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieYear')); ?>:</b>
	<?php echo CHtml::encode($data->MovieYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieImdbRating')); ?>:</b>
	<?php echo CHtml::encode($data->MovieImdbRating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubFeatured')); ?>:</b>
	<?php echo CHtml::encode($data->SubFeatured); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserNickName')); ?>:</b>
	<?php echo CHtml::encode($data->UserNickName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ISO639')); ?>:</b>
	<?php echo CHtml::encode($data->ISO639); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LanguageName')); ?>:</b>
	<?php echo CHtml::encode($data->LanguageName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubComments')); ?>:</b>
	<?php echo CHtml::encode($data->SubComments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubHearingImpaired')); ?>:</b>
	<?php echo CHtml::encode($data->SubHearingImpaired); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserRank')); ?>:</b>
	<?php echo CHtml::encode($data->UserRank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SeriesSeason')); ?>:</b>
	<?php echo CHtml::encode($data->SeriesSeason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SeriesEpisode')); ?>:</b>
	<?php echo CHtml::encode($data->SeriesEpisode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MovieKind')); ?>:</b>
	<?php echo CHtml::encode($data->MovieKind); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QueryNumber')); ?>:</b>
	<?php echo CHtml::encode($data->QueryNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubDownloadLink')); ?>:</b>
	<?php echo CHtml::encode($data->SubDownloadLink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ZipDownloadLink')); ?>:</b>
	<?php echo CHtml::encode($data->ZipDownloadLink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubtitlesLink')); ?>:</b>
	<?php echo CHtml::encode($data->SubtitlesLink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_user')); ?>:</b>
	<?php echo CHtml::encode($data->Id_user); ?>
	<br />

	*/ ?>

</div>