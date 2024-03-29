<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property string $Id
 * @property string $description
 * @property string $sabnzb_api_key
 * @property string $sabnzb_api_url
 * @property string $host_name
 * @property string $path_shared
 * @property string $host_file_server
 * @property string $host_file_server_path 
 * @property string $tmdb_api_key
 * @property string $tmdb_lang
 * @property integer $need_nas
 * @property string $michael_jackson
 * @property string $sabnzb_pwd_file_path
 * @property string $path_sabnzbd_download
 * @property integer $is_movie_tester
 * @property string $host_file_server_user
 * @property string $host_file_server_passwd
 * @property string $host_file_server_name
 * @property integer $disc_min_size_warning
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

	
	public function getState()
	{
		$state = 1; //offline
		$modelClientSettings = ClientSettings::model()->findByAttributes(array('Id_device'=>$this->Id));
		if(isset($modelClientSettings))
		{
			if(!isset($modelClientSettings->ip_v4))
				$state = 2; //esperando startup
			else 
			{
				$setting = Setting::getInstance();
				//$newtimestamp = strtotime($modelClientSettings->last_update);				
				//return date('Y-m-d H:i:s', $newtimestamp);
				if(strtotime($modelClientSettings->last_update) > strtotime('now - '.$setting->heartbeat_minutes.' minutes' ))
				{
					if(isset($modelClientSettings->disc_total_space) && $modelClientSettings->disc_total_space > 0)
					{
						if(($modelClientSettings->disc_used_space / $modelClientSettings->disc_total_space * 100)> $this->disc_min_size_warning)
							$state = 4; //need disc
						else
							$state = 3; //online
					}
					else 
						$state = 3; //online
				}
				else
					$state = 1; //offline
			}
		}	
		return $state;
	}
	
	public function getIsUpToDate()
	{
		$isUpToDate = false;
		
		$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$this->Id));
		if(isset($modelCustomerDevice) && $modelCustomerDevice->need_update == 0)
			$isUpToDate = true;
		
		return $isUpToDate;	
	}
	
	public function getHasError()
	{
		$hasError = false;
		$criteria = new CDbCriteria();
		
		$criteria->addCondition('
						(Id = (select max(Id) as Id from pelicanos.error_log where Id_device = "'.$this->Id.'" and error_type = 2  )
						OR Id = (select max(Id) as Id from pelicanos.error_log where Id_device = "'.$this->Id.'" and error_type = 1  )
						OR Id = (select max(Id) as Id from pelicanos.error_log where Id_device = "'.$this->Id.'" and error_type = 3  )
						)');
		$criteria->addCondition('has_error = 1');
		
		if(ErrorLog::model()->count($criteria)>0)
			$hasError = true;
		
		return $hasError;
		
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
			array('is_movie_tester, need_nas, disc_min_size_warning', 'numerical', 'integerOnly'=>true),
			array('Id, tmdb_lang,teamviewer_partner_id,teamviewer_password', 'length', 'max'=>45),
				array('sabnzb_api_key, sabnzb_api_url, host_name, path_shared, host_file_server, host_file_server_path, sabnzb_pwd_file_path, path_sabnzbd_download, host_file_server_user, host_file_server_passwd, host_file_server_name, tmdb_api_key', 'length', 'max'=>255),
			array('michael_jackson', 'length', 'max'=>512),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, sabnzb_api_key, sabnzb_api_url, host_name, path_shared, host_file_server,  sabnzb_pwd_file_path, path_sabnzbd_download, is_movie_tester, host_file_server_user, host_file_server_passwd, michael_jackson, host_file_server_name, tmdb_api_key, tmdb_lang, need_nas, disc_min_size_warning,teamviewer_partner_id,teamviewer_password', 'safe', 'on'=>'search'),
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