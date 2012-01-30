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
			                    'SNzb'=>'SNzb',  // or simply 'Post'
		),
		),
		);
	}
	
	/**
	 * @param integer
	 * @return SNzb[]
	 * @soap
	 */
	public function getNextNZBs($id)
	{
		// 		$linkArray = Link::model()->findAll();
	
		// 		foreach ($linkArray as $linkItem){
		// 			$sLink = new SLink;
		// 			$sLink->attributes(array(
		// 								'Id'=>$linkItem->Id,
		// 								'description'=>$linkItem->description,
		// 								'url'=>$linkItem->url
		// 									));
		// 		}

		$criteria=new CDbCriteria;
		$criteria->addCondition(' Id > ' . $id);
		return Nzb::model()->findAll($criteria);
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
		
		if(isset($_POST['Upload']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			$file_subt=CUploadedFile::getInstance($modelUpload,'subt_file');
			
			if($modelUpload->validate())
			{				
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
				
				if(isset($_POST['Nzb']))
					$model->attributes=$_POST['Nzb'];
				
				if($model->save())
					$this->redirect(array('view','id'=>$model->Id));
			}
		}
		

		$this->render('create',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload,
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


		if(isset($_POST['Upload']) && isset($_POST['Nzb']))
		{
			$modelUpload->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($modelUpload,'file');
			$file_subt=CUploadedFile::getInstance($modelUpload,'subt_file');
			
			
			$model->attributes=$_POST['Nzb'];
			
			if($modelUpload->validate())
			{
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
				
				if(isset($_POST['Nzb']))
					$model->attributes=$_POST['Nzb'];
				
				$modelNew = new Nzb;
				$modelNew->attributes = $model->attributes;
				
				$transaction = $modelNew->dbConnection->beginTransaction();
				try {
					$model->delete();
					$transaction->commit();
					if($modelNew->save())
						$this->redirect(array('view','id'=>$modelNew->Id));
					
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
			elseif ($file == null && $file_subt == null)
			{		
				if($model->save())
					$this->redirect(array('view','id'=>$model->Id));				
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelUpload'=>$modelUpload
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

			$file = Yii::app()->file->set('./nzb/'.$model->file_name, true);
			if($file != null)
				$file->delete();
			
			$subt_file = Yii::app()->file->set('./subtitles/'.$model->subt_file_name, true);
			if($subt_file != null)
				$subt_file->delete();
			
			$model->delete();
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
