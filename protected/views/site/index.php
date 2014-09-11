<?php 
if(Yii::app()->user->checkAccess('Administrator'))
	$this->redirect(SiteController::createUrl('nzb/index') );
elseif(Yii::app()->user->checkAccess('Reseller'))
	$this->redirect(SiteController::createUrl('nzb/indexRe') );
else
	$this->redirect(SiteController::createUrl('device/indexIns') );
?>