<?php

/**
 * This is the model class for table "nzb_customer".
 *
 * The followings are the available columns in table 'nzb_customer':
 * @property integer $Id_nzb
 * @property integer $Id_device
 * @property integer $need_update
 * @property integer $Id_movie_state
 * @property string $date_sent
 * @property string $date_downloaded
 * @property string $date_downloading
 */
class NzbCustomer extends CActiveRecord
{
	public $title;
	public $year;
	public $genre;
	public $movie_status;
	public $id_imdb;
	public $episode;
	public $season;
	public $serie_title;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NzbCustomer the static model class
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
		return 'nzb_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_nzb, Id_device', 'required'),
			array('Id_nzb, need_update, Id_movie_state', 'numerical', 'integerOnly'=>true),
			array('date_sent, date_downloaded, date_downloading', 'safe'),
			array('Id_device', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_nzb, Id_device, need_update, Id_movie_state, title, year, genre, movie_status, id_imdb, date_sent, date_downloaded, date_downloading, episode, season, serie_title', 'safe', 'on'=>'search'),
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
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),			
			'movieState' => array(self::BELONGS_TO, 'MovieState', 'Id_movie_state'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_nzb' => 'Id Nzb',
			'Id_device' => 'Id Device',
			'need_update' => 'Need Update',
			'Id_movie_state' => 'Id Movie State',
			'date_sent' => 'Date Sent',
			'date_downloaded' => 'Date Downloaded',
			'date_downloading' => 'Date Downloading',
			'serie_title' => 'Serie Title',
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

		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('need_update',$this->need_update);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date_sent',$this->date_sent);
		$criteria->compare('date_downloaded',$this->date_downloaded);
		$criteria->compare('date_downloading',$this->date_downloading);
		$criteria->order = "Id_movie_state DESC";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchRelationSeries()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_device',$this->Id_device);
		$criteria->compare('need_update',$this->need_update);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date_sent',$this->date_sent);
		$criteria->compare('date_downloaded',$this->date_downloaded);
		$criteria->compare('date_downloading',$this->date_downloading);
		
		$criteria->with[]='movieState';
		$criteria->addSearchCondition("movieState.description",$this->movie_status);
		
		$criteria->join =	"LEFT OUTER JOIN nzb n ON n.Id=t.Id_nzb
									 LEFT OUTER JOIN imdbdata_tv i ON n.Id_imdbdata_tv=i.ID
									 LEFT OUTER JOIN imdbdata_tv p ON p.ID=i.Id_parent";
		$criteria->addSearchCondition("i.Title",$this->title);
		$criteria->addSearchCondition("i.Year",$this->year);
		$criteria->addSearchCondition("i.Genre",$this->genre);
		$criteria->addSearchCondition("i.ID",$this->id_imdb);
		$criteria->addSearchCondition("i.Season",$this->season);
		$criteria->addSearchCondition("i.Episode",$this->episode);
		$criteria->addSearchCondition("p.Title",$this->serie_title);
		$criteria->addCondition('n.Id_imdbdata is null');
		
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
			'movie_status' => array(
				        'asc' => 'movieState.description',
				        'desc' => 'movieState.description DESC',
			),
			'title'=> array(
						'asc'=>'i.Title',
						'desc'=>'i.Title DESC'
			),
			'serie_title'=> array(
						'asc'=>'p.Title',
						'desc'=>'p.Title DESC'
			),
			'episode'=> array(
						'asc'=>'i.Episode',
						'desc'=>'i.Episode DESC'
			),
			'season'=> array(
						'asc'=>'i.Season',
						'desc'=>'i.Season DESC'
			),
			'year'=> array(
						'asc'=>'i.Year',
						'desc'=>'i.Year DESC'
			),
			'genre'=> array(
						'asc'=>'i.Genre',
						'desc'=>'i.Genre DESC'
			),
			'id_imdb'=> array(
						'asc'=>'i.ID',
						'desc'=>'i.ID DESC'
			),
		
			'*',
		);
	
		$sort->defaultOrder =
			'Id_movie_state DESC, date_downloaded DESC, date_downloading DESC, date_sent DESC';
		
		return new CActiveDataProvider($this, array(
										'criteria'=>$criteria,
										'sort'=>$sort,
		));
	}
	
	public function searchRelationMovies()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_device',$this->Id_device);
		$criteria->compare('need_update',$this->need_update);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date_sent',$this->date_sent);
		$criteria->compare('date_downloaded',$this->date_downloaded);
		$criteria->compare('date_downloading',$this->date_downloading);
	
		$criteria->with[]='movieState';
		$criteria->addSearchCondition("movieState.description",$this->movie_status);
	
		$criteria->join =	"LEFT OUTER JOIN nzb n ON n.Id=t.Id_nzb
										 LEFT OUTER JOIN my_movie_movie i ON n.Id_my_movie_movie=i.Id";
		$criteria->addSearchCondition("i.original_title",$this->title);
		$criteria->addSearchCondition("i.production_year",$this->year);
		$criteria->addSearchCondition("i.genre",$this->genre);
		$criteria->addSearchCondition("i.imdb",$this->id_imdb);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				'movie_status' => array(
					        'asc' => 'movieState.description',
					        'desc' => 'movieState.description DESC',
		),
				'title'=> array(
							'asc'=>'i.original_title',
							'desc'=>'i.original_title DESC'
		),
				'year'=> array(
							'asc'=>'i.production_year',
							'desc'=>'i.production_year DESC'
		),
				'genre'=> array(
							'asc'=>'i.genre',
							'desc'=>'i.genre DESC'
		),
				'id_imdb'=> array(
							'asc'=>'i.imdb',
							'desc'=>'i.imdb DESC'
		),
	
				'*',
		);
	
		$sort->defaultOrder =
				'Id_movie_state DESC, date_downloaded DESC, date_downloading DESC, date_sent DESC';
	
		return new CActiveDataProvider($this, array(
											'criteria'=>$criteria,
											'sort'=>$sort,
		));
	}
}