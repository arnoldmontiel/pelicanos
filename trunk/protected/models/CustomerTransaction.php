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
 * @property integer $Id_transaction_type
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 * @property Nzb $idNzb
 * @property TransactionType $idTransactionType
 */
class CustomerTransaction extends CActiveRecord
{
	public $transaction_type;
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
			array('Id_customer, Id_transaction_type', 'required'),
			array('Id_nzb, Id_customer, points, Id_transaction_type', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('date','default',
		              'value'=>new CDbExpression('NOW()'),
		              'setOnEmpty'=>true,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_customer, points, date, Id_transaction_type, transaction_type, description', 'safe', 'on'=>'search'),
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
			'idNzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'transactionType' => array(self::BELONGS_TO, 'TransactionType', 'Id_transaction_type'),
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
			'Id_transaction_type' => 'Transaction Type',
			'description' => 'Description',
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
		$criteria->compare('Id_transaction_type',$this->Id_transaction_type);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchTransaction()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('Id_transaction_type',$this->Id_transaction_type);
		$criteria->compare('description',$this->description,true);
	
		$criteria->with[]='transactionType';
		$criteria->addSearchCondition("transaction_type.description",$this->transaction_type);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				      'points',
				      'date',
				      'transaction_type' => array(
				        	'asc' => 'transaction_type.description',
				        	'desc' => 'transaction_type.description DESC',
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