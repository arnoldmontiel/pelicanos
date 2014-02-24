<?php 
if(Yii::app()->user->checkAccess('Administrator'))
	$this->redirect(SiteController::createUrl('nzb/index') );
else
	$this->redirect(SiteController::createUrl('nzb/indexRe') );
?>