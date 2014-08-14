<?php

class ConsumptionController extends Controller
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
	 */
	public function actionIndex()
	{
		$model = new Consumption('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Consumption']))
			$model->attributes=$_GET['Consumption'];
		
		$this->render('index',array(
				'model'=>$model,
		));
	}

	public function actionAjaxConsumptionDetail()
	{
		$idCustomer = $_POST['idCustomer'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		$modelConsumptions=new Consumption('search');
		$modelConsumptions->unsetAttributes();  // clear any default values
		if(isset($_GET['Consumption']))
			$modelConsumptions->attributes=$_GET['Consumption'];
		
		$modelConsumptions->Id_customer = $idCustomer;
		$modelConsumptions->month = $month;
		$modelConsumptions->year = $year;
		$this->renderPartial('_consumptionDetail',array('modelConsumptions'=>$modelConsumptions, 'month'=>$month, 'year'=>$year));
	}
	
	public function actionAjaxConsumptionDetailByReseller()
	{
		$idReseller = $_POST['idReseller'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		$modelConsumptions=new Consumption('search');
		$modelConsumptions->unsetAttributes();  // clear any default values
		if(isset($_GET['Consumption']))
			$modelConsumptions->attributes=$_GET['Consumption'];
		
		$modelConsumptions->Id_reseller = $idReseller;
		$modelConsumptions->month = $month;
		$modelConsumptions->year = $year;
		$this->renderPartial('_consumptionDetail',array('modelConsumptions'=>$modelConsumptions, 'month'=>$month, 'year'=>$year));
	}
	
	public function actionAjaxRegisterCustomerPayment()
	{
		$idCustomer = $_POST['idCustomer'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		$criteria=new CDbCriteria;		
		$criteria->addCondition('Id_customer = '. $idCustomer);
		$criteria->addCondition('MONTH(date) = '.$month);
		$criteria->addCondition('YEAR(date) = '.$year);
		
		Consumption::model()->updateAll(array('already_paid'=>1, 'paid_date'=>new CDbExpression('NOW()')),$criteria);
		
		CustomerDevice::model()->updateAll(array('need_update_consumption'=>1), 'Id_customer = '. $idCustomer);
		
		echo json_encode(array('qtyByCustomer'=>Consumption::pendingQtyByCustomer(),
							 'qtyByReseller'=>Consumption::pendingQtyByReseller(),
							 'pointsPaid'=>Consumption::pointsAccumulated(),
							 'pointsPending'=>Consumption::pointsAccumulated(false)
						));
	}
	
	public function actionAjaxRegisterResellerPayment()
	{
		$idReseller = $_POST['idReseller'];
		$month = $_POST['month'];
		$year = $_POST['year'];
	
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_customer IN (select Id from customer where Id_reseller = '.$idReseller.') ');		
		$criteria->addCondition('MONTH(date) = '.$month);
		$criteria->addCondition('YEAR(date) = '.$year);
	
		Consumption::model()->updateAll(array('already_paid'=>1, 'paid_date'=>new CDbExpression('NOW()')),$criteria);
		
		CustomerDevice::model()->updateAll(array('need_update_consumption'=>1), 'Id_customer IN (select cu.Id from customer cu 
											inner join consumption c on (c.Id_customer = cu.Id) where cu.Id_reseller = '.$idReseller.') ');
		
		echo json_encode(array('qtyByCustomer'=>Consumption::pendingQtyByCustomer(),
							 'qtyByReseller'=>Consumption::pendingQtyByReseller(),
							'pointsPaid'=>Consumption::pointsAccumulated(),
							'pointsPending'=>Consumption::pointsAccumulated(false)
						));
	
	}
	
	public function actionGeneratePDF()
	{
	
		include('js/mpdf/mpdf.php');
		ob_end_clean();

		$mpdf=new mPDF('utf-8','A4');
		$stylesheet = file_get_contents('css/bootstrap.min.css');
		$stylesheet2 = file_get_contents('protected/views/layouts/estilos.php');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($stylesheet2,1);
		$mpdf->WriteHTML(PelicanoHelper::generateTicketPDF(),2);
		$mpdf->Output();
		
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Consumption::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consumption-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
