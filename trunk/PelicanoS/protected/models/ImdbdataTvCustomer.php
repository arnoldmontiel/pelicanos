<?php

/**
 * This is the model class for table "imdbdata_tv_customer".
 *
 * The followings are the available columns in table 'imdbdata_tv_customer':
 * @property string $Id_imdbdata_tv
 * @property integer $Id_customer
 * @property string $date_sent
 * @property integer $need_update
 */
class ImdbdataTvCustomer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImdbdataTvCustomer the static model class
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
		return 'imdbdata_tv_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_imdbdata_tv, Id_customer', 'required'),
			array('Id_customer, need_update', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata_tv', 'length', 'max'=>45),
			array('date_sent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_imdbdata_tv, Id_customer, date_sent, need_update', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_imdbdata_tv' => 'Id Imdbdata Tv',
			'Id_customer' => 'Id Customer',
			'date_sent' => 'Date Sent',
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

		$criteria->compare('Id_imdbdata_tv',$this->Id_imdbdata_tv,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('need_update',$this->need_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}