<?php 
	$title = "&nbsp;";
	$modelNzb = $modalAutoRipper->nzb;
	if(isset($modelNzb))
	{
		if(isset($modelNzb->myMovieDiscNzb))
		{
			$modeMyMovieNzb = $modelNzb->myMovieDiscNzb->myMovieNzb;
			$title = $modeMyMovieNzb->original_title;
			$year = $modeMyMovieNzb->production_year;
			if(!empty($year))
				$title = $title . ' ('.$year.')';
		}
	}
?>
<form method="post">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        		<h4 class="modal-title"><?php echo $title;?></h4>
      		</div>
      		<div class="modal-body">
  				<div class="form-group">
  					<label for="campoNombre">Raz&oacute;n</label>
					<textarea id="budget-note" rows="3" class="form-control" placeholder="Escriba una raz&oacute;n..."></textarea>  
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-ban"></i> Rechazar</button>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</form>