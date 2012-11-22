<?php
class UploadController extends Controller
{
	function actionIndex()
	{
		
		$uploaded = false;
		$model=new Upload();
		$modelLink = new Link;
		
		if(isset($_POST['Upload']))
		{
			$model->attributes=$_POST['Upload'];
			$file=CUploadedFile::getInstance($model,'file');
			if($model->validate()){
				
				if(isset($_POST['Link']))
					$modelLink->attributes = $_POST['Link'];  
				$modelLink->url = Yii::app()->request->getBaseUrl(). '/nzb/'.$file->getName();
				$modelLink->file_name = $file->getName();
				$uploaded = $file->saveAs('./nzb/'.$file->getName());
				$modelLink->save();
				if($modelLink->save())
					$this->redirect(array('link/index'));
			}
		}
		
		$this->render('index', array(
		'model' => $model,
		'modelLink' => $modelLink,
		'uploaded' => $uploaded,
		));
	}
}