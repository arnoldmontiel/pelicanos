<?php

/**
 * This is the model class for table "subtitle".
 *
 * The followings are the available columns in table 'subtitle':
 * @property integer $Id
 * @property string $language
 * @property string $codec
 * @property integer $forced
 *
 * The followings are the available model relations:
 * @property AutoRipperFile[] $autoRipperFiles
 * @property MyMovieNzb[] $myMovieNzbs
 * @property MyMovie[] $myMovies
 */
class Subtitle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subtitle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('forced', 'numerical', 'integerOnly'=>true),
			array('language, codec', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, language, forced, codec', 'safe', 'on'=>'search'),
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
			'autoRipperFiles' => array(self::MANY_MANY, 'AutoRipperFile', 'auto_ripper_file_subtitle(Id_subtitle, Id_auto_ripper_file)'),
			'myMovieNzbs' => array(self::MANY_MANY, 'MyMovieNzb', 'my_movie_nzb_subtitle(Id_subtitle, Id_my_movie_nzb)'),
			'myMovies' => array(self::MANY_MANY, 'MyMovie', 'my_movie_subtitle(Id_subtitle, Id_my_movie)'),
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
			'short_language' => 'Short Language',
			'description' => 'Description',
			'type' => 'Type',
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
		$criteria->compare('codec',$this->codec,true);
		$criteria->compare('forced',$this->forced,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subtitle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
