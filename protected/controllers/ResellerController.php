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
		$idReseller = isset($_POST['idReseller'])?$_POST['idReseller']:null;
		
		if(isset($idReseller))
		{
			if($idReseller == 0)
			{
				$modelReseller = new Reseller();
				$modelUser = new User();
			}
			else
			{
				$modelReseller = Reseller::model()->findByPk($idReseller);
				$modelUser = User::model()->findByAttributes(array('Id_reseller'=>$idReseller));
			}
			 
		}
	
		echo $this->renderPartial('_modalForm', array('modelReseller'=>$modelReseller, 'modelUser'=>$modelUser));
	}
	
	public function actionAjaxCheckUser()
	{
		$response = 0;
		$username = isset($_POST['username'])?$_POST['username']:null;
	
		if(isset($username))
		{
			if(User::model()->countByAttributes(array('username'=>$username)) == 0 )
				$response = 1;
		}
		echo $response;
	}
	
	public function actionAjaxSaveReseller()
	{
		$modelReseller = new Reseller();
		$modelUser = new User();
		
		$isUpdate = false;
		if(isset($_POST['Reseller']) && isset($_POST['User']))
		{		
			if(isset($_POST['Reseller']['Id']))
			{
				$modelReseller = Reseller::model()->findByPk($_POST['Reseller']['Id']);
				$modelUser = User::model()->findByAttributes(array('Id_reseller'=>$_POST['Reseller']['Id']));
				$isUpdate = true;
			}
			$modelReseller->attributes = $_POST['Reseller'];
			$modelUser->attributes = $_POST['User'];
			$modelUser->Id_profile = 3; // perfil reseller
			
			if($modelUser->validate())
			{
				$transaction = $modelReseller->dbConnection->beginTransaction();
				try {				
					
					$modelReseller->save();
					$modelReseller->refresh();
									
					$modelUser->Id_reseller = $modelReseller->Id;					
					$modelUser->save();
					
					if(!$isUpdate)
					{
						$ass = new Assignments();
						$ass->userid = $modelUser->username;
						$ass->data = 's:0:"";';
						$ass->itemname = 'Reseller';
						$ass->save();
					}
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
			else 
			{
				echo json_encode($modelUser->errors);
			}
		}	
	}
	
	public function actionAjaxDelete()
	{
		$idReseller = isset($_POST['idReseller'])?$_POST['idReseller']:null;
		
		$modelReseller = Reseller::model()->findByPk($idReseller);
		
		if(isset($modelReseller))
		{
			$transaction = $modelReseller->dbConnection->beginTransaction();
			try {				
				$modelUser = User::model()->findByAttributes(array('Id_profile'=>3, 'Id_reseller'=>$idReseller));
				Assignments::model()->deleteAllByAttributes(array('userid'=>$modelUser->username));
				User::model()->deleteAllByAttributes(array('Id_reseller'=>$modelReseller->Id));
				$modelReseller->delete();
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
