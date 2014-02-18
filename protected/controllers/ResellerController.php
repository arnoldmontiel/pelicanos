<?php

class ResellerController extends Controller
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
		$model=new Reseller;
		$modelUser = new User();
		$ass = new Assignments();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reseller']) && isset($_POST['User']))
		{
			$model->attributes=$_POST['Reseller'];
			$modelUser->attributes=$_POST['User'];
			
			if($model->validate() && $modelUser->validate())
			{
				$transaction = $model->dbConnection->beginTransaction();
				try {
					$model->save();
					$modelUser->Id_reseller = $model->Id;
					$modelUser->save();

					$ass->userid = $modelUser->username;
					$ass->data = 's:0:"";';
					$ass->itemname = 'Operator';
					$ass->save();
						
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->Id));
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
			
				
		}

		$this->render('create',array(
			'model'=>$model,
			'modelUser'=>$modelUser,
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

		if(isset($_POST['Reseller']))
		{
			$model->attributes=$_POST['Reseller'];
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
		$modelUser = new User('search');
		$modelUser->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$modelUser->attributes=$_GET['User'];

		$this->render('index',array(
			'modelUser'=>$modelUser,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reseller('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reseller']))
			$model->attributes=$_GET['Reseller'];

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
		$model=Reseller::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reseller-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
