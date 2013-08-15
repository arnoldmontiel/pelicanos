<?php

class AutoRipperController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
		$model=new AutoRipper;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AutoRipper']))
		{
			$model->attributes=$_POST['AutoRipper'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelMyMovieAPIRequest = new MyMovieAPIRequest;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['hiddenTitleId']))
		{			
			$idTitle = $_POST['hiddenTitleId'];			
				
			if(!empty($idTitle))
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					
					//guardo los datos de mymovies
					$idMyMovieDiscNzb = MyMovieHelper::saveMyMovieData($idTitle, $model->Id_disc);

					if(isset($_POST['hiddenTitleId']))
					{
						$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($idMyMovieDiscNzb);
						if(isset($modelMyMovieDiscNzb))
						{
							$modelMyMovieDiscNzb->name = $_POST['hiddenDiscName'];
							$modelMyMovieDiscNzb->save();
						}
					}
					
					
					if(isset($idMyMovieDiscNzb))
					{
						$modelNzb = Nzb::model()->findByPk($model->Id_nzb);
						if(!isset($modelNzb))
						{
							$modelNzb = new Nzb();
							$modelNzb->Id_resource_type = 1; //bluray
						}
						$fileName = $model->name . '.nzb';
						$modelNzb->file_name =  $fileName;
						$modelNzb->file_original_name =  $fileName;
						$modelNzb->url = '/nzb/'.$fileName;
						
						$modelNzb->Id_my_movie_disc_nzb = $idMyMovieDiscNzb;
						
						$modelNzb->save();
						$model->Id_nzb = $modelNzb->Id;
					}					
					
					if($model->save()){
						
						//marco que ya esta el NZB
						$nzbCreationState = new NzbCreationState();
						$nzbCreationState->Id_creation_state = 2;
						$nzbCreationState->Id_nzb = $model->Id_nzb;
						$nzbCreationState->user_username = Yii::app()->user->name;
						$nzbCreationState->save();
						
						//marco que ya esta subido a usenet
						$nzbCreationState = new NzbCreationState();
						$nzbCreationState->Id_creation_state = 3;
						$nzbCreationState->Id_nzb = $model->Id_nzb;
						$nzbCreationState->user_username = Yii::app()->user->name;
						$nzbCreationState->save();
						
						$transaction->commit();
						$this->redirect(array('admin'));
					}
						
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}

		$rawData = array();
		
		if(isset($_GET['MyMovieAPIRequest']))
		{
			$modelMyMovieAPIRequest->setAttributes($_GET['MyMovieAPIRequest']);
				
			if($_GET['rbnSearchField'] == 'title')
				$rawData = MyMovieHelper::searchTitles($modelMyMovieAPIRequest->Title, $modelMyMovieAPIRequest->Country);
			else
				$rawData = MyMovieHelper::searchTitlesByIMDBId($modelMyMovieAPIRequest->Title, $modelMyMovieAPIRequest->Country);
				
		}
		else
			$rawData = MyMovieHelper::searchTitlesByDiscId($model->Id_disc,'');
		
		$arrayDataProvider=new CArrayDataProvider($rawData, array(
						    'id'=>'id',
						 	'sort'=>array(
								'attributes'=>array('year', 'type', 'country'),
		),
		
						          'pagination'=>array('pageSize'=>10),
		
		));
		
		$this->render('update',array(
			'model'=>$model,
			'arrayDataProvider'=>$arrayDataProvider,
			'modelMyMovieAPIRequest'=>$modelMyMovieAPIRequest,
		));
	}

	public function actionAjaxGetMovieMoreInfo()
	{
		$idTitle = isset($_POST['titleId'])?$_POST['titleId']:null;
	
		if(isset($idTitle))
		{
			$model = MyMovieHelper::getMyMovieData($idTitle,false);
			echo $this->renderPartial('_viewInfo', array(
															'model'=>$model,
			));
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AutoRipper');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AutoRipper('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AutoRipper']))
			$model->attributes=$_GET['AutoRipper'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminState($id)
	{
		$model=new AutoRipperAutoRipperState('search');
		$model->unsetAttributes();  // clear any default values
		$model->Id_auto_ripper = $id;
		if(isset($_GET['AutoRipperAutoRipperState']))
			$model->attributes=$_GET['AutoRipperAutoRipperState'];
	
		$this->render('adminState',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AutoRipper the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AutoRipper::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AutoRipper $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='auto-ripper-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
