<?php

/**
 * This is the model class for table "nzb".
 *
 * The followings are the available columns in table 'nzb':
 * @property integer $Id
 * @property string $url
 * @property string $file_name
 * @property string $subt_url
 * @property string $subt_file_name
 * @property string $subt_original_name
 * @property integer $Id_resource_type
 * @property integer $deleted
 * @property integer $points
 * @property string $file_original_name
 * @property string $Id_my_movie_movie
 *
 * The followings are the available model relations:
 * @property CustomerTransaction[] $customerTransactions
 * @property MyMovieMovie $myMovieMovie
 * @property Reseller $idReseller
 * @property ResourceType $resourceType
 * @property Customer[] $customers
 */
class Nzb extends CActiveRecord
{
	public $title;
	public $year;
	public $idImdb;
	public $genre;
	public $resourceTypeDesc;
	public $serie_title;
	public $episode;
	public $season;
	public $deleted_serie;
	
	public function beforeSave()
	{
		if($this->points == null)
			$this->points = 0;
		
		return parent::beforeSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nzb the static model class
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
		return 'nzb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' Id_resource_type, Id_my_movie_movie', 'required'),
			array('Id_resource_type, deleted, points, is_draft', 'numerical', 'integerOnly'=>true),
			array('url, subt_url, file_name, subt_file_name, subt_original_name, file_original_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, url, file_name, subt_url, subt_file_name, title, year, idImdb, genre, subt_original_name, resourceTypeDesc, Id_resource_type, deleted, serie_title, season, episode, points, deleted_serie, file_original_name, Id_my_movie_movie, is_draft', 'safe', 'on'=>'search'),
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
			'resourceType' => array(self::BELONGS_TO, 'ResourceType', 'Id_resource_type'),
			'myMovieMovie' => array(self::BELONGS_TO, 'MyMovieMovie', 'Id_my_movie_movie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'url' => 'Url',
			'file_name' => 'File Name',
			'subt_url' => 'Subt Url',
			'subt_file_name' => 'Subt File Name',
			'subt_original_name' => 'Subt Original Name',
			'Id_resource_type' => 'Resource Type',
			'deleted' => 'Deleted',
			'points' => 'Points',
			'deleted_serie' => 'Deleted from Header',
			'file_original_name' => 'File Original Name',
			'Id_my_movie_movie' => 'Id_my_movie_movie',
			'is_draft' => 'Is Draft',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('file_original_name',$this->file_original_name,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchNzbMovies()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('is_draft',$this->is_draft,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('file_original_name',$this->file_original_name,true);
		
		
		$criteria->with[]='myMovieMovie';
		$criteria->addSearchCondition("myMovieMovie.original_title",$this->title);
		$criteria->addSearchCondition("myMovieMovie.production_year",$this->year);
		$criteria->addSearchCondition("myMovieMovie.imdb",$this->idImdb);
		$criteria->addSearchCondition("myMovieMovie.genre",$this->genre);
		
		
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
			'Id',
			'url',
			'is_draft',
			'title' => array(
				        'asc' => 'myMovieMovie.original_title',
				        'desc' => 'myMovieMovie.original_title DESC',
			),
			'year' => array(
				        'asc' => 'myMovieMovie.production_year',
				        'desc' => 'myMovieMovie.production_year DESC',
			),
			'idImdb' => array(
				        'asc' => 'myMovieMovie.imdb',
				        'desc' => 'myMovieMovie.imdb DESC',
			),
			'genre' => array(
				        'asc' => 'myMovieMovie.genre',
				        'desc' => 'myMovieMovie.genre DESC',
			),
			'resourceTypeDesc' => array(
				        'asc' => 'resourceType.description',
				        'desc' => 'resourceType.description DESC',
			),
			'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
							'sort'=>$sort,
		));
	}
	
	public function searchNzbEpisodes()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('file_original_name',$this->file_original_name,true);
		
		
		//$criteria->with[]='imdbDataTv';
		
	
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
	
// 		$criteria->join =	"LEFT OUTER JOIN imdbdata_tv i ON t.Id_imdbdata_tv=i.ID
// 							 LEFT OUTER JOIN imdbdata_tv p ON p.ID=i.Id_parent";
// 		$criteria->addSearchCondition("i.Title",$this->title);
// 		$criteria->addSearchCondition("i.Year",$this->year);
// 		$criteria->addSearchCondition("i.ID",$this->idImdb);
// 		$criteria->addSearchCondition("i.Genre",$this->genre);
// 		$criteria->addSearchCondition("i.Season",$this->season);
// 		$criteria->addSearchCondition("i.Episode",$this->episode);
// 		$criteria->addSearchCondition("p.Title",$this->serie_title);
// 		$criteria->addSearchCondition("p.Deleted_serie",$this->deleted_serie);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
				'Id',
				'url',
				'file_name',
				'subt_url',
				'subt_url_name',
				'title' => array(
					        'asc' => 'i.Title',
					        'desc' => 'i.Title DESC',
		),
				'year' => array(
					        'asc' => 'i.Year',
					        'desc' => 'i.Year DESC',
		),
				'serie_title' => array(
					        'asc' => 'p.Year',
					        'desc' => 'p.Year DESC',
		),
				'deleted_serie' => array(
					        'asc' => 'p.Deleted_serie',
					        'desc' => 'p.Deleted_serie DESC',
		),
				'season' => array(
					        'asc' => 'i.Year',
					        'desc' => 'i.Year DESC',
		),
				'episode' => array(
					        'asc' => 'i.Episode',
					        'desc' => 'i.Episode DESC',
		),
				'idImdb' => array(
					        'asc' => 'i.ID',
					        'desc' => 'i.ID DESC',
		),
				'genre' => array(
					        'asc' => 'i.Genre',
					        'desc' => 'i.Genre DESC',
		),
				'resourceTypeDesc' => array(
					        'asc' => 'resourceType.description',
					        'desc' => 'resourceType.description DESC',
		),
				'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
								'sort'=>$sort,
		));
	}
}