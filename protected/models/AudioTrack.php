<?php

/**
 * This is the model class for table "audio_track".
 *
 * The followings are the available columns in table 'audio_track':
 * @property integer $Id
 * @property string $language
 * @property string $type
 * @property string $chanel
 * @property string $short_language
 * @property string $short_type
 * @property string $type_extra
 *
 * The followings are the available model relations:
 * @property AutoRipperFileAudioTrack[] $autoRipperFileAudioTracks
 * @property MyMovie[] $myMovies
 * @property MyMovieNzb[] $myMovieNzbs
 */
class AudioTrack extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'audio_track';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, type, type_extra', 'length', 'max'=>45),
			array('chanel', 'length', 'max'=>10),
			array('short_language, short_type', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, language, type, chanel, short_language, short_type, type_extra', 'safe', 'on'=>'search'),
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
			'autoRipperFileAudioTracks' => array(self::HAS_MANY, 'AutoRipperFileAudioTrack', 'Id_audio_track'),
			'myMovies' => array(self::MANY_MANY, 'MyMovie', 'my_movie_audio_track(Id_audio_track, Id_my_movie)'),
			'myMovieNzbs' => array(self::MANY_MANY, 'MyMovieNzb', 'my_movie_nzb_audio_track(Id_audio_track, Id_my_movie_nzb)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'language' => 'Language',
			'type' => 'Type',
			'chanel' => 'Chanel',
			'short_language' => 'Short Language',
			'short_type' => 'Short Type',
			'type_extra' => 'Type Extra',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('chanel',$this->chanel,true);
		$criteria->compare('short_language',$this->short_language,true);
		$criteria->compare('short_type',$this->short_type,true);
		$criteria->compare('type_extra',$this->type_extra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AudioTrack the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
