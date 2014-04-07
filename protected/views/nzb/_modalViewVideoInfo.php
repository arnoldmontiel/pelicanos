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
			$time = $modeMyMovieNzb->running_time;
			$description = $modeMyMovieNzb->description;
			$img = "noImage.jpg";
			if(isset($modelNzb->Id_TMDB_data))
			{
				if(isset($modelNzb->TMDBData->poster))
					$img = $modelNzb->TMDBData->poster;
			}
			elseif (isset($modeMyMovieNzb->poster))
			{
				$img = $modeMyMovieNzb->poster;
			}
			
			$modelPerson = MyMovieNzbPerson::model()->findByAttributes(array('Id_my_movie_nzb'=>$modeMyMovieNzb->Id));
			
			if(isset($modelPerson))
			{
				$directors = $modelPerson->getCasting('Director');
				$actor = $modelPerson->getCasting('Actor');
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
                		<li class="<?php echo ($activeTab==1)?'active':'';?>"><a href="#tab21" data-toggle="tab">Informaci&oacute;n</a></li>
              			<li class="<?php echo ($activeTab==2)?'active':'';?>"><a href="#tab23" data-toggle="tab">Archivos</a></li>
              			<li class="pull-right"><button id="btn-edit" onclick="editVideoInfo(<?php echo $modalAutoRipper->Id_nzb;?>);" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Informaci&oacute;n</button></li>
    				</ul>
					<div class="tab-content tableInfo">
    					<div class="tab-pane <?php echo ($activeTab==1)?'active':'';?>" id="tab21">
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
						    		&nbsp;<?php echo $parental;?>    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		RATING
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		<div class="ratingStars">
										<?php
											if ($rating == 1  ){
											echo '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 2  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 3  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 4  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 5  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 6  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 7  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 8  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
											}	else if ($rating == 9  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
											}	else if ($rating == 10  ){
											echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
											}	
										?>	
						    		</div>	
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		A&Ntilde;O
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
						    		&nbsp;<?php echo $directors;?>    
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		ACTORES
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		&nbsp;<?php echo $actor;?>
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		DURACI&Oacute;N
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond">
						    		&nbsp;<?php echo $time;?>&nbsp;mm
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
						    <div class="row detailSecondGroup">
						    	<div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
						    		SINOPSIS
						    	</div><!--/.col-md-3 -->
						    	<div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
						    		&nbsp;<?php echo $description;?>
						    	</div><!--/.col-md-9 -->
						    </div><!--/.row -->
    					</div><!--/.tab-pane#1 -->
    					    
	    				<div class="tab-pane <?php echo ($activeTab==2)?'active':'';?>" id="tab23"><!--/.bookmarks -->
	    					<table class="table tablaArchivos">
							    <thead>
									<tr>
										<th>Archivo</th>
										<th>Peso</th>
										<th>Tipo</th>
									</tr>
								</thead>
								<?php
									$list = CHtml::listData(NzbType::model()->findAll() ,'Id', 'description');									
									foreach($modelNzbs as $nzb)
									{
										echo '<tr>';
											echo '<td>'.$nzb->autoRipperFile->label.'</td>';
											echo '<td>'.PelicanoHelper::format_bytes($nzb->autoRipperFile->size).'</td>';
											echo '<td>';
												//echo $nzb->nzbType->description;
												echo CHtml::dropDownList("nzbType", $nzb->Id_nzb_type, $list, array('class' => 'form-control',
																											'onchange'=>'changeNzbType('.$nzb->Id.', this)'));
											echo '</td>';
										echo '</tr>';
									} 
								?>	    						
	    				</table>    	    
					</div><!--/.tab-pane3 -->
  				</div><!--/.modal-content -->
  			</div><!--/.col-sm-9 -->
  		</div><!--/.row -->
  	</div><!--/.body -->
  	</div><!--/.content -->
</div><!-- /.modal-dialog -->