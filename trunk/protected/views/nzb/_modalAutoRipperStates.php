<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle fa-lg"></i></button>
					<h4 class="modal-title">Ver Movimientos</h4>
		</div>
		<div class="modal-body">
			<ul class="nav nav-tabs">
				<li class="active"><a><?php echo $name;?></a></li>
			</ul>
			<table class="table tablaArchivos">
				<thead>
					<tr>
						<th>Descripci&oacute;n de Estado</th>
						<th>Fecha</th>
						<th>Descripci&oacute;n</th>
					</tr>
				</thead>
    			<tbody>
    			<?php
    			foreach($modalAutoRipperStates as $item)
    			{
    				echo '<tr>';
	    				echo '<td>'.$item->autoRipperState->description.'</td>';
	    				echo '<td>'.$item->change_date.'</td>';
	    				echo '<td>'.$item->description.'</td>';
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