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
		$criteria->addCondition('t.Id NOT IN(select Id_nzb from nzb_customer where Id_customer = '. $idCustomer.' and need_update = 0)');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		$arrayResponse = array();
		
		foreach ($arrayNbz as $modelNbz)
		{
			$movieResponse = new MovieResponse;
			$movieResponse->setAttributes($modelNbz);
			$arrayResponse[]=$movieResponse;
			
			$nzbCustomerDB = NzbCustomer::model()->findByPk(array('Id_nzb'=>$modelNbz->Id, 'Id_customer'=>$idCustomer));
			if($nzbCustomerDB != null)
			{
				$nzbCustomerDB->need_update = 0;
				$nzbCustomerDB->save();
			}
			else
			{
				$modelNzbCustomer = new NzbCustomer;
				
				$modelNzbCustomer->attributes = array(
												'Id_nzb'=>$modelNbz->Id,
												'Id_customer'=>$idCustomer
												);
				$modelNzbCustomer->save();
			}
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
	 * @soap
	 */
	public function setMovieState($idCustomer, $idMovie, $idState)
	{
		$model = NzbCustomer::model()->findByAttributes(array('Id_customer'=>$idCustomer, 'Id_nzb'=>$idMovie));
		
		$model->Id_movie_state = $idState;
	
		if($model->save())
			return true;
	
		return false;
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
					
					$modelImdb->save();
					
					$model->Id_imdbdata = $modelImdb->ID;
					
					if($model->save()){
						$transaction->commit();
						//$this->redirect(array('view','id'=>$model->Id));
						$this->redirect(array('findSubtitle','id'=>$model->Id));
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
				
					$modelImdb->save();
				
					if($model->save()){
						if(!empty($modelRelation) )
						{
							foreach ($modelRelation as $modelRel){
								$modelRel->need_update = 1;
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
	* Find subtitle.
	*/
	public function actionFindSubtitle($id)
	{
		$model = new Subtitle('search');
		
		if($_POST['Subtitle'])
		{
			$model->attributes = $_POST['Subtitle']; 
 			$model->searchSubtitle();
		}
		$modelOpenSubtitle = new OpenSubtitle('search');
		if($_GET['OpenSubtitle'])
			$modelOpenSubtitle->attributes = $_GET['OpenSubtitle'];
		
		$modelNzb = Nzb::model()->findByPk($id);
		
		$model->attributes = array('query'=>$modelNzb->file_name);
		 
		$this->render('findSubtitle',array(
				'model'=>$model,
				'modelOpenSubtitle'=>$modelOpenSubtitle,
				'modelNzb'=>$modelNzb
		));
	}
	
	public function actionAjaxDownloadSubtitle()
	{
		$idOpenSubtitle = $_POST['idOpenSubtitle'];
		$idNzb = $_POST['idNzb'];
		$openSubtitle = OpenSubtitle::model()->findByPk($idOpenSubtitle);
		
		$zip = Subtitle::downloadSubtitle($openSubtitle->IDSubtitleFile);

		$file = fopen('./subtitles/'.$openSubtitle->SubFileName,'x+');
		fwrite($file,gzinflate(substr(base64_decode($zip),10)));
		fclose($file);
		
		$nzb = Nzb::model()->findByPk($idNzb);
		$nzb->subt_url = Yii::app()->request->getBaseUrl(). '/subtitles/'.rawurlencode($openSubtitle->SubFileName);
		$nzb->subt_file_name = $openSubtitle->SubFileName;
		$nzb->save();
		
		
	}
	
	public function actionAjaxSearchSubtitles($searchString)
	{
		$xml_request_url = 'http://api.allsubs.org/index.php?search=heroes+season+4&language=en&limit=3';
		$xml = new SimpleXMLElement($xml_request_url, null, true);
		echo "<BR>".$xml->title;
		echo "<BR>".$xml->link;
		echo "<BR>".$xml->description;
		echo "<BR>".$xml->language;
		echo "<BR>".$xml->results;
		echo "<BR>".$xml->found_results;
			
		foreach ( $xml->items->item as $item )
		{
		echo "<BR>Title :".$item->title;
		echo "<BR>Link :".$item->link;
		echo "<BR>Filename :".$item->filename;
		echo "<BR>Files in archive :".$item->files_in_archive;
		echo "<BR>Languages :".$item->languages;
		echo "<BR>Added on :".$item->added_on;
		echo "<BR>";
			
		}
		
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
