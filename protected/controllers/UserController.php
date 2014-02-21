<?php

class UserController extends Controller
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
			'accessControl', // perform access control for CRUD operasutions
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

	public function actionAjaxOpenForm()
	{
		$username = isset($_POST['username'])?$_POST['username']:null;
		$idProfile = isset($_POST['idProfile'])?$_POST['idProfile']:null;
		
		if(isset($username))
		{
			if($username == '0')
				$modelUser = new User();
			else
				$modelUser = User::model()->findByPk($username);
						
			$modelUser->Id_profile = $idProfile;
			
			echo $this->renderPartial('_modalForm', array('modelUser'=>$modelUser));
		}		
	}
	
	public function actionAjaxSaveUser()
	{		
	
		if(isset($_POST['User']))
		{
			if(isset($_POST['User']['username']))
				$modelUser = User::model()->findByPk($_POST['User']['username']);

			if(!isset($modelUser))
				$modelUser = new User();
			
			$modelUser->attributes = $_POST['User'];
				
			if($modelUser->validate())
			{
				$modelUser->save();
				
				$itemname = 'MovieAdmin';
				if($modelUser->Id_profile == 1)
					$itemname = 'Administrator';
				
				$ass = new Assignments();
				$ass->userid = $modelUser->username;
				$ass->data = 's:0:"";';
				$ass->itemname = $itemname;
				$ass->save();
			}
			else
			{
				echo json_encode($modelUser->errors);
			}
		}
	}
	
	public function actionAjaxDelete()
	{
		$username = isset($_POST['username'])?$_POST['username']:null;
	
		$modelUser = User::model()->findByPk($username);
	
		if(isset($modelUser))
		{
			$transaction = $modelUser->dbConnection->beginTransaction();
			try {
				$modelUser->delete();
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
