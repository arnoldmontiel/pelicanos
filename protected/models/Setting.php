<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $Id
 * @property string $path_anydvd_download
 * @property string $path_images
 * @property string $disc_minimum_warning
 */
class Setting extends CActiveRecord
{
	private static $setting;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Setting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getInstance()
	{
		if(!isset(self::$instancia))
		{
			$setings = Setting::model()->findAll();
			if($setings!=null)
			Setting::$setting= $setings[0];
		}
		return self::$setting;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'required'),
			array('Id', 'numerical', 'integerOnly'=>true),
			array('path_images', 'length', 'max'=>255),
			array('disc_minimum_warning', 'length', 'max'=>20),
			array('path_anydvd_download', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path_anydvd_download, path_images, disc_minimum_warning', 'safe', 'on'=>'search'),
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
			'Id' => 'ID',
			'path_anydvd_download' => 'Path Anydvd Download',
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
		$criteria->compare('path_anydvd_download',$this->path_anydvd_download,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}