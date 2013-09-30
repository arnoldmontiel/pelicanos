<?php

/**
 * This is the model class for table "device_tunneling".
 *
 * The followings are the available columns in table 'device_tunneling':
 * @property integer $Id
 * @property string $Id_device
 * @property integer $Id_port
 * @property integer $internal_port
 * @property integer $is_open
 * @property integer $is_validated
 *
 * The followings are the available model relations:
 * @property Port $idPort
 * @property Device $idDevice
 */
class DeviceTunneling extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device_tunneling';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_device, Id_port', 'required'),
			array('Id_port, internal_port, is_open, is_validated', 'numerical', 'integerOnly'=>true),
			array('Id_device', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_device, Id_port, internal_port, is_open, is_validated', 'safe', 'on'=>'search'),
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
			'port' => array(self::BELONGS_TO, 'Port', 'Id_port'),
			'device' => array(self::BELONGS_TO, 'Device', 'Id_device'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_device' => 'Id Device',
			'Id_port' => 'Id Port',
			'internal_port' => 'Internal Port',
			'is_open' => 'Is Open',
			'is_validated' => 'Is Validated',
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
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('Id_port',$this->Id_port);
		$criteria->compare('internal_port',$this->internal_port);
		$criteria->compare('is_open',$this->is_open);
		$criteria->compare('is_validated',$this->is_validated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeviceTunneling the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
