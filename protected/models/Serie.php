<?php

/**
 * This is the model class for table "serie".
 *
 * The followings are the available columns in table 'serie':
 * @property integer $Id
 * @property integer $Id_tmdb
 * @property integer $year
 * @property string $first_air_date
 * @property string $last_air_date
 * @property string $title
 * @property string $original_title
 * @property string $created_by
 * @property string $origin_country
 * @property string $genre
 * @property string $overview
 * @property string $status
 * @property string $network
 * @property string $rating
 * @property string $poster
 * @property string $poster_original
 * @property string $backdrop
 * @property string $backdrop_original
 */
class Serie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'serie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_tmdb, year', 'numerical', 'integerOnly'=>true),
			array('first_air_date, last_air_date, status', 'length', 'max'=>45),
			array('title, original_title, origin_country', 'length', 'max'=>100),
			array('created_by, genre, network, poster, poster_original, backdrop, backdrop_original', 'length', 'max'=>255),
			array('rating', 'length', 'max'=>10),
			array('overview', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_tmdb, year, first_air_date, last_air_date, title, original_title, created_by, origin_country, genre, overview, status, network, rating, poster, poster_original, backdrop, backdrop_original', 'safe', 'on'=>'search'),
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
			'year' => 'Year',
			'first_air_date' => 'First Air Date',
			'last_air_date' => 'Last Air Date',
			'title' => 'Title',
			'original_title' => 'Original Title',
			'created_by' => 'Created By',
			'origin_country' => 'Origin Country',
			'genre' => 'Genre',
			'overview' => 'Overview',
			'status' => 'Status',
			'network' => 'Network',
			'rating' => 'Rating',
			'poster' => 'Poster',
			'poster_original' => 'Poster Original',
			'backdrop' => 'Backdrop',
			'backdrop_original' => 'Backdrop Original',
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
		$criteria->compare('year',$this->year);
		$criteria->compare('first_air_date',$this->first_air_date,true);
		$criteria->compare('last_air_date',$this->last_air_date,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('original_title',$this->original_title,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('origin_country',$this->origin_country,true);
		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('overview',$this->overview,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('network',$this->network,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('poster_original',$this->poster_original,true);
		$criteria->compare('backdrop',$this->backdrop,true);
		$criteria->compare('backdrop_original',$this->backdrop_original,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Serie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
