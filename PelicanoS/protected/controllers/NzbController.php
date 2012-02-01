<?php

class NzbController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
					'classMap'=>array(
			                    'MovieResponse'=>'MovieResponse',  // or simply 'Post'
		),
		),
		);
	}
	
	/**
	 * Returns new and updated movies
	 * @param integer idCustomer
	 * @return MovieResponse[]
	 * @soap
	 */
	public function getNewMovies($idCustomer)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_customer where Id_customer = '. $idCustomer.')');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();
		
		foreach ($arrayNbz as $modelNbz)
		{
			$movieResponse = new MovieResponse;
			$movieResponse->setAttributes($modelNbz);
			$arrayResponse[]=$movieResponse;
			
// 			$modelNzbCustomer = new NzbCustomer;
// 			$modelNzbCustomer->attributes = array(
// 											'Id_nzb'=>$modelNbz->Id,
// 											'Id_customer'=>$idCustomer,
// 											'need_update'=>false
// 											);
// 			$modelNzbCustomer->save();
		}

		return $arrayResponse;
	}

	/**
	 * 
	 * Change movie status in relation customer/nzb
	 * @param integer $idCustomer
	 * @param integer $idMovie
	 * @param integer $idState
	 * @return boolean
	 */
	public function setMovieState($idCustomer, $idMovie, $idState)
	{
		$model = NzbCustomer::model()->findByPk(array('Id_customer'=>$idCustomer, 'Id_nzb'=>$idMovie));
		
		$model->Id_movie_state = $idState;
	
		if($model->save())
			return true;
	
		return true;
	}
	
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

	public function actionUploadError()
	{
		$this->render('uploadError');
	}
	
	public function actionAjaxDownloadFile($fileName, $root)
	{
		$myfile = Yii::app()->file->set('./'.$root.'/'.$fileName, true);
		echo $myfile->send();
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Nzb;
		$modelUpload=new Upload;
		$modelImdb = new Imdbdata;
		
		
		if(isset($_POST['Upload']) && isset($_POST['Imdbdata']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$modelImdb->attributes=$_POST['Imdbdata'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			$file_subt=CUploadedFile::getInstance($modelUpload,'subt_file');
			
			if($modelUpload->validate())
			{		
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($file != null)
					{
						$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
						$model->file_name = $file->getName();
					
						$this->saveFile($file, 'nzb');
					}
					
					if($file_subt != null)
					{
						$model->subt_url = Yii::app()->request->getBaseUrl(). '/subtitles/'.rawurlencode($file_subt->getName());
						$model->subt_file_name = $file_subt->getName();
					
						$this->saveFile($file_subt, 'subtitles');
					}
					
					$modelImdb->save();
					
					$model->Id_imdbdata = $modelImdb->ID;
					
					if($model->save()){
						$transaction->commit();
						$this->redirect(array('view','id'=>$model->Id));
					}
					
				} catch (Exception $e) {
					$transaction->rollback();
				}		
			}
		}
		

		$this->render('create',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelImdb'=>$modelImdb,
		));
	}

	
	private function saveFile($file, $root)
	{
		if($file != null)
		{		
			if(! $file->saveAs('./'.$root.'/'.$file->getName()))
			{
				$this->redirect(array('uploadError'));
			}
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelUpload=new Upload;
		$modelImdb = Imdbdata::model()->findByPk($model->Id_imdbdata);

		if(isset($_POST['Upload']) && isset($_POST['Imdbdata']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$modelImdb->attributes=$_POST['Imdbdata'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			$file_subt=CUploadedFile::getInstance($modelUpload,'subt_file');
			
			if($modelUpload->validate())
			{
				$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$id));
				
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($file != null)
					{
						$model->url = Yii::app()->request->getBaseUrl(). '/nzb/'.rawurlencode($file->getName());
						$model->file_name = $file->getName();
						
						$this->saveFile($file, 'nzb');
					}
					
					if($file_subt != null)
					{
						$model->subt_url = Yii::app()->request->getBaseUrl(). '/subtitles/'.rawurlencode($file_subt->getName());
						$model->subt_file_name = $file_subt->getName();
	
						$this->saveFile($file_subt, 'subtitles');
					}
				
					$modelImdb->save();
				
					if($model->save()){
						if(!empty($modelRelation) )
						{
							foreach ($modelRelation as $modelRel){
								$modelRel->need_update = true;
								$modelRel->save();
							}
						}
						$transaction->commit();
						$this->redirect(array('view','id'=>$model->Id));
					}
					
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
// 			elseif ($file == null && $file_subt == null)
// 			{		
// 				if($model->save())
// 					$this->redirect(array('view','id'=>$model->Id));				
// 			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
			'modelImdb'=>$modelImdb,
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
			// we only allow deletion via POST request
			$model = $this->loadModel($id);

			$transaction = $model->dbConnection->beginTransaction();
			try {

// 				$file = Yii::app()->file->set('./nzb/'.$model->file_name, true);
// 				if($file != null)
// 					$file->delete();
					
// 				$subt_file = Yii::app()->file->set('./subtitles/'.$model->subt_file_name, true);
// 				if($subt_file != null)
// 					$subt_file->delete();

				$modelRelation = NzbCustomer::model()->findAllByAttributes(array('Id_nzb'=>$id));
				if(!empty($modelRelation) )
				{
					foreach ($modelRelation as $modelRel){
						$modelRel->delete();
					}
				}
				
				$modelImdbdata = Imdbdata::model()->findByPk($model->Id_imdbdata);
				
				$model->delete();
				
				$modelImdbdata->delete();
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
		$dataProvider=new CActiveDataProvider('Nzb');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Nzb('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Nzb']))
			$model->attributes=$_GET['Nzb'];

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
		$model=Nzb::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='nzb-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
