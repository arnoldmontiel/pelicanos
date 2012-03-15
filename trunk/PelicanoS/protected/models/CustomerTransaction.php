<?php

/**
 * This is the model class for table "customer_transaction".
 *
 * The followings are the available columns in table 'customer_transaction':
 * @property integer $Id
 * @property integer $Id_nzb
 * @property integer $Id_customer
 * @property integer $points
 * @property string $date
 * @property integer $transaction_type_Id
 *
 * The followings are the available model relations:
 * @property Nzb $idNzb
 * @property Customer $idCustomer
 * @property TransactionType $transactionType
 */
class CustomerTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerTransaction the static model class
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
		return 'customer_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_type_Id', 'required'),
			array('Id_nzb, Id_customer, points, transaction_type_Id', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_customer, points, date, transaction_type_Id', 'safe', 'on'=>'search'),
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
			'idNzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'idCustomer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
			'transactionType' => array(self::BELONGS_TO, 'TransactionType', 'transaction_type_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_nzb' => 'Id Nzb',
			'Id_customer' => 'Id Customer',
			'points' => 'Points',
			'date' => 'Date',
			'transaction_type_Id' => 'Transaction Type',
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
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('transaction_type_Id',$this->transaction_type_Id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}