<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MatchedBy'); ?>
		<?php echo $form->textField($model,'MatchedBy',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDSubMovieFile'); ?>
		<?php echo $form->textField($model,'IDSubMovieFile',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieHash'); ?>
		<?php echo $form->textField($model,'MovieHash',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieByteSize'); ?>
		<?php echo $form->textField($model,'MovieByteSize',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieTimeMS'); ?>
		<?php echo $form->textField($model,'MovieTimeMS',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDSubtitleFile'); ?>
		<?php echo $form->textField($model,'IDSubtitleFile',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubFileName'); ?>
		<?php echo $form->textField($model,'SubFileName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubActualCD'); ?>
		<?php echo $form->textField($model,'SubActualCD',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubSize'); ?>
		<?php echo $form->textField($model,'SubSize',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubHash'); ?>
		<?php echo $form->textField($model,'SubHash',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDSubtitle'); ?>
		<?php echo $form->textField($model,'IDSubtitle',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubLanguageID'); ?>
		<?php echo $form->textField($model,'SubLanguageID',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubFormat'); ?>
		<?php echo $form->textField($model,'SubFormat',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubSumCD'); ?>
		<?php echo $form->textField($model,'SubSumCD',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubAuthorComment'); ?>
		<?php echo $form->textField($model,'SubAuthorComment',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubAddDate'); ?>
		<?php echo $form->textField($model,'SubAddDate',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubBad'); ?>
		<?php echo $form->textField($model,'SubBad',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubRating'); ?>
		<?php echo $form->textField($model,'SubRating',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubDownloadsCnt'); ?>
		<?php echo $form->textField($model,'SubDownloadsCnt',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieReleaseName'); ?>
		<?php echo $form->textField($model,'MovieReleaseName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDMovie'); ?>
		<?php echo $form->textField($model,'IDMovie',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDMovieImdb'); ?>
		<?php echo $form->textField($model,'IDMovieImdb',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieName'); ?>
		<?php echo $form->textField($model,'MovieName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieNameEng'); ?>
		<?php echo $form->textField($model,'MovieNameEng',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieYear'); ?>
		<?php echo $form->textField($model,'MovieYear',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieImdbRating'); ?>
		<?php echo $form->textField($model,'MovieImdbRating',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubFeatured'); ?>
		<?php echo $form->textField($model,'SubFeatured',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserNickName'); ?>
		<?php echo $form->textField($model,'UserNickName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ISO639'); ?>
		<?php echo $form->textField($model,'ISO639',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LanguageName'); ?>
		<?php echo $form->textField($model,'LanguageName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubComments'); ?>
		<?php echo $form->textField($model,'SubComments',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubHearingImpaired'); ?>
		<?php echo $form->textField($model,'SubHearingImpaired',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserRank'); ?>
		<?php echo $form->textField($model,'UserRank',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SeriesSeason'); ?>
		<?php echo $form->textField($model,'SeriesSeason',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SeriesEpisode'); ?>
		<?php echo $form->textField($model,'SeriesEpisode',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MovieKind'); ?>
		<?php echo $form->textField($model,'MovieKind',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'QueryNumber'); ?>
		<?php echo $form->textField($model,'QueryNumber',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubDownloadLink'); ?>
		<?php echo $form->textField($model,'SubDownloadLink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ZipDownloadLink'); ?>
		<?php echo $form->textField($model,'ZipDownloadLink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubtitlesLink'); ?>
		<?php echo $form->textField($model,'SubtitlesLink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_user'); ?>
		<?php echo $form->textField($model,'Id_user',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->