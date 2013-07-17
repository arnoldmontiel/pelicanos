<?php

/**
 * This is the model class for table "auto_ripper".
 *
 * The followings are the available columns in table 'auto_ripper':
 * @property integer $Id
 * @property string $Id_disc
 * @property integer $Id_auto_ripper_state
 * @property string $name
 * @property string $password
 * @property integer $Id_nzb
 * @property integer $percentage
 *
 * The followings are the available model relations:
 * @property AutoRipperState $idAutoRipperState
 * @property Nzb $idNzb
 * @property AutoRipperState[] $autoRipperStates
 */
class AutoRipper extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auto_ripper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_auto_ripper_state', 'required'),
			array('Id_auto_ripper_state, Id_nzb, percentage', 'numerical', 'integerOnly'=>true),
			array('Id_disc', 'length', 'max'=>200),
			array('name, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_disc, Id_auto_ripper_state, name, password, Id_nzb, percentage', 'safe', 'on'=>'search'),
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
			'autoRipperState' => array(self::BELONGS_TO, 'AutoRipperState', 'Id_auto_ripper_state'),
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'autoRipperStates' => array(self::MANY_MANY, 'AutoRipperState', 'auto_ripper_auto_ripper_state(Id_auto_ripper, Id_auto_ripper_state)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_disc' => 'Id Disc',
			'Id_auto_ripper_state' => 'Id Auto Ripper State',
			'name' => 'Name',
			'password' => 'Password',
			'Id_nzb' => 'Id Nzb',
			'percentage' => 'Percentage',
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
		$criteria->compare('Id_disc',$this->Id_disc,true);
		$criteria->compare('Id_auto_ripper_state',$this->Id_auto_ripper_state);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('percentage',$this->percentage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutoRipper the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
