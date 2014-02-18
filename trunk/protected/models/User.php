<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $Id_reseller
 *
 * The followings are the available model relations:
 * @property OpenSubtitle[] $openSubtitles
 * @property Reseller $idReseller
 */
class User extends CActiveRecord
{
	public $reseller_desc;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getResellerId()
	{
		$user = User::model()->findByPk(Yii::app()->user->Id);
		return $user->Id_reseller;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required', 'message'=>'{attribute} '.'cannot be blank.'),
			array('Id_reseller', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('username', 'unique', 'message'=>'{attribute} "{value}" '.'has already been taken.'),		
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, email, Id_reseller, reseller_desc', 'safe', 'on'=>'search'),
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
			'openSubtitles' => array(self::HAS_MANY, 'OpenSubtitle', 'Id_user'),
			'reseller' => array(self::BELONGS_TO, 'Reseller', 'Id_reseller'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Usuario',
			'password' => 'Password',
			'email' => 'E-mail',
			'Id_reseller' => 'Reseller',
			'reseller_desc' => 'Descripcion',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		

		$IdReseller = User::getResellerId();
		if(isset($IdReseller))
			$criteria->compare('Id_reseller',$IdReseller);
		
		$criteria->with[]='reseller';
		$criteria->addSearchCondition("reseller.description",$this->reseller_desc);
		
		$sort=new CSort;
		$sort->attributes=array(
								      'username',
								      'password',
								      'email',
								      'reseller_desc' => array(
								        	'asc' => 'reseller.description',
								        	'desc' => 'reseller.description DESC',
		),
									  '*',
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
		
	}
	
	public function searchAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->addCondition('Id_reseller is null');
	
		$sort=new CSort;
		$sort->attributes=array(
				'username',
				'password',
				'email',
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
	
	public function searchMovieAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->addCondition('Id_reseller is null');
	
		$sort=new CSort;
		$sort->attributes=array(
				'username',
				'password',
				'email',
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
	
	public function searchReseller()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->with[]='reseller';
		$criteria->addSearchCondition("reseller.description",$this->reseller_desc);
		
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->addCondition('Id_reseller is not null');
	
		$criteria->with[]='reseller';
		$criteria->addSearchCondition("reseller.description",$this->reseller_desc);
	
		$sort=new CSort;
		$sort->attributes=array(
				'username',
				'password',
				'email',
				'reseller_desc' => array(
						'asc' => 'reseller.description',
						'desc' => 'reseller.description DESC',
				),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
}