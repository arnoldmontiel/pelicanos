<?php

/**
 * This is the model class for table "customer_users".
 *
 * The followings are the available columns in table 'customer_users':
 * @property string $username
 * @property string $password
 * @property integer $parental_control
 * @property string $email
 * @property integer $Id_customer
 * @property integer $deleted
 * @property integer $need_update
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 */
class CustomerUsers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerUsers the static model class
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
		return 'customer_users';
	}

	public function behaviors() {
		return array(
	            'ECompositeUniqueKeyValidatable' => array(
	                'class' => 'ext.ECompositeUniqueKeyValidatable.ECompositeUniqueKeyValidatable',
	                'uniqueKeys' => array(
	                    'attributes' => 'username, Id_customer',
	                    'errorMessage' => 'Your login is already taken',
	                    'errorAttributes' => array('username'),
		)
		),
		);
	}
	
	
	public function compositeUniqueKeysValidator() {
		$this->validateCompositeUniqueKeys();
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, Id_customer, password', 'required'),
			array('parental_control, Id_customer, deleted, need_update', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			 array('*', 'compositeUniqueKeysValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, parental_control, email, Id_customer, deleted, need_update', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'password' => 'Password',
			'parental_control' => 'Parental Control',
			'email' => 'Email',
			'Id_customer' => 'Id Customer',
			'deleted' => 'Deleted',
			'need_update' => 'Need Update',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('parental_control',$this->parental_control);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('need_update',$this->need_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}