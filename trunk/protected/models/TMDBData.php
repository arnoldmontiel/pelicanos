<?php

/**
 * This is the model class for table "TMDB_data".
 *
 * The followings are the available columns in table 'TMDB_data':
 * @property integer $Id
 * @property string $poster
 * @property string $big_poster
 * @property string $backdrop
 * @property integer $TMDB_id
 *
 * The followings are the available model relations:
 * @property Nzb[] $nzbs
 */
class TMDBData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TMDB_data';
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
			array('Id, TMDB_id', 'numerical', 'integerOnly'=>true),
			array('poster, big_poster, backdrop', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, poster, big_poster, backdrop, TMDB_id', 'safe', 'on'=>'search'),
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
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_TMDB_data'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'poster' => 'Poster',
			'big_poster' => 'Big Poster',
			'backdrop' => 'Backdrop',
			'TMDB_id' => 'Tmdb',
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
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('big_poster',$this->big_poster,true);
		$criteria->compare('backdrop',$this->backdrop,true);
		$criteria->compare('TMDB_id',$this->TMDB_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TMDBData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
