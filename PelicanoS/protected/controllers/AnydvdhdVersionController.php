<?php

class AnydvdhdVersionController extends Controller
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
		$model=new AnydvdhdVersion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AnydvdhdVersion']))
		{
			$model->attributes=$_POST['AnydvdhdVersion'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AnydvdhdVersion']))
		{
			$model->attributes=$_POST['AnydvdhdVersion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
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
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AnydvdhdVersion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionAjaxUpdateWithLastVersion()
	{
		$this->UpdateToLastFile();
	}
	public function UpdateToLastFile()
	{		
		$anydvdhd = new AnydvdhdVersion();
		$path = "./downloads/";//get from settings
				
		$version_content = @file_get_contents("http://update.slysoft.com/update/AnyDVD.ver");
		$version_array = explode(":", $version_content);
		$version = str_replace( "\n", "", $version_array[1]);
		$anydvdhd->version = $version;
		
		$anydvdhd_db = AnydvdhdVersion::model()->findByAttributes(array('version'=>$version));
		if(!isset($anydvdhd_db))
		{
			try {
				$version = str_replace( ".", "", $version);
				$fileName= "SetupAnyDVD".$version.".exe";
				$anydvdhd->file_name = $fileName;
					
				$content = @file_get_contents("http://static.slysoft.com/SetupAnyDVD.exe");
				if ($content !== false) {
					//$setting = Setting::getInstance();
					$file = fopen($path.$fileName, 'w');
					fwrite($file,$content);
					fclose($file);
					$anydvdhd->save();
				} else {
					// an error happened
				}
				
			}
			catch (Exception $e)
			{
				// an error happened
			}
		}
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AnydvdhdVersion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AnydvdhdVersion']))
			$model->attributes=$_GET['AnydvdhdVersion'];

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
		$model=AnydvdhdVersion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='anydvdhd-version-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
