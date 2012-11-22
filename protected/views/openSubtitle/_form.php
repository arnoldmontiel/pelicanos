<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-subtitle-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'MatchedBy'); ?>
		<?php echo $form->textField($model,'MatchedBy',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MatchedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDSubMovieFile'); ?>
		<?php echo $form->textField($model,'IDSubMovieFile',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'IDSubMovieFile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieHash'); ?>
		<?php echo $form->textField($model,'MovieHash',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieHash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieByteSize'); ?>
		<?php echo $form->textField($model,'MovieByteSize',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieByteSize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieTimeMS'); ?>
		<?php echo $form->textField($model,'MovieTimeMS',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieTimeMS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDSubtitleFile'); ?>
		<?php echo $form->textField($model,'IDSubtitleFile',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'IDSubtitleFile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubFileName'); ?>
		<?php echo $form->textField($model,'SubFileName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SubFileName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubActualCD'); ?>
		<?php echo $form->textField($model,'SubActualCD',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubActualCD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubSize'); ?>
		<?php echo $form->textField($model,'SubSize',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubSize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubHash'); ?>
		<?php echo $form->textField($model,'SubHash',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SubHash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDSubtitle'); ?>
		<?php echo $form->textField($model,'IDSubtitle',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'IDSubtitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubLanguageID'); ?>
		<?php echo $form->textField($model,'SubLanguageID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubLanguageID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubFormat'); ?>
		<?php echo $form->textField($model,'SubFormat',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubFormat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubSumCD'); ?>
		<?php echo $form->textField($model,'SubSumCD',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubSumCD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubAuthorComment'); ?>
		<?php echo $form->textField($model,'SubAuthorComment',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubAuthorComment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubAddDate'); ?>
		<?php echo $form->textField($model,'SubAddDate',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubAddDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubBad'); ?>
		<?php echo $form->textField($model,'SubBad',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubBad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubRating'); ?>
		<?php echo $form->textField($model,'SubRating',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubRating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubDownloadsCnt'); ?>
		<?php echo $form->textField($model,'SubDownloadsCnt',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubDownloadsCnt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieReleaseName'); ?>
		<?php echo $form->textField($model,'MovieReleaseName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieReleaseName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDMovie'); ?>
		<?php echo $form->textField($model,'IDMovie',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'IDMovie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDMovieImdb'); ?>
		<?php echo $form->textField($model,'IDMovieImdb',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'IDMovieImdb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieName'); ?>
		<?php echo $form->textField($model,'MovieName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'MovieName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieNameEng'); ?>
		<?php echo $form->textField($model,'MovieNameEng',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'MovieNameEng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieYear'); ?>
		<?php echo $form->textField($model,'MovieYear',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieImdbRating'); ?>
		<?php echo $form->textField($model,'MovieImdbRating',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieImdbRating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubFeatured'); ?>
		<?php echo $form->textField($model,'SubFeatured',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubFeatured'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserNickName'); ?>
		<?php echo $form->textField($model,'UserNickName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'UserNickName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ISO639'); ?>
		<?php echo $form->textField($model,'ISO639',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ISO639'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LanguageName'); ?>
		<?php echo $form->textField($model,'LanguageName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'LanguageName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubComments'); ?>
		<?php echo $form->textField($model,'SubComments',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubComments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubHearingImpaired'); ?>
		<?php echo $form->textField($model,'SubHearingImpaired',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubHearingImpaired'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserRank'); ?>
		<?php echo $form->textField($model,'UserRank',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'UserRank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SeriesSeason'); ?>
		<?php echo $form->textField($model,'SeriesSeason',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SeriesSeason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SeriesEpisode'); ?>
		<?php echo $form->textField($model,'SeriesEpisode',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SeriesEpisode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MovieKind'); ?>
		<?php echo $form->textField($model,'MovieKind',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MovieKind'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'QueryNumber'); ?>
		<?php echo $form->textField($model,'QueryNumber',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'QueryNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubDownloadLink'); ?>
		<?php echo $form->textField($model,'SubDownloadLink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'SubDownloadLink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ZipDownloadLink'); ?>
		<?php echo $form->textField($model,'ZipDownloadLink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ZipDownloadLink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubtitlesLink'); ?>
		<?php echo $form->textField($model,'SubtitlesLink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'SubtitlesLink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_user'); ?>
		<?php echo $form->textField($model,'Id_user',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Id_user'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->