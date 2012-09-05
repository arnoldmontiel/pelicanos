<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $Id
 * @property string $name
 * @property string $last_name
 * @property string $address
 * @property integer $current_points
 * @property integer $Id_reseller
 *
 * The followings are the available model relations:
 * @property Reseller $idReseller
 * @property CustomerTransaction[] $customerTransactions
 * @property CustomerUsers[] $customerUsers
 * @property ImdbdataTv[] $imdbdataTvs
 * @property Log[] $logs
 * @property Nzb[] $nzbs
 * @property RippedCustomer[] $rippedCustomers
 */
class Customer extends CActiveRecord
{
	public $reseller_desc;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_reseller', 'required'),
			array('current_points, Id_reseller', 'numerical', 'integerOnly'=>true),
			array('name, last_name, address', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, last_name, address, current_points, Id_reseller, reseller_desc', 'safe', 'on'=>'search'),
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
			'reseller' => array(self::BELONGS_TO, 'Reseller', 'Id_reseller'),
			'nzbs' => array(self::MANY_MANY, 'Nzb', 'nzb_customer(Id_customer, Id_nzb)'),
		);
	}

	public function getCustomerDesc()
	{
		return $this->last_name .' - '. $this->name;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'name' => 'Name',
			'last_name' => 'Last Name',
			'address' => 'Address',
			'current_points' => 'Current Points',
			'Id_reseller' => 'Reseller',
			'reseller_desc'=>'Reseller',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('current_points',$this->current_points);

		$IdReseller = User::getResellerId();
		if(isset($IdReseller))
			$criteria->compare('Id_reseller',$IdReseller);
		
		
		$criteria->with[]='reseller';
		$criteria->addSearchCondition("reseller.description",$this->reseller_desc);
		
		$sort=new CSort;
		$sort->attributes=array(
						      'Id',
						      'name',
						      'last_name',
						      'address',
						      'current_points',
						      'reseller_desc' => array(
						        	'asc' => 'reseller.description',
						        	'desc' => 'reseller.description DESC',
									),
							  '*',
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}
}