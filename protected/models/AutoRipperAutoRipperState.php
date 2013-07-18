<?php

/**
 * This is the model class for table "auto_ripper_auto_ripper_state".
 *
 * The followings are the available columns in table 'auto_ripper_auto_ripper_state':
 * @property integer $Id_auto_ripper
 * @property integer $Id_auto_ripper_state
 * @property string $change_date
 * @property string $description
 */
class AutoRipperAutoRipperState extends CActiveRecord
{
	public $auto_ripper_state_description;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auto_ripper_auto_ripper_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_auto_ripper, Id_auto_ripper_state', 'required'),
			array('Id_auto_ripper, Id_auto_ripper_state', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('change_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_auto_ripper, Id_auto_ripper_state, change_date, description, auto_ripper_state_description', 'safe', 'on'=>'search'),
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
			'autoRipper' => array(self::BELONGS_TO, 'AutoRipper', 'Id_auto_ripper'),
			'autoRipperState' => array(self::BELONGS_TO, 'AutoRipperState', 'Id_auto_ripper_state'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_auto_ripper' => 'Id Auto Ripper',
			'Id_auto_ripper_state' => 'Id Auto Ripper State',
			'change_date' => 'Change Date',
			'description' => 'Description',
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

		$criteria->compare('Id_auto_ripper',$this->Id_auto_ripper);
		$criteria->compare('Id_auto_ripper_state',$this->Id_auto_ripper_state);
		$criteria->compare('change_date',$this->change_date,true);
		$criteria->compare('description',$this->description,true);

		$criteria->with[]='autoRipperState';
		$criteria->addSearchCondition("autoRipperState.description",$this->auto_ripper_state_description);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
									'change_date',
									'description',
									'auto_ripper_state_description' => array(
										        'asc' => 'autoRipperState.description',
										        'desc' => 'autoRipperState.description DESC',
		),
									'*',
		);
		
		
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
								'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutoRipperAutoRipperState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
