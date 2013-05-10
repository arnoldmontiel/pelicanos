<?php

/**
 * This is the model class for table "nzb_creation_state".
 *
 * The followings are the available columns in table 'nzb_creation_state':
 * @property integer $Id_nzb
 * @property integer $Id_creation_state
 * @property string $date
 * @property string $user_username
 *
 * The followings are the available model relations:
 * @property Nzb $idNzb
 * @property CreationState $idCreationState
 * @property User $userUsername
 */
class NzbCreationState extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NzbCreationState the static model class
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
		return 'nzb_creation_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_nzb, Id_creation_state, user_username', 'required'),
			array('Id_nzb, Id_creation_state', 'numerical', 'integerOnly'=>true),
			array('user_username', 'length', 'max'=>128),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_nzb, Id_creation_state, date, user_username', 'safe', 'on'=>'search'),
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
			'creationState' => array(self::BELONGS_TO, 'CreationState', 'Id_creation_state'),
			'user' => array(self::BELONGS_TO, 'User', 'user_username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_nzb' => 'Id Nzb',
			'Id_creation_state' => 'State',
			'date' => 'Date',
			'username' => 'User',
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
		$criteria->compare('Id_creation_state',$this->Id_creation_state);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user_username',$this->user_username,true);
		$criteria->order = 'Id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}