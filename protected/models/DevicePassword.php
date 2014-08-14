<?php

/**
 * This is the model class for table "device_password".
 *
 * The followings are the available columns in table 'device_password':
 * @property integer $Id
 * @property string $password
 * @property string $Id_device
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Device $idDevice
 * @property DevicePasswordLog[] $devicePasswordLogs
 */
class DevicePassword extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device_password';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>255),
			array('Id_device', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, password, Id_device, active', 'safe', 'on'=>'search'),
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
			'idDevice' => array(self::BELONGS_TO, 'Device', 'Id_device'),
			'devicePasswordLogs' => array(self::HAS_MANY, 'DevicePasswordLog', 'Id_device_password'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'password' => 'Password',
			'Id_device' => 'Id Device',
			'active' => 'Active',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DevicePassword the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
