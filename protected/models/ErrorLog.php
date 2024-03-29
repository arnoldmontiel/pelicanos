<?php

/**
 * This is the model class for table "error_log".
 *
 * The followings are the available columns in table 'error_log':
 * @property integer $Id
 * @property string $date
 * @property integer $error_type
 * @property integer $has_error
 */
class ErrorLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'error_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('error_type, has_error', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, date, error_type, has_error', 'safe', 'on'=>'search'),
		);
	}

	public function spaceStatus()
	{
		$value = 1;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_device = "'.$this->Id_device.'"');
		$criteria->addCondition('error_type = 3');
		$criteria->order = 'Id DESC';
		
		$model = ErrorLog::model()->find($criteria);
		if(isset($model))
			$value = $model->has_error;
		
		return $value;
	}
	
	public function nasStatus()
	{
		$value = 1;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_device = "'.$this->Id_device.'"');
		$criteria->addCondition('error_type = 2');
		$criteria->order = 'Id DESC';
		
		$model = ErrorLog::model()->find($criteria);
		if(isset($model))
			$value = $model->has_error;
		
		return $value;
	}
	
	public function playerStatus()
	{
		$value = 1;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_device = "'.$this->Id_device.'"');
		$criteria->addCondition('error_type = 1');
		$criteria->order = 'Id DESC';
		
		$model = ErrorLog::model()->find($criteria);
		if(isset($model))
			$value = $model->has_error;
		
		return $value;
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
			'Id' => 'ID',
			'date' => 'Date',
			'error_type' => 'Informe',
			'has_error' => 'Has Error',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('Id_device',$this->Id_device, true);
		$criteria->compare('error_type',$this->error_type);
		$criteria->compare('has_error',$this->has_error);

		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				'*',
		);
		
		$sort->defaultOrder = 'date DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ErrorLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
