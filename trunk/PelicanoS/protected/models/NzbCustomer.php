<?php

/**
 * This is the model class for table "nzb_customer".
 *
 * The followings are the available columns in table 'nzb_customer':
 * @property integer $Id_nzb
 * @property integer $Id_customer
 * @property integer $need_update
 */
class NzbCustomer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NzbCustomer the static model class
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
		return 'nzb_customer';
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
			array('Id_nzb, Id_customer, need_update', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_nzb, Id_customer, need_update', 'safe', 'on'=>'search'),
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
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_nzb' => 'Id Nzb',
			'Id_customer' => 'Id Customer',
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

		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('need_update',$this->need_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}