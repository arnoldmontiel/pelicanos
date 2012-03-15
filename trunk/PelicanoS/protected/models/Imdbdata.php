<?php

/**
 * This is the model class for table "imdbdata".
 *
 * The followings are the available columns in table 'imdbdata':
 * @property string $ID
 * @property string $Title
 * @property integer $Year
 * @property string $Rated
 * @property string $Released
 * @property string $Genre
 * @property string $Director
 * @property string $Writer
 * @property string $Actors
 * @property string $Plot
 * @property string $Poster
 * @property string $Runtime
 * @property double $Rating
 * @property string $Votes
 * @property string $Response
 * @property string $Backdrop
 * The followings are the available model relations:
 * @property Nzb[] $nzbs
 */
class Imdbdata extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Imdbdata the static model class
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
		return 'imdbdata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, Title', 'required'),
			array('ID, Rated, Released, Runtime, Votes, Response, Year, Rating', 'length', 'max'=>45),
			array('Title, Director, Writer, Poster, Genre, Backdrop', 'length', 'max'=>255),
			array('Actors, Plot', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Title, Year, Rated, Released, Genre, Director, Writer, Actors, Plot, Poster, Runtime, Rating, Votes, Response, Backdrop', 'safe', 'on'=>'search'),
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
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_imdbdata'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Title' => 'Title',
			'Year' => 'Year',
			'Rated' => 'Rated',
			'Released' => 'Released',
			'Genre' => 'Genre',
			'Director' => 'Director',
			'Writer' => 'Writer',
			'Actors' => 'Actors',
			'Plot' => 'Plot',
			'Poster' => 'Poster',
			'Runtime' => 'Runtime',
			'Rating' => 'Rating',
			'Votes' => 'Votes',
			'Response' => 'Response',
			'Backdrop' => 'Backdrop',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Year',$this->Year);
		$criteria->compare('Rated',$this->Rated,true);
		$criteria->compare('Released',$this->Released,true);
		$criteria->compare('Genre',$this->Genre,true);
		$criteria->compare('Director',$this->Director,true);
		$criteria->compare('Writer',$this->Writer,true);
		$criteria->compare('Actors',$this->Actors,true);
		$criteria->compare('Plot',$this->Plot,true);
		$criteria->compare('Poster',$this->Poster,true);
		$criteria->compare('Runtime',$this->Runtime,true);
		$criteria->compare('Rating',$this->Rating);
		$criteria->compare('Votes',$this->Votes,true);
		$criteria->compare('Response',$this->Response,true);
		$criteria->compare('Backdrop',$this->Backdrop,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}