<?php 
$modelNzb = Nzb::model()->findByPk($idNzb);
$title = '';
if(isset($modelNzb->myMovieDiscNzb))
{
	$modeMyMovieNzb = $modelNzb->myMovieDiscNzb->myMovieNzb;
	$title = $modeMyMovieNzb->original_title;
}
?>
<form id="brand-form" method="post">
	<div class="modal-dialog myModalDescargas">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title">Ver Descargas</h4>
      		</div>
      		<div class="modal-body">
      			<ul class="nav nav-tabs">
        			<li class="active"><a><?php echo $title;?></a></li>
        			<li id="total-qty" class="pull-right">Total Descargas <span class="label label-info"><?php echo count($modalNzbDevices);?></span></li>
      			</ul>      			
 				<table class="table tablaArchivos">
				    <thead>
						<tr>
							<th>Reseller</th>
							<th>Cliente</th>
							<th>Dispositivo</th>
							<th>Fecha Inicio</th>
							<th>Fecha Fin</th>
						</tr>
					</thead>
    				<tbody>
    					<?php
    					foreach($modalNzbDevices as $item) 
    					{
    						$modelCustomerDevice = CustomerDevice::model()->findByAttributes(array('Id_device'=>$item->Id_device));
    						echo '<tr>';
    						echo '<td>'.$modelCustomerDevice->customer->reseller->description.'</td>';
    						echo '<td>'.$modelCustomerDevice->customer->fullName.'</td>';
    						echo '<td>'.$item->device->description.'</td>';
    						echo '<td>'.$item->date_downloading.'</td>';
    						echo '<td>'.$item->date_downloaded.'</td>';
    						echo '</tr>';
    					}
    					?>    
    				</tbody>
    			</table>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</form>