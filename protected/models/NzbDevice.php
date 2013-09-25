<?php

/**
 * This is the model class for table "nzb_device".
 *
 * The followings are the available columns in table 'nzb_device':
 * @property integer $Id_nzb
 * @property string $Id_device
 * @property integer $need_update
 * @property string $date_sent
 * @property string $date_downloading
 * @property string $date_downloaded
 * @property integer $Id_nzb_state
 */
class NzbDevice extends CActiveRecord
{
	public $title;
	public $year;
	public $genre;
	public $nzb_status;
	public $id_imdb;
	public $episode;
	public $season;
	public $serie_title;
	public $Id_customer;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NzbDevice the static model class
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
		return 'nzb_device';
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
			array('Id_nzb, need_update, Id_nzb_state', 'numerical', 'integerOnly'=>true),
			array('Id_device', 'length', 'max'=>45),
			array('date_sent, date_downloading, date_downloaded', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_nzb, Id_device, need_update, date_sent, date_downloading, date_downloaded, Id_nzb_state, title, year, genre, nzb_status, id_imdb, episode, season, serie_title, Id_customer', 'safe', 'on'=>'search'),			
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
			'device' => array(self::BELONGS_TO, 'Device', 'Id_device'),
			'nzbState' => array(self::BELONGS_TO, 'NzbState', 'Id_nzb_state'),

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
			'date_sent' => 'Date Sent',
			'date_downloading' => 'Date Downloading',
			'date_downloaded' => 'Date Downloaded',
			'Id_nzb_state' => 'Id Nzb State',
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
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('date_downloading',$this->date_downloading,true);
		$criteria->compare('date_downloaded',$this->date_downloaded,true);
		$criteria->compare('Id_nzb_state',$this->Id_nzb_state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchSummary()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_device',$this->Id_device);
		$criteria->compare('need_update',$this->need_update);
		$criteria->compare('Id_nzb_state',$this->Id_nzb_state);
		$criteria->compare('date_sent',$this->date_sent);
		$criteria->compare('date_downloaded',$this->date_downloaded);
		$criteria->compare('date_downloading',$this->date_downloading);
	
		$criteria->with[]='nzbState';
		$criteria->addSearchCondition("nzbState.description",$this->nzb_status);
	
		$criteria->join =	"LEFT OUTER JOIN nzb n ON n.Id=t.Id_nzb
								LEFT OUTER JOIN customer_device cd ON cd.Id_device = t.Id_device
								LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = n.Id_my_movie_disc_nzb
								LEFT OUTER JOIN my_movie_nzb i ON dn.Id_my_movie_nzb=i.Id";
		$criteria->addSearchCondition("i.original_title",$this->title);
		$criteria->addSearchCondition("i.production_year",$this->year);
		$criteria->addSearchCondition("i.genre",$this->genre);
		$criteria->addSearchCondition("i.imdb",$this->id_imdb);
		$criteria->addSearchCondition("cd.Id_customer",$this->Id_customer);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
						'nzb_status' => array(
							        'asc' => 'nzbState.description',
							        'desc' => 'nzbState.description DESC',
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
						'Id_nzb_state DESC, date_downloaded DESC, date_downloading DESC, date_sent DESC';
	
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