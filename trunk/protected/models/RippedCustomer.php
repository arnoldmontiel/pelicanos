<?php

/**
 * This is the model class for table "ripped_customer".
 *
 * The followings are the available columns in table 'ripped_customer':
 * @property integer $Id
 * @property string $ripped_date
 * @property string $Id_device
 * @property string $Id_my_movie_disc
 *
 * The followings are the available model relations:
 * @property MyMovieDisc $idMyMovieDisc
 */
class RippedCustomer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RippedCustomer the static model class
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
		return 'ripped_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_device, Id_my_movie_disc', 'required'),
			array('Id_device', 'length', 'max'=>45),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			array('ripped_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ripped_date, Id_device, Id_my_movie_disc', 'safe', 'on'=>'search'),
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
			'myMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'ripped_date' => 'Ripped Date',
			'Id_device' => 'Id Device',
			'Id_my_movie_disc' => 'Id My Movie Disc',
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
		$criteria->compare('ripped_date',$this->ripped_date,true);
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}