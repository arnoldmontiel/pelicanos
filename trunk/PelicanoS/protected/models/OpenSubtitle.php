<?php

/**
 * This is the model class for table "open_subtitle".
 *
 * The followings are the available columns in table 'open_subtitle':
 * @property integer $Id
 * @property string $MatchedBy
 * @property string $IDSubMovieFile
 * @property string $MovieHash
 * @property string $MovieByteSize
 * @property string $MovieTimeMS
 * @property string $IDSubtitleFile
 * @property string $SubFileName
 * @property string $SubActualCD
 * @property string $SubSize
 * @property string $SubHash
 * @property string $IDSubtitle
 * @property string $UserID
 * @property string $SubLanguageID
 * @property string $SubFormat
 * @property string $SubSumCD
 * @property string $SubAuthorComment
 * @property string $SubAddDate
 * @property string $SubBad
 * @property string $SubRating
 * @property string $SubDownloadsCnt
 * @property string $MovieReleaseName
 * @property string $IDMovie
 * @property string $IDMovieImdb
 * @property string $MovieName
 * @property string $MovieNameEng
 * @property string $MovieYear
 * @property string $MovieImdbRating
 * @property string $SubFeatured
 * @property string $UserNickName
 * @property string $ISO639
 * @property string $LanguageName
 * @property string $SubComments
 * @property string $SubHearingImpaired
 * @property string $UserRank
 * @property string $SeriesSeason
 * @property string $SeriesEpisode
 * @property string $MovieKind
 * @property string $QueryNumber
 * @property string $SubDownloadLink
 * @property string $ZipDownloadLink
 * @property string $SubtitlesLink
 * @property string $Id_user
 *
 * The followings are the available model relations:
 * @property User $idUser
 */
class OpenSubtitle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OpenSubtitle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'open_subtitle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_user', 'required'),
			array('MatchedBy, IDSubMovieFile, MovieHash, MovieByteSize, MovieTimeMS, IDSubtitleFile, SubActualCD, SubSize, IDSubtitle, UserID, SubLanguageID, SubFormat, SubSumCD, SubAuthorComment, SubAddDate, SubBad, SubRating, SubDownloadsCnt, MovieReleaseName, IDMovie, IDMovieImdb, MovieYear, MovieImdbRating, SubFeatured, UserNickName, ISO639, LanguageName, SubComments, SubHearingImpaired, UserRank, SeriesSeason, SeriesEpisode, MovieKind, QueryNumber', 'length', 'max'=>45),
			array('SubFileName, SubHash', 'length', 'max'=>100),
			array('MovieName, MovieNameEng, SubDownloadLink, ZipDownloadLink, SubtitlesLink', 'length', 'max'=>255),
			array('Id_user', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, MatchedBy, IDSubMovieFile, MovieHash, MovieByteSize, MovieTimeMS, IDSubtitleFile, SubFileName, SubActualCD, SubSize, SubHash, IDSubtitle, UserID, SubLanguageID, SubFormat, SubSumCD, SubAuthorComment, SubAddDate, SubBad, SubRating, SubDownloadsCnt, MovieReleaseName, IDMovie, IDMovieImdb, MovieName, MovieNameEng, MovieYear, MovieImdbRating, SubFeatured, UserNickName, ISO639, LanguageName, SubComments, SubHearingImpaired, UserRank, SeriesSeason, SeriesEpisode, MovieKind, QueryNumber, SubDownloadLink, ZipDownloadLink, SubtitlesLink, Id_user', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idUser' => array(self::BELONGS_TO, 'User', 'Id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'MatchedBy' => 'Matched By',
			'IDSubMovieFile' => 'Idsub Movie File',
			'MovieHash' => 'Movie Hash',
			'MovieByteSize' => 'Movie Byte Size',
			'MovieTimeMS' => 'Movie Time Ms',
			'IDSubtitleFile' => 'Idsubtitle File',
			'SubFileName' => 'Sub File Name',
			'SubActualCD' => 'Sub Actual Cd',
			'SubSize' => 'Sub Size',
			'SubHash' => 'Sub Hash',
			'IDSubtitle' => 'Idsubtitle',
			'UserID' => 'User',
			'SubLanguageID' => 'Sub Language',
			'SubFormat' => 'Sub Format',
			'SubSumCD' => 'Sub Sum Cd',
			'SubAuthorComment' => 'Sub Author Comment',
			'SubAddDate' => 'Sub Add Date',
			'SubBad' => 'Sub Bad',
			'SubRating' => 'Sub Rating',
			'SubDownloadsCnt' => 'Sub Downloads Cnt',
			'MovieReleaseName' => 'Movie Release Name',
			'IDMovie' => 'Idmovie',
			'IDMovieImdb' => 'Idmovie Imdb',
			'MovieName' => 'Movie Name',
			'MovieNameEng' => 'Movie Name Eng',
			'MovieYear' => 'Movie Year',
			'MovieImdbRating' => 'Movie Imdb Rating',
			'SubFeatured' => 'Sub Featured',
			'UserNickName' => 'User Nick Name',
			'ISO639' => 'Iso639',
			'LanguageName' => 'Language Name',
			'SubComments' => 'Sub Comments',
			'SubHearingImpaired' => 'Sub Hearing Impaired',
			'UserRank' => 'User Rank',
			'SeriesSeason' => 'Series Season',
			'SeriesEpisode' => 'Series Episode',
			'MovieKind' => 'Movie Kind',
			'QueryNumber' => 'Query Number',
			'SubDownloadLink' => 'Sub Download Link',
			'ZipDownloadLink' => 'Zip Download Link',
			'SubtitlesLink' => 'Subtitles Link',
			'Id_user' => 'Id User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('MatchedBy',$this->MatchedBy,true);
		$criteria->compare('IDSubMovieFile',$this->IDSubMovieFile,true);
		$criteria->compare('MovieHash',$this->MovieHash,true);
		$criteria->compare('MovieByteSize',$this->MovieByteSize,true);
		$criteria->compare('MovieTimeMS',$this->MovieTimeMS,true);
		$criteria->compare('IDSubtitleFile',$this->IDSubtitleFile,true);
		$criteria->compare('SubFileName',$this->SubFileName,true);
		$criteria->compare('SubActualCD',$this->SubActualCD,true);
		$criteria->compare('SubSize',$this->SubSize,true);
		$criteria->compare('SubHash',$this->SubHash,true);
		$criteria->compare('IDSubtitle',$this->IDSubtitle,true);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('SubLanguageID',$this->SubLanguageID,true);
		$criteria->compare('SubFormat',$this->SubFormat,true);
		$criteria->compare('SubSumCD',$this->SubSumCD,true);
		$criteria->compare('SubAuthorComment',$this->SubAuthorComment,true);
		$criteria->compare('SubAddDate',$this->SubAddDate,true);
		$criteria->compare('SubBad',$this->SubBad,true);
		$criteria->compare('SubRating',$this->SubRating,true);
		$criteria->compare('SubDownloadsCnt',$this->SubDownloadsCnt,true);
		$criteria->compare('MovieReleaseName',$this->MovieReleaseName,true);
		$criteria->compare('IDMovie',$this->IDMovie,true);
		$criteria->compare('IDMovieImdb',$this->IDMovieImdb,true);
		$criteria->compare('MovieName',$this->MovieName,true);
		$criteria->compare('MovieNameEng',$this->MovieNameEng,true);
		$criteria->compare('MovieYear',$this->MovieYear,true);
		$criteria->compare('MovieImdbRating',$this->MovieImdbRating,true);
		$criteria->compare('SubFeatured',$this->SubFeatured,true);
		$criteria->compare('UserNickName',$this->UserNickName,true);
		$criteria->compare('ISO639',$this->ISO639,true);
		$criteria->compare('LanguageName',$this->LanguageName,true);
		$criteria->compare('SubComments',$this->SubComments,true);
		$criteria->compare('SubHearingImpaired',$this->SubHearingImpaired,true);
		$criteria->compare('UserRank',$this->UserRank,true);
		$criteria->compare('SeriesSeason',$this->SeriesSeason,true);
		$criteria->compare('SeriesEpisode',$this->SeriesEpisode,true);
		$criteria->compare('MovieKind',$this->MovieKind,true);
		$criteria->compare('QueryNumber',$this->QueryNumber,true);
		$criteria->compare('SubDownloadLink',$this->SubDownloadLink,true);
		$criteria->compare('ZipDownloadLink',$this->ZipDownloadLink,true);
		$criteria->compare('SubtitlesLink',$this->SubtitlesLink,true);
		$criteria->compare('Id_user',$this->Id_user,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}