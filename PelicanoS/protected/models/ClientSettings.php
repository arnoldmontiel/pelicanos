<?php

/**
 * This is the model class for table "client_settings".
 *
 * The followings are the available columns in table 'client_settings':
 * @property integer $Id
 * @property string $ip_v4
 * @property string $ip_v6
 * @property integer $port_v4
 * @property integer $port_v6
 * @property integer $Id_customer
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 */
class ClientSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClientSettings the static model class
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
		return 'client_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_customer', 'required'),
			array('Id, port_v4, port_v6, Id_customer', 'numerical', 'integerOnly'=>true),
			array('ip_v4, ip_v6', 'length', 'max'=>128),
			array('last_update','default',
			              'value'=>new CDbExpression('NOW()'),
			              'setOnEmpty'=>false,'on'=>'update'),
			array('last_update','default',
			              'value'=>new CDbExpression('NOW()'),
			              'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ip_v4, ip_v6, port_v4, port_v6, Id_customer, last_update', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'ip_v4' => 'Ip V4',
			'ip_v6' => 'Ip V6',
			'port_v4' => 'Port V4',
			'port_v6' => 'Port V6',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('ip_v4',$this->ip_v4,true);
		$criteria->compare('ip_v6',$this->ip_v6,true);
		$criteria->compare('port_v4',$this->port_v4);
		$criteria->compare('port_v6',$this->port_v6);
		$criteria->compare('Id_customer',$this->Id_customer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}