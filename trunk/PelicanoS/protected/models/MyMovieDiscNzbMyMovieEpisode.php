<?php

/**
 * This is the model class for table "my_movie_disc_nzb_my_movie_episode".
 *
 * The followings are the available columns in table 'my_movie_disc_nzb_my_movie_episode':
 * @property string $Id_my_movie_disc_nzb
 * @property integer $Id_my_movie_episode
 */
class MyMovieDiscNzbMyMovieEpisode extends CActiveRecord
{
	public $episode_number;
	public $episode_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieDiscNzbMyMovieEpisode the static model class
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
		return 'my_movie_disc_nzb_my_movie_episode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_disc_nzb, Id_my_movie_episode', 'required'),
			array('Id_my_movie_episode', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_disc_nzb, Id_my_movie_episode, episode_number, episode_name', 'safe', 'on'=>'search'),
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
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'myMovieEpisode' => array(self::BELONGS_TO, 'MyMovieEpisode', 'Id_my_movie_episode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
			'Id_my_movie_episode' => 'Id My Movie Episode',
			'episode_number'=>'Number', 
			'episode_name'=>'Name',
		
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

		$criteria->compare('Id_my_movie_disc_nzb',$this->Id_my_movie_disc_nzb,true);
		$criteria->compare('Id_my_movie_episode',$this->Id_my_movie_episode);

		$criteria->with[]='myMovieEpisode';
		$criteria->addSearchCondition("myMovieEpisode.episode_number",$this->episode_number);
		$criteria->addSearchCondition("myMovieEpisode.name",$this->episode_name);
		
		$sort=new CSort;
		$sort->attributes=array(
				    'episode_number' => array(
					        'asc' => 'myMovieEpisode.episode_number',
					        'desc' => 'myMovieEpisode.episode_number DESC',
					),
					'episode_name' => array(
							'asc' => 'myMovieEpisode.name',
							'desc' => 'myMovieEpisode.name DESC',
					),
				'*',
		);
		
		return new CActiveDataProvider($this, array(
											'criteria'=>$criteria,
											'sort'=>$sort,
		));
	}
}