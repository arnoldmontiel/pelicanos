<?php

/**
 * This is the model class for table "auto_ripper_file_audio_track".
 *
 * The followings are the available columns in table 'auto_ripper_file_audio_track':
 * @property integer $Id_audio_track
 * @property integer $Id_auto_ripper_file
 *
 * The followings are the available model relations:
 * @property AudioTrack $idAudioTrack
 */
class AutoRipperFileAudioTrack extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auto_ripper_file_audio_track';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_audio_track, Id_auto_ripper_file', 'required'),
			array('Id_audio_track, Id_auto_ripper_file', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_audio_track, Id_auto_ripper_file', 'safe', 'on'=>'search'),
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
			'idAudioTrack' => array(self::BELONGS_TO, 'AudioTrack', 'Id_audio_track'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_audio_track' => 'Id Audio Track',
			'Id_auto_ripper_file' => 'Id Auto Ripper File',
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

		$criteria->compare('Id_audio_track',$this->Id_audio_track);
		$criteria->compare('Id_auto_ripper_file',$this->Id_auto_ripper_file);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutoRipperFileAudioTrack the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
