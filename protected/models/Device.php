<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property string $Id
 * @property string $description
 * @property string $sabnzb_api_key
 * @property string $sabnzb_api_url
 * @property string $path_sabnzbd_download
 * @property string $path_pending
 * @property string $host_name
 * @property string $path_ready
 * @property string $path_images
 * @property string $path_shared
 * @property string $host_path
 * @property string $host_file_server
 * @property string $host_file_server_path 
 * @property string $tmdb_api_key
 * @property string $tmdb_lang
 * 
 * The followings are the available model relations:
 * @property ClientSettings[] $clientSettings
 * @property Customer[] $customers
 * @property SettingsRipper[] $settingsRippers
 */
class Device extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Device the static model class
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
		return 'device';
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
			array('Id, tmdb_lang', 'length', 'max'=>45),
			array('sabnzb_api_key, sabnzb_api_url, path_sabnzbd_download, path_pending, host_name, path_ready, path_images, path_shared, host_path, host_file_server, host_file_server_path, tmdb_api_key', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, sabnzb_api_key, sabnzb_api_url, path_sabnzbd_download, path_pending, host_name, path_ready, path_images, path_shared, host_path, host_file_server, host_file_server_path, tmdb_api_key, tmdb_lang', 'safe', 'on'=>'search'),
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
			'clientSettings' => array(self::HAS_MANY, 'ClientSettings', 'Id_device'),
			'customers' => array(self::MANY_MANY, 'Customer', 'customer_device(Id_device, Id_customer)'),
			'settingsRippers' => array(self::HAS_MANY, 'SettingsRipper', 'Id_device'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Description',
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

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}