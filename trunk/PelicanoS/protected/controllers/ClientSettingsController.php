<?php

class ClientSettingsController extends Controller
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
		$model=new ClientSettings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClientSettings']))
		{
			$model->attributes=$_POST['ClientSettings'];
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

		if(isset($_POST['ClientSettings']))
		{
			$model->attributes=$_POST['ClientSettings'];
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
		$dataProvider=new CActiveDataProvider('ClientSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ClientSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClientSettings']))
			$model->attributes=$_GET['ClientSettings'];

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
		$model=ClientSettings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionAjaxUpdateClientToLastVersion()
	{
		if(isset($_POST['Id']))
		{
			$clientSetting = ClientSettings::model()->findByPk($_POST['Id']);
			if(isset($clientSetting))
			{
				$clientSetting->need_update = true;
				$clientSetting->save();
			}				
			//$this->UpdateClientToLastVersion($_POST['Id']);
		}
	}
	public function UpdateClientToLastVersion($id)
	{
		$clientSetting = ClientSettings::model()->findByPk($id);
		if(isset($clientSetting))
		{
			$criteria = new CDbCriteria();
			$criteria->order = 'Id DESC';
			$anydvdVersion = AnydvdhdVersion::model()->find($criteria);
			
			$settings = Setting::getInstance();
			$url = "http://".$clientSetting->ip_v4.":".$clientSetting->port_v4."/workspace/PelicanoC/index.php?r=wsSettings/wsdl";
			$wsSettings = new wsSettings($url);
			$wsSettings->updateAnydvd(
				$anydvdVersion->version,
				$anydvdVersion->file_name,
				$settings->path_anydvd_download.$anydvdVersion->file_name
			);
			
			
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='client-settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
