<?php

class CustomerUsersController extends Controller
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CustomerUsers;

		// Uncomment the following line if AJAX validation is needed
	    //$this->performAjaxValidation($model);

		if(isset($_POST['CustomerUsers']))
		{
			$model->attributes=$_POST['CustomerUsers'];
			if($model->save())
				return true;
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAjaxCreate()
	{
		$model=new CustomerUsers;
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['CustomerUsers']))
		{
			$model->attributes=$_POST['CustomerUsers'];
			if($model->save())
			{
				$this->updateDevice($model->Id_customer);
				echo json_encode($model->attributes);
			}
		}
	}
	
	private function updateDevice($idCustomer)
	{
		$array = CustomerDevice::model()->findAllByAttributes(array('Id_customer'=>$idCustomer));
		foreach($array as $item)
		{
			$item->need_update = 1;
			$item->save();
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($username, $idCustomer)
	{
		$model=CustomerUsers::model()->findByAttributes(array('username'=>$username,'Id_customer'=>$idCustomer));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CustomerUsers']))
		{
			$model->attributes=$_POST['CustomerUsers'];
			$this->updateDevice($model->Id_customer);
			if($model->save())
				$this->redirect(array('customer/view','id'=>$model->Id_customer));
		}

		$this->render('updateUser',array(
			'model'=>$model,
		));
	}

	
	public function actionAjaxUpdateUserCustomer()
	{
	
		$username = isset($_GET['username'])?$_GET['username']:'';
		$idCustomer = isset($_GET['idCustomer'])?$_GET['idCustomer']:'';
		
		if(!empty($username) && !empty($idCustomer))
		{
			$userCustomerDb = CustomerUsers::model()->findByAttributes(array('username'=>$username,'Id_customer'=>$idCustomer));
			
			if(isset($userCustomerDb))
			{
				$this->redirect(array('update','username'=>$username,'idCustomer'=>$idCustomer));
			}
		}
		
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CustomerUsers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerUsers']))
			$model->attributes=$_GET['CustomerUsers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
