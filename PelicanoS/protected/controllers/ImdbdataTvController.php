<?php

class ImdbdataTvController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImdbdataTv;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImdbdataTv']))
		{
			$model->attributes=$_POST['ImdbdataTv'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {

				$validator = new CUrlValidator();
				if($model->Poster!='' && $validator->validateValue($model->Poster))
				{
					$content = file_get_contents($model->Poster);
					if ($content !== false) {
						$file = fopen("./images/".$model->ID.".jpg", 'w');
						fwrite($file,$content);
						fclose($file);
						$model->Poster_local = $model->ID.".jpg";
					} else {
						// an error happened
					}
				}

				$modelS = new Season;
				$modelS->attributes = array('Id_imdbdata_tv'=>$model->ID,
												'season'=>1,
												'episodes'=>1);
				
				if($model->save()){
					$modelS->save();
					$transaction->commit();
					$this->redirect(array('setSeason','id'=>$model->ID));
				}
				
				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionSetSeason($id)
	{
		$model=$this->loadModel($id);
		$modelSeason = new Season;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$modelSeason->Id_imdbdata_tv = $id;
		
		if(isset($_GET['Season']))
			$modelSeason->attributes=$_GET['Season'];
		
		$this->render('setSeason',array(
				'model'=>$model,
				'modelSeason'=>$modelSeason
		));
	}
	
	public function actionAjaxAddSeasons()
	{
		$seasonQty = $_POST['seasonQty'];
		$id = $_GET['id'];
		
		$transaction = ImdbdataTv::model()->dbConnection->beginTransaction();
		try {
			Season::model()->deleteAllByAttributes(array('Id_imdbdata_tv'=>$id));
			$season = 1;
			while ($season <= $seasonQty) {
				$modelS = new Season;
				$modelS->attributes = array('Id_imdbdata_tv'=>$id,
												'season'=>$season,
												'episodes'=>1);
				$modelS->save();
				$season = $season + 1;
			}
			$this->updateRelation($id);
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	private function updateRelation($id)
	{
		$modelRelation = ImdbdataTvCustomer::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));
	
		if(!empty($modelRelation) )
		{
			foreach ($modelRelation as $modelRel){
				$modelRel->need_update = 1;
				$modelRel->save();
			}
		}
	}
	
	public function actionAjaxAddNewSeason()
	{
		$id = $_GET['id'];
		$modelDB = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));
		$modelSeason = new Season;
		
		$modelSeason->attributes = array('Id_imdbdata_tv'=>$id,
												 'season'=>count($modelDB) +1,
												'episodes'=>1 );
		$modelSeason->save();
		$this->updateRelation($id);
	}
	
	public function actionAjaxDeleteSeason()
	{
		$id = $_GET['id'];
		$modelDB = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));
		Season::model()->deleteByPk(array('Id_imdbdata_tv'=>$id, 'season'=>count($modelDB)));	
		$this->updateRelation($id);
	}
	
	public function actionAjaxUpdateEpisode()
	{
		$id = $_POST['id']; 
		$season = $_POST['season']; 
		$episodes= $_POST['episodes'];
		$model = Season::model()->findByPk(array('Id_imdbdata_tv'=>$id,'season'=>$season));
		$model->episodes = $episodes;
		if($model->save()){
			$this->updateRelation($id);
			return true;
		}
		return false;
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImdbdataTv']))
		{
			$model->attributes=$_POST['ImdbdataTv'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			
			$transaction = $model->dbConnection->beginTransaction();
			try {

				Season::model()->deleteAllByAttributes(array('Id_imdbdata_tv'=>$id));
				
				// we only allow deletion via POST request
				$model->delete();
				
				$transaction->commit();
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ImdbdataTv',array('criteria'=>array('condition'=>'Id_parent is null')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionViewSeason($id=null, $season=null)
	{
		$modelImdb = new ImdbdataTv;
		$ddlTvShow = ImdbdataTv::model()->findAllByAttributes(array('Id_parent'=>null));
		$emptyArray = array();
		$ddlSeason = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=> ($id != null) ? $id : $emptyArray));
		
		$condition = 'Id_parent = 1';
		
		if($id!=null)
		{
			$modelImdb->Id_parent = $id;
			$condition = 'Id_parent = "'. $id . '"';
			if($season != null)
			{
				$modelImdb->Season = $season;
				$condition .= ' AND Season = '. $season;
			}
		}
		
		$dataProvider=new CActiveDataProvider('ImdbdataTv',array('criteria'=>array('condition'=>$condition)));
		
		
		$this->render('viewSeason',array(
					'model'=>$modelImdb,
					'ddlTvShow'=>$ddlTvShow,
					'ddlSeason'=>$ddlSeason,
					'dataProvider'=>$dataProvider
		));
	}
	
	public function actionAjaxSearch()
	{
		$modelImdb = new ImdbdataTv;
		$condition = '';
		if(isset($_POST['season']) && isset($_POST['idParent']))
		{
			
			$condition .= 'Id_parent = "'. trim($_POST['idParent']) . '"';
			if($_POST['season'] != "")
				$condition .= ' AND Season = '. trim($_POST['season']);
			
		}
		
		$dataProvider=new CActiveDataProvider('ImdbdataTv',array('criteria'=>array('condition'=>$condition)));
		
		$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'summaryText' =>"",
		));
	}
	
	public function actionAjaxFillSeason()
	{
		$id = $_POST['ImdbdataTv']['Id_parent'];
	
		//please enter current controller name because yii send multi dim array
		$data = Season::model()->findAllByAttributes(array('Id_imdbdata_tv'=>$id));
	
		$data = CHtml::listData($data,'season','season');
		$ddlSeason = CHtml::tag('option',
			array('value'=>''),'Select..',true);
		foreach($data as $value=>$name)
		{
			$ddlSeason .= CHtml::tag('option',
			array('value'=>$value),CHtml::encode($name),true);
		}
	
		echo CJSON::encode(array(
			  'season'=>$ddlSeason,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ImdbdataTv('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImdbdataTv']))
			$model->attributes=$_GET['ImdbdataTv'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ImdbdataTv::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imdbdata-tv-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
