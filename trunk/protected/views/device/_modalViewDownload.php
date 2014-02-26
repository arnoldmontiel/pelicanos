<div class="modal-dialog myModalViewDownloads">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Descargas </h4>
        </div>
        <div class="modal-body">
         <ul class="nav nav-tabs">
         <?php $modalDevice = Device::model()->findByPk($idDevice);?>
        <li class="active"><a><?php echo $modalDevice->description;?> (ID: <?php echo $idDevice;?>)</a></li>
        <li id="total-qty" class="pull-right">Total Descargas <span class="label label-info"><?php echo count($modalNzbDevices);?></span></li>
      </ul>
              <div class="grid-view">
                <table class="table table-striped table-bordered tablaIndividual">
                  <thead>
                    <tr>
                      <th>ID Imdb</th>
                      <th>T&iacute;tulo</th>
                      <th>G&eacute;nero</th>
                      <th>A&ntilde;o</th>
                      <th>Nzb Status</th>
                      <th>Fecha Enviado</th>
                      <th>Inicio Descarga</th>
                      <th>Fin Descarga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($modalNzbDevices as $item)
                    { 
		              	$idImdb = '';
		              	$genre = '';
		              	$title = '';
						$year = '';
						$state = '';
		              	if(isset($item->nzb->myMovieDiscNzb->myMovieNzb))
		              	{
		              		$idImdb = $item->nzb->myMovieDiscNzb->myMovieNzb->imdb;
		              		$genre = $item->nzb->myMovieDiscNzb->myMovieNzb->genre;
		              		$title = $item->nzb->myMovieDiscNzb->myMovieNzb->original_title;
		              		$year = $item->nzb->myMovieDiscNzb->myMovieNzb->production_year;
		              	}
		              	
		              	if(isset($item->nzbState))
		              		$state = $item->nzbState->description;
		              	
		              	echo '<tr>';
		              	echo '<td>'.$idImdb.'</td>';
		              	echo '<td class="bold">'.$title.'</td>';
		              	echo '<td>'.$genre.'</td>';
		              	echo '<td>'.$year.'</td>';
		              	echo '<td>'.$state.'</td>';
		              	echo '<td>'.$item->date_sent.'</td>';
		              	echo '<td>'.$item->date_downloading.'</td>';
		              	echo '<td>'.$item->date_downloaded.'</td>';
		              	echo '</tr>';
                    }
		            ?>
                  </tbody>
                </table>
              </div>
              </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content --> 
      
</div>
<!-- /.modal-dialog -->