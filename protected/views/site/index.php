<?php 
if(Yii::app()->user->checkAccess('Administrator'))
	$this->redirect(NzbController::createUrl('nzb/index') );
else
	$this->redirect(NzbController::createUrl('nzb/indexReseller') );
?>