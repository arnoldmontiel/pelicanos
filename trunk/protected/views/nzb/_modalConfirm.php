<?php 
	$title = "&nbsp;";
	$img = "noImage.jpg";
	$modelNzb = $modalAutoRipper->nzb;
	if(isset($modelNzb))
	{
		if(isset($modelNzb->myMovieDiscNzb))
		{
			$modeMyMovieNzb = $modelNzb->myMovieDiscNzb->myMovieNzb;
			$title = $modeMyMovieNzb->original_title;
			$year = $modeMyMovieNzb->production_year;
			if(!empty($year))
				$title = $title. ' ('.$year.')';
			
			if(isset($modelNzb->Id_TMDB_data))
			{
				$img = $modelNzb->TMDBData->poster;
			}
			elseif (isset($modeMyMovieNzb->poster))
			{
				$img = $modeMyMovieNzb->poster;
			}
			
			
		}
	}
	$modalTitle = 'Aprobar Pel&iacute;cula';
	if($confirmType == 2)
		$modalTitle = 'Publicar Pel&iacute;cula';
?>
<form id="brand-form" method="post">
	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle fa-lg"></i></button>
			        		<h4 class="modal-title"><?php echo $modalTitle;?></h4>
      		</div>
      		<div class="modal-body">
      			<div class="row">
      				<div class="col-md-12">
      					<p>La pel&iacute;cula presenta la siguiente configuraci&oacute;n:</p>
      				</div>
      			</div>
      			<div class="row">
      				<div class="col-md-3 text-center">
      					<img src="images/<?php echo $img;?>" width="100%">
      				</div>
      			<div class="col-md-9">
	     			<div class="bold"> <?php echo $title;?></div>
	     			
	     				<?php if($confirmType == 2):?>
	     				<div class="alert alert-info publishPuntos" role="alert">
						<table class="table">
						<tbody>
						<tr>
						<td><i class="fa fa-database"></i> Puntos</td>
						<td class="text-right"><?php echo CHtml::textField('nzb-points',0,array('id'=>'nzb-points','onkeyup'=>'checkNumber(this)'));?></td>
						</tr>
						</tbody>
						</table>
	     			  </div>
	     			<?php endif;?>  
						<table class="table tablaArchivos">
	    					<thead>
								<tr>
									<th>Archivo</th>
									<th>Peso</th>
									<th>Tipo</th>
								</tr>
							</thead>
	    					<tbody>
	    						<?php
	    						$hasMain = 0;
								foreach($modelNzbs as $nzb)
								{
									echo '<tr>';
										echo '<td>'.$nzb->autoRipperFile->label.'</td>';
										echo '<td>'.PelicanoHelper::format_bytes($nzb->autoRipperFile->size).'</td>';
										echo '<td>'.$nzb->nzbType->description.'</td>';
									echo '</tr>';
									
									if($nzb->Id_nzb_type == 1)
										$hasMain = 1;
								} 
								?>	    			
	    					</tbody>
	    				</table> 
	      			</div>
	      			<?php
	      				echo CHtml::hiddenField('hasMain',$hasMain,array('id'=>'hasMain'));
								 
					?>	  
					
      			</div>
      			<div id="status-error" style="display:none;"  class="estadoModal">
				      	<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
				 	Al menos un archivo debe ser de tipo MAIN.</div>
				  </div>     			  
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<?php if($confirmType == 1):?>
        			<button onclick="approveNzb(<?php echo $modalAutoRipper->Id_nzb;?>);" type="button" class="btn btn-primary btn-lg"><i class="fa fa-check-square-o"></i> Aprobar</button>
        		<?php else:?>
        			<button onclick="publishNzb(<?php echo $modalAutoRipper->Id_nzb;?>);" type="button" class="btn btn-primary btn-lg"><i class="fa fa-share fa-fw"></i> Publicar</button>
        		<?php endif;?>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</form>