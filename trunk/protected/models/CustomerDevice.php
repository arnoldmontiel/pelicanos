<?php

/**
 * This is the model class for table "customer_device".
 *
 * The followings are the available columns in table 'customer_device':
 * @property string $Id_device
 * @property integer $Id_customer
 * @property integer $need_update
 * @property string $last_read_date
 * @property integer $is_pending
 * @property string $request_date
 * @property string $approve_date
 */
class CustomerDevice extends CActiveRecord
{
	public $device_description;
	public $reseller_description;
	public $customer_description;
	
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
			array('Id_customer, need_update, is_pending', 'numerical', 'integerOnly'=>true),
			array('Id_device', 'length', 'max'=>45),
			array('last_read_date, request_date, approve_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_device, Id_customer, device_description, reseller_description, customer_description, need_update, is_pending, request_date, approve_date', 'safe', 'on'=>'search'),
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
			'Id_device' => 'Dispositivo',
			'Id_customer' => 'Id Customer',
			'device_description'=> 'Nombre',
			'reseller_description'=> 'Reseller',
			'customer_description'=>'Cliente',
			'request_date'=>'Fecha Pedido',
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

		$criteria->compare('t.Id_device',$this->Id_device,true);

		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)
							INNER JOIN reseller r on (c.Id_reseller = r.Id)
							INNER JOIN device d on (d.Id = t.Id_device)';
		
		$criteria->compare('d.description',$this->device_description, true);
		$criteria->compare('r.description',$this->reseller_description, true);
		$criteria->compare('CONCAT_WS(" ",c.name, c.last_name)',$this->customer_description, true);
		
		$sort=new CSort;
		$sort->attributes=array(
					      'Id_reseller',
					      'device_description' => array(
					        	'asc' => 'd.description',
					        	'desc' => 'd.description DESC',
					),
					'reseller_description' => array(
							'asc' => 'r.description',
							'desc' => 'r.description DESC',
					),
					'customer_description' => array(
							'asc' => 'CONCAT_WS(" ",c.name, c.last_name)',
							'desc' => 'CONCAT_WS(" ",c.name, c.last_name) DESC',
					),
					'*',
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
	public function searchPending()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_device',$this->Id_device,true);
	
		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)
							INNER JOIN reseller r on (c.Id_reseller = r.Id)
							INNER JOIN device d on (d.Id = t.Id_device)';
	
		$criteria->compare('d.description',$this->device_description, true);
		$criteria->compare('r.description',$this->reseller_description, true);
		$criteria->compare('CONCAT_WS(" ",c.name, c.last_name)',$this->customer_description, true);
		$criteria->addCondition('t.is_pending = 1');
		
		$sort=new CSort;
		$sort->attributes=array(
				'Id_reseller',
				'device_description' => array(
						'asc' => 'd.description',
						'desc' => 'd.description DESC',
				),
				'reseller_description' => array(
						'asc' => 'r.description',
						'desc' => 'r.description DESC',
				),
				'customer_description' => array(
						'asc' => 'CONCAT_WS(" ",c.name, c.last_name)',
						'desc' => 'CONCAT_WS(" ",c.name, c.last_name) DESC',
				),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchApproved()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_device',$this->Id_device,true);
	
		$criteria->join = 'INNER JOIN customer c on (c.Id = t.Id_customer)
							INNER JOIN reseller r on (c.Id_reseller = r.Id)
							INNER JOIN device d on (d.Id = t.Id_device)';
	
		$criteria->compare('d.description',$this->device_description, true);
		$criteria->compare('r.description',$this->reseller_description, true);
		$criteria->compare('CONCAT_WS(" ",c.name, c.last_name)',$this->customer_description, true);
		$criteria->addCondition('t.is_pending = 0');
		
		$sort=new CSort;
		$sort->attributes=array(
				'Id_reseller',
				'device_description' => array(
						'asc' => 'd.description',
						'desc' => 'd.description DESC',
				),
				'reseller_description' => array(
						'asc' => 'r.description',
						'desc' => 'r.description DESC',
				),
				'customer_description' => array(
						'asc' => 'CONCAT_WS(" ",c.name, c.last_name)',
						'desc' => 'CONCAT_WS(" ",c.name, c.last_name) DESC',
				),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
}