<?php

/**
 * This is the model class for table "nzb".
 *
 * The followings are the available columns in table 'nzb':
 * @property integer $Id
 * @property integer $Id_resource_type
 * @property string $url
 * @property string $file_name
 * @property string $subt_url
 * @property string $subt_file_name
 * @property string $subt_original_name
 * @property integer $deleted
 * @property integer $points
 * @property string $file_original_name
 * @property integer $is_draft
 * @property string $Id_my_movie_disc_nzb
 *
 * The followings are the available model relations:
 * @property CustomerTransaction[] $customerTransactions
 * @property MyMovieDiscNzb $idMyMovieDiscNzb
 * @property ResourceType $idResourceType
 * @property NzbCustomer[] $nzbCustomers
 */
class Nzb extends CActiveRecord
{
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
			array('Id_resource_type, Id_my_movie_disc_nzb', 'required'),
			array('Id_resource_type, deleted, points, is_draft', 'numerical', 'integerOnly'=>true),
			array('url, file_name, subt_url, subt_file_name, subt_original_name, file_original_name', 'length', 'max'=>255),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_resource_type, url, file_name, subt_url, subt_file_name, subt_original_name, deleted, points, file_original_name, is_draft, Id_my_movie_disc_nzb', 'safe', 'on'=>'search'),
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
			'customerTransactions' => array(self::HAS_MANY, 'CustomerTransaction', 'Id_nzb'),
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'resourceType' => array(self::BELONGS_TO, 'ResourceType', 'Id_resource_type'),
			'nzbCustomers' => array(self::HAS_MANY, 'NzbCustomer', 'Id_nzb'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_resource_type' => 'Id Resource Type',
			'url' => 'Url',
			'file_name' => 'File Name',
			'subt_url' => 'Subt Url',
			'subt_file_name' => 'Subt File Name',
			'subt_original_name' => 'Subt Original Name',
			'deleted' => 'Deleted',
			'points' => 'Points',
			'file_original_name' => 'File Original Name',
			'is_draft' => 'Is Draft',
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
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
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('points',$this->points);
		$criteria->compare('file_original_name',$this->file_original_name,true);
		$criteria->compare('is_draft',$this->is_draft);
		$criteria->compare('Id_my_movie_disc_nzb',$this->Id_my_movie_disc_nzb,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchMovie()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
										LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		$criteria->compare('n.is_serie',0);
		$criteria->order = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchTv()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
											LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		$criteria->compare('n.is_serie',1);
		$criteria->order = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}