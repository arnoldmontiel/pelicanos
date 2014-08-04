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
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 * @property Nzb $idNzb
 */
class Consumption extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consumption';
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
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_customer, points, date, description, already_paid', 'safe', 'on'=>'search'),
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
