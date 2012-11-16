<?php

/**
 * This is the model class for table "my_movie_episode".
 *
 * The followings are the available columns in table 'my_movie_episode':
 * @property integer $Id
 * @property integer $Id_my_movie_season
 * @property integer $episode_number
 * @property string $description
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MyMovieDisc[] $myMovieDiscs
 * @property MyMovieDiscNzb[] $myMovieDiscNzbs
 * @property MyMovieSeason $idMyMovieSeason
 */
class MyMovieEpisode extends CActiveRecord
{
	public $serie_name;
	public $season_number;
	public $max_episode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieEpisode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	* Set model attributes by array
	* @param Nab $model
	*/
	public function setAttributesByArray($array)
	{
		$attributesArray = get_object_vars($array);
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'my_movie_episode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_season, episode_number, name', 'required'),
			array('Id_my_movie_season, episode_number', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_season, episode_number, description, name, serie_name, season_number', 'safe', 'on'=>'search'),
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
			'myMovieDiscs' => array(self::MANY_MANY, 'MyMovieDisc', 'my_movie_disc_my_movie_episode(Id_my_movie_episode, Id_my_movie_disc)'),
			'myMovieDiscNzbs' => array(self::MANY_MANY, 'MyMovieDiscNzb', 'my_movie_disc_nzb_my_movie_episode(Id_my_movie_episode, Id_my_movie_disc_nzb)'),
			'myMovieSeason' => array(self::BELONGS_TO, 'MyMovieSeason', 'Id_my_movie_season'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_season' => 'Id My Movie Season',
			'episode_number' => 'Episode Number',
			'description' => 'Description',
			'name' => 'Name',
			'serie_name'=>'Serie',
			'season_number'=>'Season Number',
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
		$criteria->compare('Id_my_movie_season',$this->Id_my_movie_season);
		$criteria->compare('episode_number',$this->episode_number);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);

		$criteria->join =	"LEFT OUTER JOIN my_movie_season sea ON sea.Id=t.Id_my_movie_season
									LEFT OUTER JOIN my_movie_serie_header sh ON sh.Id = sea.Id_my_movie_serie_header";
		$criteria->addSearchCondition("sea.season_number",$this->season_number);
		$criteria->addSearchCondition("sh.name",$this->serie_name);
		
		$sort=new CSort;
		$sort->attributes=array(
				'episode_number',
				'description',
				'name',
				'season_number' => array(
						'asc' => 'sea.season_number',
						'desc' => 'sea.season_number DESC',
				),
				'serie_name' => array(
						'asc' => 'sh.name',
						'desc' => 'sh.name DESC',
				),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
}