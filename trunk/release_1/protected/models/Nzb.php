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
 * @property string $Id_imdbdata
 * @property string $subt_original_name
 * @property integer $Id_resource_type
 * The followings are the available model relations:
 * @property Imdbdata $idImdbdata
 */
class Nzb extends CActiveRecord
{
	public $title;
	public $year;
	public $idImdb;
	public $genre;
	public $resourceTypeDesc;
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
			array(' Id_resource_type', 'required'),
			array('url, subt_url, file_name, subt_file_name, subt_original_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, url, file_name, subt_url, subt_file_name, Id_imdbdata, title, year, idImdb, genre, subt_original_name, resourceTypeDesc', 'safe', 'on'=>'search'),
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
			'imdbData' => array(self::BELONGS_TO, 'Imdbdata', 'Id_imdbdata'),
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
			'Id_imdbData' => 'Id Imdb Data',
			'subt_original_name' => 'Subt Original Name',
			'Id_resource_type' => 'Resource Type',
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
		$criteria->compare('Id_imdbdata',$this->Id_imdbdata,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchNzb()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('Id_imdbdata',$this->Id_imdbdata,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		
		$criteria->with[]='imdbData';
		$criteria->addSearchCondition("imdbData.Title",$this->title);
		$criteria->addSearchCondition("imdbData.Year",$this->year);
		$criteria->addSearchCondition("imdbData.ID",$this->idImdb);
		$criteria->addSearchCondition("imdbData.Genre",$this->genre);
	
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
			'Id',
			'url',
			'file_name',
			'subt_url',
			'subt_url_name',
			'Id_imdbdata',
			'title' => array(
				        'asc' => 'imdbData.Title',
				        'desc' => 'imdbData.Title DESC',
			),
			'year' => array(
				        'asc' => 'imdbData.Year',
				        'desc' => 'imdbData.Year DESC',
			),
			'idImdb' => array(
				        'asc' => 'imdbData.ID',
				        'desc' => 'imdbData.ID DESC',
			),
			'genre' => array(
				        'asc' => 'imdbData.Genre',
				        'desc' => 'imdbData.Genre DESC',
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