<?php
class PelicanoHelper {
	static public function encrypt($val)
	{
		$result="";
		for($i=0; $i<strlen($val); $i++)
		{
			$item =$val[$i];
			if($i==4)
			{
				$item=chr(ord($item) - 2);
			}
			if($i%2==0)
			{
				$result.=chr(ord($item) - 1);
			}
			else
			{
				$result.=++$item;				
			}
		}
		return $result;
		
	}
	static public function format_bytes($a_bytes) {
		if ($a_bytes < 1024) {
			return $a_bytes . ' B';
		} elseif ($a_bytes < 1048576) {
			return round ( $a_bytes / 1024, 2 ) . ' KB';
		} elseif ($a_bytes < 1073741824) {
			return round ( $a_bytes / 1048576, 2 ) . ' MB';
		} elseif ($a_bytes < 1099511627776) {
			return round ( $a_bytes / 1073741824, 2 ) . ' GB';
		} elseif ($a_bytes < 1125899906842624) {
			return round ( $a_bytes / 1099511627776, 2 ) . ' TB';
		}
	}
	static public function format_kbytes($a_kbytes) {
		if ($a_kbytes < 1024) {
			return $a_kbytes . ' KB';
		} elseif ($a_kbytes < 1048576) {
			return round ( $a_kbytes / 1024, 2 ) . ' MB';
		} elseif ($a_kbytes < 1073741824) {
			return round ( $a_kbytes / 1048576, 2 ) . ' GB';
		}
	}
	static public function getImageName($name, $posFix = "") {
		$pos = strpos ( $name, "?" );
		$fileName = $name;
		if (($pos !== false)) {
			$fileName = explode ( '?', $name );
			$fileName = $fileName [0];
		}
		$imagePath = "images/";
		$defaultImage = 'no_image' . $posFix . '.jpg';
		$imageName = $imagePath . $defaultImage;
		if (file_exists ( $imagePath . $fileName ) && ! empty ( $name ))
			$imageName = $imagePath . $name;
		
		return $imageName;
	}
	
	static public function generatePassword( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
	static public function generateTicketPDF($model)
	{
		$monthName = date('F', mktime(0, 0, 0, $model->month));
		
		$criteria=new CDbCriteria;
		if(isset($model->Id_reseller))
		{
			$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
			$criteria->addCondition('c.Id_reseller = '. $model->Id_reseller);
		}
		else 
			$criteria->addCondition('t.Id_customer = '. $model->Id_customer);
		
		$criteria->addCondition('MONTH(t.date) = '. $model->month);
		$criteria->addCondition('YEAR(t.date) = '. $model->year);
		
		$modelConsumptions = Consumption::model()->findAll($criteria);
		$bodyGrid = '<tbody>';
		$count = 1; 
		$acumPoints = 0;
		$idConsumptionConfig = null;
		foreach($modelConsumptions as $data)
		{
			$title = 'No Identificado';
			
			if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
				$title = $data->nzb->myMovieDiscNzb->myMovieNzb->original_title;
			
			$bodyGrid .= '<tr>';
				$bodyGrid .= '<td>' . $count . '</td>';
				$bodyGrid .= '<td>' . $title . '</td>';
				$bodyGrid .= '<td>' . $data->date . '</td>';
				$bodyGrid .= '<td>' . $data->points . '</td>';
			$bodyGrid .= '</tr>';
			
			$acumPoints = $acumPoints + $data->points;
			$count ++;
			$idConsumptionConfig = $data->Id_consumption_config;
		}
			$bodyGrid .= '<tr>';
				$bodyGrid .= '<td colspan="3" class="align-right tdGrey">CONSUMOS '.$monthName.' '.$model->year.'</td>';
				$bodyGrid .= '<td class="align-right tdGrey">'.$acumPoints.'</td>';
			$bodyGrid .= '</tr>';
		$bodyGrid .= '</tbody>';			
		
		$valuePerPoint = 0;
		$currency = '';
		if(!isset($idConsumptionConfig))
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.username = "'.Yii::app()->user->name.'"');
			$criteria->order = 't.Id DESC';
			$modelConsumptionConfig = ConsumptionConfig::model()->find($criteria);
		}
		else
			$modelConsumptionConfig = ConsumptionConfig::model()->findByPk($idConsumptionConfig);
			
		if(isset($modelConsumptionConfig))
		{
			$valuePerPoint = $modelConsumptionConfig->value;
			$currency = $modelConsumptionConfig->currency->symbol;
		}
				
		return '<div class="container" id="screenReadOnly">
						<div class="row facturaCabecera facturaBloque">
							<div class="col-sm-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="50%">		
												<div class="facturaCliente">'.$model->customer->fullName.'</div>
												<div class="facturaPeriodo">Consumos '.$monthName.' '.$model->year.'</div>
											</td>
											<td width="50%" align="right">
												<img src="images/logoBIG.jpg" width="200" height="56"/>
											</td>
										</tr>
									</tbody>
								</table>		
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
								<table class="tablaPDF" cellpadding="5">
									<thead>
										<tr>
											<th>#</th>
											<th>Pel&iacute;cula</th>
											<th>Fecha</th>
											<th class="align-right">Valor</th>
										</tr>
									</thead>
									'.$bodyGrid.'
								</table>
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
							<table class="tablaTOTALCont">
								<tbody>
									<tr>
										<td class="halfSizeCell">&nbsp;</td>
										<td class="halfSizeCell">
											<table class="tablaTOTAL" width="400" cellpadding="5">
												<tbody>
													<tr>
													<td colspan="2"><div class="titleTOTAL">TOTAL</div></td>
													</tr>
													<tr>
													<td>'.$acumPoints.'</td>
													<td class="align-right">x '.$currency.$valuePerPoint.'</td>
													</tr>
													<tr>
													<td colspan="2" class="align-right"><div class="valorTOTAL">'.$currency.$acumPoints * $valuePerPoint.'</div></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
					</div><!-- CIERRE CONTAINER -->';
	}
	
	static public function generateTicketPDFByReseller($model)
	{
	
		$monthName = date('F', mktime(0, 0, 0, $model->month));
		
		$modelReseller = Reseller::model()->findByPk($model->Id_reseller);
		
		$criteria=new CDbCriteria;
		
		$criteria->join = 'inner join customer c on (t.Id_customer = c.Id)';
		$criteria->addCondition('c.Id_reseller = '. $model->Id_reseller);
	
		$criteria->addCondition('MONTH(t.date) = '. $model->month);
		$criteria->addCondition('YEAR(t.date) = '. $model->year);
		
		$modelConsumptions = Consumption::model()->findAll($criteria);
		
		$bodyGrid = '<tbody>';
		$count = 1;
		$acumPoints = 0;
		$idConsumptionConfig = null;
		foreach($modelConsumptions as $data)
		{
			$customer = 'No Identificado';
				
			if(isset($data->customer))
				$customer = $data->customer->fullName;
				
			$bodyGrid .= '<tr>';
			$bodyGrid .= '<td>' . $count . '</td>';
			$bodyGrid .= '<td>' . $customer . '</td>';
			$bodyGrid .= '<td>' . $data->date . '</td>';
			$bodyGrid .= '<td>' . $data->points . '</td>';
			$bodyGrid .= '</tr>';
				
			$acumPoints = $acumPoints + $data->points;
			$count++;
			$idConsumptionConfig = $data->Id_consumption_config;
		}
		$bodyGrid .= '<tr>';
		$bodyGrid .= '<td colspan="3" class="align-right tdGrey">CONSUMOS '.$monthName.' '.$model->year.'</td>';
		$bodyGrid .= '<td class="align-right tdGrey">'.$acumPoints.'</td>';
		$bodyGrid .= '</tr>';
		$bodyGrid .= '</tbody>';
	
		$valuePerPoint = 0;
		$currency = '';
		if(!isset($idConsumptionConfig))
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.username = "'.Yii::app()->user->name.'"');
			$criteria->order = 't.Id DESC';
			$modelConsumptionConfig = ConsumptionConfig::model()->find($criteria);
		}
		else
			$modelConsumptionConfig = ConsumptionConfig::model()->findByPk($idConsumptionConfig);
			
		
		if(isset($modelConsumptionConfig))
		{
			$valuePerPoint = $modelConsumptionConfig->value;
			$currency = $modelConsumptionConfig->currency->symbol;
		}
		
		return '<div class="container" id="screenReadOnly">
						<div class="row facturaCabecera facturaBloque">
							<div class="col-sm-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="50%">
												<div class="facturaCliente">'.$modelReseller->description.'</div>
												<div class="facturaPeriodo">Consumos '.$monthName.' '.$model->year.'</div>
											</td>
											<td width="50%" align="right">
												<img src="images/logoBIG.jpg" width="200" height="56"/>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
								<table class="tablaPDF" cellpadding="5">
									<thead>
										<tr>
											<th>#</th>
											<th>Cliente</th>
											<th>Fecha</th>
											<th class="align-right">Valor</th>
										</tr>
									</thead>
									'.$bodyGrid.'
								</table>
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
							<table class="tablaTOTALCont">
								<tbody>
									<tr>
										<td class="halfSizeCell">&nbsp;</td>
										<td class="halfSizeCell">
											<table class="tablaTOTAL" width="400" cellpadding="5">
												<tbody>
													<tr>
													<td colspan="2"><div class="titleTOTAL">TOTAL</div></td>
													</tr>
													<tr>
													<td>'.$acumPoints.'</td>
													<td class="align-right">x '.$currency.$valuePerPoint.'</td>
													</tr>
													<tr>
													<td colspan="2" class="align-right"><div class="valorTOTAL">'.$currency.$acumPoints * $valuePerPoint.'</div></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
					</div><!-- CIERRE CONTAINER -->';
	}
}