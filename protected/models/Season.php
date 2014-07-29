<?php

/**
 * This is the model class for table "season".
 *
 * The followings are the available columns in table 'season':
 * @property integer $Id
 * @property integer $Id_tmdb
 * @property string $air_date
 * @property string $title
 * @property string $overview
 * @property integer $number
 * @property string $poster
 * @property string $poster_original
 * @property integer $Id_Serie
 */
class Season extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Serie', 'required'),
			array('Id_tmdb, number, Id_Serie', 'numerical', 'integerOnly'=>true),
			array('air_date', 'length', 'max'=>45),
			array('title', 'length', 'max'=>100),
			array('poster, poster_original', 'length', 'max'=>255),
			array('overview', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_tmdb, air_date, title, overview, number, poster, poster_original, Id_Serie', 'safe', 'on'=>'search'),
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
			'serie' => array(self::BELONGS_TO, 'Serie', 'Id_serie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_tmdb' => 'Id Tmdb',
			'air_date' => 'Air Date',
			'title' => 'Title',
			'overview' => 'Overview',
			'number' => 'Number',
			'poster' => 'Poster',
			'poster_original' => 'Poster Original',
			'Id_Serie' => 'Id Serie',
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
		$criteria->compare('Id_tmdb',$this->Id_tmdb);
		$criteria->compare('air_date',$this->air_date,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('overview',$this->overview,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('poster_original',$this->poster_original,true);
		$criteria->compare('Id_Serie',$this->Id_Serie);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Season the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
