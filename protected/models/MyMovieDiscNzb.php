<?php

/**
 * This is the model class for table "my_movie_disc_nzb".
 *
 * The followings are the available columns in table 'my_movie_disc_nzb':
 * @property string $Id
 * @property string $name
 * @property string $Id_my_movie_nzb
 *
 * The followings are the available model relations:
 * @property MyMovieNzb $idMyMovieNzb
 * @property Nzb[] $nzbs
 */
class MyMovieDiscNzb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieDiscNzb the static model class
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
		return 'my_movie_disc_nzb';
	}

	public function getSeason()
	{
		if($this->myMovieNzb->is_serie)
		{
			$relation = MyMovieDiscNzbMyMovieEpisode::model()->findByAttributes(array(
															'Id_my_movie_disc_nzb'=>$this->Id,
														));
			if(isset($relation))
			{
				return $relation->myMovieEpisode->Id_my_movie_season;
			}
		}
		return null;	
	}
	
	public function getSeasonNumber()
	{
		$id = $this->getSeason();
		if(isset($id))
		{
			$model = MyMovieSeason::model()->findByPk($id);
			
			if(isset($model))
			{
				return $model->season_number;
			}
		}
		return null;
	}
	
	public function getEpisodes()
	{
		if($this->myMovieNzb->is_serie)
		{
			$array = MyMovieDiscNzbMyMovieEpisode::model()->findAllByAttributes(array(
															'Id_my_movie_disc_nzb'=>$this->Id,
														));
			if(isset($array))
			{
				$episodes = array();
				foreach($array as $item)
				{
					$episodes[] = $item->myMovieEpisode->episode_number;
				}
				return implode(',',$episodes);
			}
		}
		return null;	
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_my_movie_nzb', 'required'),
			array('Id, Id_my_movie_nzb', 'length', 'max'=>200),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, Id_my_movie_nzb', 'safe', 'on'=>'search'),
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
			'myMovieNzb' => array(self::BELONGS_TO, 'MyMovieNzb', 'Id_my_movie_nzb'),
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_my_movie_disc_nzb'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'name' => 'Disc Name',
			'Id_my_movie_nzb' => 'Id My Movie Nzb',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('Id_my_movie_nzb',$this->Id_my_movie_nzb,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}