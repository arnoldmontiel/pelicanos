<?php

/**
 * This is the model class for table "my_movie_disc_my_movie_episode".
 *
 * The followings are the available columns in table 'my_movie_disc_my_movie_episode':
 * @property integer $Id_my_movie_episode
 * @property string $Id_my_movie_disc
 */
class MyMovieDiscMyMovieEpisode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieDiscMyMovieEpisode the static model class
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
		return 'my_movie_disc_my_movie_episode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_episode, Id_my_movie_disc', 'required'),
			array('Id_my_movie_episode', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_episode, Id_my_movie_disc', 'safe', 'on'=>'search'),
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
			'myMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
			'myMovieEpisode' => array(self::BELONGS_TO, 'MyMovieEpisode', 'Id_my_movie_episode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_episode' => 'Id My Movie Episode',
			'Id_my_movie_disc' => 'Id My Movie Disc',
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

		$criteria->compare('Id_my_movie_episode',$this->Id_my_movie_episode);
		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}