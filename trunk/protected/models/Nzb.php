<?php

/**
 * This is the model class for table "nzb".
 *
 * The followings are the available columns in table 'nzb':
 * @property integer $Id
 * @property integer $Id_resource_type
 * @property string $url
 * @property string $file_name
 * @property string $subt_url
 * @property string $subt_file_name
 * @property string $subt_original_name
 * @property integer $deleted
 * @property integer $points
 * @property string $file_original_name
 * @property integer $is_draft
 * @property string $Id_my_movie_disc_nzb
 * @property string $file_password
 * @property string $final_content_path
 * @property integer $Id_nzb_type
 * @property integer $Id_nzb
 * @property string $rejected_description
 * @property integer $Id_creation_state
 * @property integer $Id_TMDB_data
 * @property integer $Id_auto_ripper_file
 * @property string $reject_note
 *
 * The followings are the available model relations:
 * @property CustomerTransaction[] $customerTransactions
 * @property MyMovieDiscNzb $idMyMovieDiscNzb
 * @property ResourceType $idResourceType
 * @property NzbCustomer[] $nzbCustomers
 * @property NzbCreationState[] $nzbCreationStates
 */
class Nzb extends CActiveRecord
{
	public $year;
	public $idImdb;
	public $genre;
	public $title;
	public $resourceTypeDesc;
	public $disc_name;
	public $rating;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nzb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function afterSave()
	{
		parent::afterSave();
		if($this->isNewRecord)
		{
			$nzbCreationState = new NzbCreationState();
			$nzbCreationState->Id_creation_state = 1;
			$nzbCreationState->Id_nzb = $this->Id;		
//			$nzbCreationState->user_username = Yii::app()->user->name;
			$nzbCreationState->user_username = 'admin';
			$nzbCreationState->save();				
		}
	}
	public function getCreationState()
	{
		$states = $this->nzbCreationStates;
		$currentState = new CreationState();
		if(!empty($states))
		{
			$currentState =$states[count($states)-1]; 
		}
		return $currentState;
	}
	
	public function getRejectedUser()
	{
		$username = '';
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id_nzb = ' . $this->Id);
		$criteria->addCondition('t.Id_creation_state = ' . $this->Id_creation_state);
		
		$modelNzbCreationState = NzbCreationState::model()->find($criteria);
		
		if(isset($modelNzbCreationState))
			$username = $modelNzbCreationState->user_username;
		
		return $username;
	}
	
	public function getRejectedDate()
	{
		$date = '';
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id_nzb = ' . $this->Id);
		$criteria->addCondition('t.Id_creation_state = ' . $this->Id_creation_state);
		
		$modelNzbCreationState = NzbCreationState::model()->find($criteria);
		
		if(isset($modelNzbCreationState))
			$date = $modelNzbCreationState->date;
				
		return isset($date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $date):'';
	}
	
	public function getPublishedDate()
	{
		$date = '';
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id_nzb = ' . $this->Id);
		$criteria->addCondition('t.Id_creation_state = ' . $this->Id_creation_state);
	
		$modelNzbCreationState = NzbCreationState::model()->find($criteria);
		
		if(isset($modelNzbCreationState))
			$date = $modelNzbCreationState->date;//isset($modelNzbCreationState->date)?Yii::app()->dateFormatter->formatDateTime($modelNzbCreationState->date,'small',null):'';;
	
		return isset($date)?Yii::app()->dateFormatter->format("dd/MM/yyyy", $date):'';
	}
	
	public function getAutoRipperId()
	{
		$idAutoRipper = null;
		
		$modelAutoRipper = AutoRipper::model()->findByAttributes(array('Id_nzb'=>$this->Id));
		
		if(isset($modelAutoRipper))
			$idAutoRipper = $modelAutoRipper->Id;
	
		return $idAutoRipper;
	}
	
	public function getDownloadsQty()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id_nzb = ' . $this->Id);
		$criteria->addCondition('t.Id_nzb_state = 3'); // Downloaded
		return NzbDevice::model()->count($criteria);
	}
	
	public function getDownloadsQtyByReseller()
	{
		$criteria = new CDbCriteria();
		$criteria->join = 'inner join customer_device cd on (cd.Id_device = t.Id_device)
							inner join customer c on (c.Id = cd.Id_customer)
							inner join user u on (c.Id_reseller = u.Id_reseller)';
		$criteria->addCondition('t.Id_nzb_state = 3'); // Downloaded
		$criteria->addCondition('t.Id_nzb = ' . $this->Id);
		$criteria->addCondition('u.username = "'. Yii::app()->user->name.'"');

		return NzbDevice::model()->count($criteria);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nzb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_resource_type, Id_nzb_type, Id_creation_state, Id_auto_ripper_file', 'required'),
			array('Id_resource_type, deleted, points, is_draft, Id_nzb_type, Id_nzb, Id_creation_state, Id_TMDB_data, Id_auto_ripper_file', 'numerical', 'integerOnly'=>true),
			array('url, file_name, subt_url, subt_file_name, subt_original_name, file_original_name,final_content_path, file_password, reject_note', 'length', 'max'=>255),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			array('rejected_description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_resource_type, url, file_name, subt_url, subt_file_name, subt_original_name, deleted, points, file_original_name,final_content_path, is_draft, Id_my_movie_disc_nzb, year, idImdb, genre, title, resourceTypeDesc, disc_name, file_password, Id_nzb_type, Id_nzb, rejected_description, Id_creation_state, Id_TMDB_data, Id_auto_ripper_file, reject_note, rating', 'safe', 'on'=>'search'),
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
			'customerTransactions' => array(self::HAS_MANY, 'CustomerTransaction', 'Id_nzb'),
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'resourceType' => array(self::BELONGS_TO, 'ResourceType', 'Id_resource_type'),
			'nzbDevices' => array(self::HAS_MANY, 'NzbDevice', 'Id_nzb'),
			'nzbCreationStates' => array(self::HAS_MANY, 'NzbCreationState', 'Id_nzb'),
			'nzbType' => array(self::BELONGS_TO, 'NzbType', 'Id_nzb_type'),
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'creationState' => array(self::BELONGS_TO, 'CreationState', 'Id_creation_state'),
			'TMDBData' => array(self::BELONGS_TO, 'TMDBData', 'Id_TMDB_data'),
			'autoRipperFile' => array(self::BELONGS_TO, 'AutoRipperFile', 'Id_auto_ripper_file'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_resource_type' => 'Resource Type',
			'url' => 'Url',
			'file_name' => 'File Name',
			'subt_url' => 'Subt Url',
			'subt_file_name' => 'Subt File Name',
			'subt_original_name' => 'Subt Original Name',
			'deleted' => 'Deleted',
			'points' => 'Points',
			'file_original_name' => 'File Original Name',
			'is_draft' => 'Is Draft',
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
			'name'=>'Disc Name',
			'final_content_path'=>'Path content',
			'file_password'=> 'File Password',
			'reject_note'=>'Razon',
			'title'=>'Pel&iacute;cula',
			'year'=>'A&ntilde;o',
			'rating'=>'Rating',
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
		$criteria->compare('Id_resource_type',$this->Id_resource_type);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_original_name',$this->subt_original_name,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('points',$this->points);
		$criteria->compare('file_original_name',$this->file_original_name,true);
		$criteria->compare('is_draft',$this->is_draft);
		$criteria->compare('Id_my_movie_disc_nzb',$this->Id_my_movie_disc_nzb,true);
		$criteria->compare('final_content_path',$this->final_content_path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchRejected()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	" LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
							  LEFT OUTER JOIN auto_ripper ar ON ar.Id_nzb = t.Id
										LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		
		$criteria->compare("n.original_title",$this->title, true);
		$criteria->addCondition('t.Id_nzb is null');
		$criteria->compare('t.Id_creation_state',3); // rechazada
		$criteria->compare('t.is_draft',1);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				// For each relational attribute, create a 'virtual attribute' using the public variable name
				'title' => array(
						'asc' => 'n.original_title',
						'desc' => 'n.original_title DESC',
				),
				'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchPublished()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	" LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
							  LEFT OUTER JOIN auto_ripper ar ON ar.Id_nzb = t.Id
										LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		
		$criteria->compare("n.original_title",$this->title, true);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.rating",$this->rating);
		$criteria->addCondition('t.Id_nzb is null');
		$criteria->compare('t.Id_creation_state',4); // publicada
		$criteria->compare('t.is_draft',0);
		$criteria->compare('t.deleted',0);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				// For each relational attribute, create a 'virtual attribute' using the public variable name
				'title' => array(
						'asc' => 'n.original_title',
						'desc' => 'n.original_title DESC',
				),
				'year' => array(
						'asc' => 'n.production_year',
						'desc' => 'n.production_year DESC',
				),
				'rating' => array(
						'asc' => 'n.rating',
						'desc' => 'n.rating DESC',
				),
				'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
		
	}
	
	public function searchDeleted()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join =	" LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
							  LEFT OUTER JOIN auto_ripper ar ON ar.Id_nzb = t.Id
										LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
	
		$criteria->compare("n.original_title",$this->title, true);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.rating",$this->rating);
		$criteria->addCondition('t.Id_nzb is null');
		$criteria->compare('t.Id_creation_state',4); // publicada
		$criteria->compare('t.is_draft',0);
		$criteria->compare('t.deleted',1);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				// For each relational attribute, create a 'virtual attribute' using the public variable name
				'title' => array(
						'asc' => 'n.original_title',
						'desc' => 'n.original_title DESC',
				),
				'year' => array(
						'asc' => 'n.production_year',
						'desc' => 'n.production_year DESC',
				),
				'rating' => array(
						'asc' => 'n.rating',
						'desc' => 'n.rating DESC',
				),
				'*',
		);
		$sort->defaultOrder = 't.Id DESC';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
	
	public function searchMovie()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		$criteria->join =	" LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
							  LEFT OUTER JOIN auto_ripper ar ON ar.Id_nzb = t.Id
										LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
				
		$criteria->addSearchCondition("n.original_title",$this->title);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.imdb",$this->idImdb);
		$criteria->addSearchCondition("n.genre",$this->genre);
		
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
		
		$criteria->compare('n.is_serie',0);
		$criteria->compare('ar.Id_auto_ripper_state',18); // estado finalizado
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
					'Id',
					'url',
					'file_name',
					'subt_url',
					'subt_url_name',
					'title' => array(
						        'asc' => 'n.original_title',
						        'desc' => 'n.original_title DESC',
		),
					'year' => array(
						        'asc' => 'n.production_year',
						        'desc' => 'n.production_year DESC',
		),
					'idImdb' => array(
						        'asc' => 'n.imdb',
						        'desc' => 'n.imdb DESC',
		),
					'genre' => array(
						        'asc' => 'n.genre',
						        'desc' => 'n.genre DESC',
		),
					'resourceTypeDesc' => array(
						        'asc' => 'resourceType.description',
						        'desc' => 'resourceType.description DESC',
		),
					'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchTv()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
											LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		$criteria->addSearchCondition("n.original_title",$this->title);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.imdb",$this->idImdb);
		$criteria->addSearchCondition("n.genre",$this->genre);
		$criteria->addSearchCondition("dn.name",$this->disc_name);
		
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
		
		$criteria->compare('n.is_serie',1);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
					'Id',
					'url',
					'file_name',
					'subt_url',
					'subt_url_name',
					'disc_name' => array(
								        'asc' => 'dn.name',
								        'desc' => 'dn.name DESC',
		),
					'title' => array(
						        'asc' => 'n.original_title',
						        'desc' => 'n.original_title DESC',
		),
					'year' => array(
						        'asc' => 'n.production_year',
						        'desc' => 'n.production_year DESC',
		),
					'idImdb' => array(
						        'asc' => 'n.imdb',
						        'desc' => 'n.imdb DESC',
		),
					'genre' => array(
						        'asc' => 'n.genre',
						        'desc' => 'n.genre DESC',
		),
					'resourceTypeDesc' => array(
						        'asc' => 'resourceType.description',
						        'desc' => 'resourceType.description DESC',
		),
					'*',
		);
		$sort->defaultOrder = 't.Id DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchMovieReseller()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('is_draft',0);
	
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
											LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
	
		$criteria->addSearchCondition("n.original_title",$this->title);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.imdb",$this->idImdb);
		$criteria->addSearchCondition("n.genre",$this->genre);
	
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
	
		$criteria->compare('n.is_serie',0);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
						'Id',
						'url',
						'file_name',
						'subt_url',
						'subt_url_name',
						'title' => array(
							        'asc' => 'n.original_title',
							        'desc' => 'n.original_title DESC',
		),
						'year' => array(
							        'asc' => 'n.production_year',
							        'desc' => 'n.production_year DESC',
		),
						'idImdb' => array(
							        'asc' => 'n.imdb',
							        'desc' => 'n.imdb DESC',
		),
						'genre' => array(
							        'asc' => 'n.genre',
							        'desc' => 'n.genre DESC',
		),
						'resourceTypeDesc' => array(
							        'asc' => 'resourceType.description',
							        'desc' => 'resourceType.description DESC',
		),
						'*',
		);
		$sort->defaultOrder = 't.Id DESC';
	
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
	public function searchTvReseller()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('is_draft',0);
	
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc_nzb dn ON dn.Id = t.Id_my_movie_disc_nzb
												LEFT OUTER JOIN my_movie_nzb n ON n.Id = dn.Id_my_movie_nzb";
		$criteria->addSearchCondition("n.original_title",$this->title);
		$criteria->addSearchCondition("n.production_year",$this->year);
		$criteria->addSearchCondition("n.imdb",$this->idImdb);
		$criteria->addSearchCondition("n.genre",$this->genre);
		$criteria->addSearchCondition("dn.name",$this->disc_name);
	
		$criteria->with[]='resourceType';
		$criteria->addSearchCondition("resourceType.description",$this->resourceTypeDesc);
	
		$criteria->compare('n.is_serie',1);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
						'Id',
						'url',
						'file_name',
						'subt_url',
						'subt_url_name',
						'disc_name' => array(
									        'asc' => 'dn.name',
									        'desc' => 'dn.name DESC',
		),
						'title' => array(
							        'asc' => 'n.original_title',
							        'desc' => 'n.original_title DESC',
		),
						'year' => array(
							        'asc' => 'n.production_year',
							        'desc' => 'n.production_year DESC',
		),
						'idImdb' => array(
							        'asc' => 'n.imdb',
							        'desc' => 'n.imdb DESC',
		),
						'genre' => array(
							        'asc' => 'n.genre',
							        'desc' => 'n.genre DESC',
		),
						'resourceTypeDesc' => array(
							        'asc' => 'resourceType.description',
							        'desc' => 'resourceType.description DESC',
		),
						'*',
		);
		$sort->defaultOrder = 't.Id DESC';
	
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
}