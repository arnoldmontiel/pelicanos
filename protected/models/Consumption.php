<?php

/**
 * This is the model class for table "consumption".
 *
 * The followings are the available columns in table 'consumption':
 * @property integer $Id
 * @property integer $Id_nzb
 * @property integer $Id_customer
 * @property integer $points
 * @property string $date
 * @property string $description
 * @property integer $already_paid
 * @property string $paid_date
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 * @property Nzb $idNzb
 */
class Consumption extends CActiveRecord
{
	public $reseller;
	public $total_points;
	public $Id_reseller;
	public $year;
	public $month;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consumption';
	}

	static public function pendingQtyByReseller()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('already_paid',0);
		$criteria->select = 'r.Id as Id_reseller, r.description as reseller, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';
		$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)
							inner join reseller r on (r.Id = c.Id_reseller)';		
		$criteria->group = 'r.Id, YEAR(t.date),MONTH(t.date)';
		return Consumption::model()->count($criteria);
	}
	
	static public function pendingQtyByCustomer()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('already_paid',0);
		$criteria->select = 't.Id_customer, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';		
		$criteria->group = 't.Id_customer, YEAR(t.date),MONTH(t.date)';
		return Consumption::model()->count($criteria);
	}
	
	static public function pointsAccumulated($paid = true)
	{
		$points = 0;
		$criteria=new CDbCriteria;
		
		if($paid)
			$criteria->compare('already_paid',1);
		else
			$criteria->compare('already_paid',0);
		
		$criteria->select = 'SUM(t.points) as total_points';
		
		$idReseller = User::getResellerId();
		if(isset($idReseller))
		{
			$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
			$criteria->addCondition('c.Id_reseller = '. $idReseller);
		}
		
		$model = Consumption::model()->find($criteria);
		if(isset($model))
			$points = $model->total_points;
		
		return $points;
	}
		
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_nzb, Id_customer', 'required'),
			array('Id_nzb, Id_customer, points, already_paid', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('date, paid_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_customer, points, date, description, already_paid, reseller, total_points, Id_reseller, year, month, paid_date', 'safe', 'on'=>'search'),
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
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
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
			'description' => 'Description',
			'already_paid' => 'Already Paid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',$this->already_paid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchPendingByReseller()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',0);
		$criteria->select = 'r.Id as Id_reseller, r.description as reseller, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';
		$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)
							inner join reseller r on (r.Id = c.Id_reseller)';
		$criteria->group = 'r.Id, YEAR(t.date),MONTH(t.date)';		
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchPaymentByReseller()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		
		$criteria=new CDbCriteria;
		
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',1);
		$criteria->select = 't.paid_date, r.Id as Id_reseller, r.description as reseller, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';
		$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)
							inner join reseller r on (r.Id = c.Id_reseller)';
		$criteria->group = 'r.Id, YEAR(t.date),MONTH(t.date)';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchPendingByCustomer()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',0);
		
		if(isset($this->Id_reseller))
		{
			$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
			$criteria->addCondition('c.Id_reseller = '. $this->Id_reseller);
		}
		
		$criteria->select = 't.Id_customer, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';		
		$criteria->group = 't.Id_customer, YEAR(t.date),MONTH(t.date)';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchPaymentByCustomer()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',1);
		
		if(isset($this->Id_reseller))
		{
			$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
			$criteria->addCondition('c.Id_reseller = '. $this->Id_reseller);
		}
		
		$criteria->select = 't.paid_date, t.Id_customer, t.date, SUM(t.points) as total_points, YEAR(t.date) as year ,MONTH(t.date) as month';		
		$criteria->group = 't.Id_customer, YEAR(t.date),MONTH(t.date)';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchByMonth()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('points',$this->points);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('already_paid',$this->already_paid);
	
		if(isset($this->Id_reseller))
		{
			$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
			
			$criteria->addCondition('c.Id_reseller = '. $this->Id_reseller);
		}
		$criteria->addCondition('MONTH(t.date) = '. $this->month);
		$criteria->addCondition('YEAR(t.date) = '. $this->year);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				'*',
		);
	
		$sort->defaultOrder = 't.date DESC';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consumption the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
