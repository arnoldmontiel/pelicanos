<?php 
	$title = $modalAutoRipper->name;
	$genre = "&nbsp;";
	$parental = "&nbsp;";
	$rating = "&nbsp;";
	$year = "&nbsp;";
	$directors = "&nbsp;";
	$actor = "&nbsp;";
	$time = "0";
	$description = "&nbsp;";
	$img = "noImage.jpg";
	$modelNzb = $modalAutoRipper->nzb;
	if(isset($modelNzb))
	{
		if(isset($modelNzb->myMovieDiscNzb))
		{
			$modeMyMovieNzb = $modelNzb->myMovieDiscNzb->myMovieNzb;
			$title = $modeMyMovieNzb->original_title;
			$genre = $modeMyMovieNzb->genre;
			$parental = $modeMyMovieNzb->parentalControl->description;
			$rating = $modeMyMovieNzb->rating;
			$year = $modeMyMovieNzb->production_year;
			$directors = "&nbsp;";
			$actor = "&nbsp;";
			$time = $modeMyMovieNzb->running_time;
			$description = $modeMyMovieNzb->description;
			$img = "noImage.jpg";
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
?>
<div class="modal-dialog modalDetail">
	<div class="modal-content">
   		<div class="modal-header">
      		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    		<h4 class="modal-title"><?php echo $title;?></h4>
    	</div>
    	<div class="modal-body"> 
    		<div class="row">
    			<div class="col-md-3 col-sm-3 align-center">
    				<img class="aficheDetail" src="images/<?php echo $img;?>" width="100%" height="100%" border="0">
    			</div><!--/.col-md-3PRINCIPAL -->        
    			<div class="col-md-9 col-sm-9">
    				<ul class="nav nav-tabs">
                		<li class="active"><a href="#tab21" data-toggle="tab">Informaci�n</a></li>
              			<li class=""><a href="#tab23" data-toggle="tab">Archivos</a></li>
              			<li class="pull-right"><button id="btn-edit" onclick="editVideoInfo(<?php echo $modalAutoRipper->Id_nzb;?>);" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Informaci�n</button></li>
    				</ul>
					<div class="tab-content tableInfo">
    					<div class="tab-pane active" id="tab21">
    						<div class="row detailSecondGroup">
    							<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
							    	GENERO
							    </div><!--/.col-md-3 -->
							    <div class="col-md-9 col-sm-9 align-left detailSecond">
									&nbsp;<?php echo $genre;?>
								</div><!--/.col-md-9 -->
    						</div><!--/.row -->    
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		PUBLICO
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		<?php echo $parental;?>    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		RATING
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		<div class="ratingStars">
						    			<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>	
						    		</div>	
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		A�O
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		&nbsp;<?php echo $year;?>    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		DIRECTOR
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		&nbsp;Ridley Scott    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		ACTORES
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		&nbsp;Russell Crowe / Denzel Washington / Chiwetel Ejiofor / Josh Brolin / Lymari Nadal / Ted Levine    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		DURACI�N
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		<?php echo $time;?>mm
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		SIN�PSIS
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
						    		&nbsp;<?php echo $description;?>
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
    					</div><!--/.tab-pane#1 -->
    					    
	    				<div class="tab-pane" id="tab23"><!--/.bookmarks -->
	    					<table class="table tablaArchivos">
							    <thead>
									<tr>
										<th>Archivo</th>
										<th>Peso</th>
										<th>Tipo</th>
									</tr>
								</thead>
	    						<tr>
	    							<td>spidermanMain.mkv</td>
								    <td>100mb</td>
								    <td>
									    <select class="form-control">
											<option>Main</option>
										  	<option>Extras</option>
										  	<option>Deleted Scenes</option>
										  	<option>Otro</option>
										</select>
								    </td>
								</tr>
								<tr>
									<td>spiderman.mkv</td>
								    <td>100mb</td>
								    <td>
									    <select class="form-control">
										  	<option>Main</option>
										  	<option>Extras</option>
										  	<option>Deleted Scenes</option>
										  	<option>Otro</option>
										</select>
								    </td>
								<tr>
									<td>spidermanother.mkv</td>
								    <td>100mb</td>
								    <td>
									    <select class="form-control">
									  		<option>Main</option>
									  		<option>Extras</option>
									  		<option>Deleted Scenes</option>
									  		<option>Otro</option>
										</select>
								    </td>
								</tr>
	    				</table>    	    
					</div><!--/.tab-pane3 -->
  				</div><!--/.modal-content -->
  			</div><!--/.col-sm-9 -->
  		</div><!--/.row -->
  	</div><!--/.body -->
  	</div><!--/.content -->
</div><!-- /.modal-dialog -->