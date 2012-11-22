<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $Id
 * @property string $username
 * @property string $log_date
 * @property string $description
 * @property integer $Id_customer
 * @property integer $Id_log_type
 * @property integer $Id_log_customer
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 * @property LogType $idLogType
 */
class Log extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Log the static model class
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
		return 'log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_customer, Id_log_type', 'required'),
			array('Id_customer, Id_log_type, Id_log_customer', 'numerical', 'integerOnly'=>true),
			array('username, log_date', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, username, log_date, description, Id_customer, Id_log_type, Id_log_customer', 'safe', 'on'=>'search'),
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
			'idCustomer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
			'idLogType' => array(self::BELONGS_TO, 'LogType', 'Id_log_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'username' => 'Username',
			'log_date' => 'Log Date',
			'description' => 'Description',
			'Id_customer' => 'Id Customer',
			'Id_log_type' => 'Id Log Type',
			'Id_log_customer' => 'Id Log Customer',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('log_date',$this->log_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('Id_log_type',$this->Id_log_type);
		$criteria->compare('Id_log_customer',$this->Id_log_customer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}