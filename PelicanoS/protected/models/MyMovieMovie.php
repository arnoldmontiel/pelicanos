<?php

/**
 * This is the model class for table "my_movie_movie".
 *
 * The followings are the available columns in table 'my_movie_movie':
 * @property string $Id
 * @property integer $Id_parental_control
 * @property string $local_title
 * @property string $original_title
 * @property string $sort_title
 * @property string $production_year
 * @property string $running_time
 * @property string $description
 * @property string $parental_rating_desc
 * @property string $imdb
 * @property string $rating
 * @property string $rating_votes
 * @property string $genre
 * @property string $studio
 * @property string $poster_original
 * @property string $poster
 * @property string $backdrop_original
 * @property string $backdrop
 * @property integer $adult
 *
 * The followings are the available model relations:
 * @property ParentalControl $idParentalControl
 */
class MyMovieMovie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieMovie the static model class
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
		return 'my_movie_movie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_parental_control', 'required'),
			array('Id_parental_control, adult', 'numerical', 'integerOnly'=>true),
			array('Id', 'length', 'max'=>200),
			array('local_title, original_title, sort_title, rating_votes', 'length', 'max'=>100),
			array('production_year, running_time, imdb', 'length', 'max'=>45),
			array('parental_rating_desc, genre, studio, poster_original, poster, backdrop_original, backdrop', 'length', 'max'=>255),
			array('rating', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_parental_control, local_title, original_title, sort_title, production_year, running_time, description, parental_rating_desc, imdb, rating, rating_votes, genre, studio, poster_original, poster, backdrop_original, backdrop, adult', 'safe', 'on'=>'search'),
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
			'idParentalControl' => array(self::BELONGS_TO, 'ParentalControl', 'Id_parental_control'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_parental_control' => 'Id Parental Control',
			'local_title' => 'Local Title',
			'original_title' => 'Original Title',
			'sort_title' => 'Sort Title',
			'production_year' => 'Production Year',
			'running_time' => 'Running Time',
			'description' => 'Description',
			'parental_rating_desc' => 'Parental Rating Desc',
			'imdb' => 'Imdb',
			'rating' => 'Rating',
			'rating_votes' => 'Rating Votes',
			'genre' => 'Genre',
			'studio' => 'Studio',
			'poster_original' => 'Poster Original',
			'poster' => 'Poster',
			'backdrop_original' => 'Backdrop Original',
			'backdrop' => 'Backdrop',
			'adult' => 'Adult',
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

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('Id_parental_control',$this->Id_parental_control);
		$criteria->compare('local_title',$this->local_title,true);
		$criteria->compare('original_title',$this->original_title,true);
		$criteria->compare('sort_title',$this->sort_title,true);
		$criteria->compare('production_year',$this->production_year,true);
		$criteria->compare('running_time',$this->running_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('parental_rating_desc',$this->parental_rating_desc,true);
		$criteria->compare('imdb',$this->imdb,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('rating_votes',$this->rating_votes,true);
		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('studio',$this->studio,true);
		$criteria->compare('poster_original',$this->poster_original,true);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('backdrop_original',$this->backdrop_original,true);
		$criteria->compare('backdrop',$this->backdrop,true);
		$criteria->compare('adult',$this->adult);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}