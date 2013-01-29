<?php

/**
 * This is the model class for table "customer_device".
 *
 * The followings are the available columns in table 'customer_device':
 * @property string $Id_device
 * @property integer $Id_customer
 */
class CustomerDevice extends CActiveRecord
{
	public $device_description;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerDevice the static model class
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
		return 'customer_device';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_device, Id_customer', 'required'),
			array('Id_customer', 'numerical', 'integerOnly'=>true),
			array('Id_device', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_device, Id_customer, device_description', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
			'device' => array(self::BELONGS_TO, 'Device', 'Id_device'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_device' => 'Device',
			'Id_customer' => 'Id Customer',
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

		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('Id_customer',$this->Id_customer);

		$criteria->with[]='device';
		$criteria->compare('device.description',$this->device_description);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}