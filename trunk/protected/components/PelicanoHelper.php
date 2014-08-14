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
	static public function generateTicketPDF() {
		return '<div class="container" id="screenReadOnly">
						<div class="row facturaCabecera facturaBloque">
							<div class="col-sm-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="50%">		
												<div class="facturaCliente">Juan Perez</div>
												<div class="facturaPeriodo">Consumos Mayo 2015</div>
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
									<tbody>
										<tr>
											<td>1</td>
											<td>Pacific Rim</td>
											<td>2014-05-08 00:00:00</td>
											<td class="align-right">50</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Juno</td>
											<td>2014-05-08 00:00:00</td>
											<td class="align-right">50</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Borat</td>
											<td>2014-05-08 00:00:00</td>
											<td class="align-right">50</td>
										</tr>
										<tr>
											<td>4</td>
											<td>101 Dalmatas</td>
											<td>2014-05-08 00:00:00</td>
											<td class="align-right">50</td>
										</tr>
										<tr>
											<td colspan="3" class="align-right tdGrey">CONSUMOS MAYO 2015</td>
											<td class="align-right tdGrey">200</td>
										</tr>
									</tbody>
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
													<td>200</td>
													<td class="align-right">x $11.192</td>
													</tr>
													<tr>
													<td colspan="2" class="align-right"><div class="valorTOTAL">$2233</div></td>
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