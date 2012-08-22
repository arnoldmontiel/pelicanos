<?php

/**
 * This is the model class for table "ripped_customer".
 *
 * The followings are the available columns in table 'ripped_customer':
 * @property integer $Id
 * @property string $Id_my_movie
 * @property integer $Id_customer
 * @property string $ripped_date
 *
 * The followings are the available model relations:
 * @property MyMovie $idMyMovie
 * @property Customer $idCustomer
 */
class RippedCustomer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RippedCustomer the static model class
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
		return 'ripped_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie, Id_customer', 'required'),
			array('Id_customer', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie', 'length', 'max'=>200),
			array('ripped_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie, Id_customer, ripped_date', 'safe', 'on'=>'search'),
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
			'idMyMovie' => array(self::BELONGS_TO, 'MyMovie', 'Id_my_movie'),
			'idCustomer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie' => 'Id My Movie',
			'Id_customer' => 'Id Customer',
			'ripped_date' => 'Ripped Date',
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
		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('ripped_date',$this->ripped_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}