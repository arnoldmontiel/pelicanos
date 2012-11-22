<?php

/**
 * This is the model class for table "settings_ripper".
 *
 * The followings are the available columns in table 'settings_ripper':
 * @property integer $Id
 * @property string $Id_device
 * @property string $drive_letter
 * @property string $temp_folder_ripping
 * @property string $final_folder_ripping
 * @property string $time_from_reboot
 * @property string $time_to_reboot
 * @property string $mymovies_username
 * @property string $mymovies_password
 * @property string $last_update
 *
 * The followings are the available model relations:
 * @property Device $idDevice
 */
class SettingsRipper extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SettingsRipper the static model class
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
		return 'settings_ripper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_device', 'required'),
			array('Id_device, drive_letter, mymovies_username, mymovies_password', 'length', 'max'=>45),
			array('temp_folder_ripping, final_folder_ripping', 'length', 'max'=>256),
			array('time_from_reboot, time_to_reboot, last_update', 'safe'),
			array('last_update','default',
												              'value'=>new CDbExpression('NOW()'),
												              'setOnEmpty'=>false,'on'=>'update'),
			array('last_update','default',
												              'value'=>new CDbExpression('NOW()'),
												              'setOnEmpty'=>false,'on'=>'insert'),
		
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_device, drive_letter, temp_folder_ripping, final_folder_ripping, time_from_reboot, time_to_reboot, mymovies_username, mymovies_password, last_update', 'safe', 'on'=>'search'),
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
			'drive_letter' => 'Drive Letter',
			'temp_folder_ripping' => 'Temp Folder Ripping',
			'final_folder_ripping' => 'Final Folder Ripping',
			'time_from_reboot' => 'Time From Reboot',
			'time_to_reboot' => 'Time To Reboot',
			'mymovies_username' => 'Mymovies Username',
			'mymovies_password' => 'Mymovies Password',
			'last_update' => 'Last Update',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('drive_letter',$this->drive_letter,true);
		$criteria->compare('temp_folder_ripping',$this->temp_folder_ripping,true);
		$criteria->compare('final_folder_ripping',$this->final_folder_ripping,true);
		$criteria->compare('time_from_reboot',$this->time_from_reboot,true);
		$criteria->compare('time_to_reboot',$this->time_to_reboot,true);
		$criteria->compare('mymovies_username',$this->mymovies_username,true);
		$criteria->compare('mymovies_password',$this->mymovies_password,true);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}