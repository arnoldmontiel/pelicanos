<div class="searchOverTab"><input onchange="searchTabDraft(this.value);" type="text" value="<?php echo $filter;?>" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
	<?php 
		foreach($modelNzbDraft as $item)
		{
			
			$modelAutoRipper = AutoRipper::model()->findByAttributes(array('Id_nzb'=>$item->Id));
			
			if(isset($modelAutoRipper))
			{
				$fileName = $modelAutoRipper->name;
				if(strlen($fileName) > 20)
					$fileName = str_pad(substr($fileName,0,20),23,".",STR_PAD_RIGHT);
				
				echo '<div id="movieItem_draft_'.$item->Id.'" class="movieItem">';
					echo '<table cellspacing="5">';
						echo '<tr>';
				if(isset($item->Id_my_movie_disc_nzb))
				{
					$poster = 'noImage.jpg';
					if(isset($item->Id_TMDB_data))
					{
						if(isset($item->TMDBData->poster))
							$poster = $item->TMDBData->poster;
					}
					elseif (isset($item->myMovieDiscNzb->myMovieNzb->poster))
					{
						$poster = $item->myMovieDiscNzb->myMovieNzb->poster;
					}					
					
					$title = $item->myMovieDiscNzb->myMovieNzb->original_title;
					if(strlen($title)>15)
						$title = str_pad(substr($title,0,15),18,".",STR_PAD_RIGHT);
						
					$genre = $item->myMovieDiscNzb->myMovieNzb->genre;
					if(strlen($genre)>30)
						$genre = str_pad(substr($genre,0,30),33,".",STR_PAD_RIGHT);
										
					echo '<td valign="top" class="tdImage"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.');" data-toggle="modal" ><img class="movieImage" src="images/'.$poster.'" width="120"/><i class="fa fa-info-circle iconOverlay"></i></a></td>';
					echo '<td>';
					echo '<div class="movieName">'.$title.'
						<div class="dropdown editFiles">
												<a data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog fa-lg"></i></a>
						  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						    <li role="presentation"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.', 2);" role="menuitem" tabindex="-1" href="#">Configurar Archivos</a></li>
						    <li role="presentation" class="divider"></li>
						    <li role="presentation"><a onclick="editVideoInfo('.$item->Id.');" role="menuitem" tabindex="-1" href="#">Editar Informaci&oacute;n</a></li>
						    <li role="presentation" class="divider"></li>
						    <li role="presentation"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.');" data-toggle="modal" role="menuitem" tabindex="-1" href="#">Ver Informaci&oacute;n</a></li>
						  </ul>
						</div></div>';
						echo '<div class="movieYear">'.$item->myMovieDiscNzb->myMovieNzb->production_year.'</div>';
						echo '<div class="movieGenre">'. $genre.'</div>';
						echo '<div class="movieYear">Archivo: '.$fileName.'</div>';
						echo '<div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
						echo '<div class="movieButton"><a onclick="approveConfirm('.$modelAutoRipper->Id.');" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a onclick="rejectConfirm('.$modelAutoRipper->Id.');" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
					echo '</td>';
				}
				else 
				{
					echo '<td valign="top" class="tdImage"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.');" data-toggle="modal" ><img class="movieImage" src="images/noImage.jpg" width="120"/><i class="fa fa-info-circle iconOverlay"></i></a></td>';
					echo '<td>';
					echo '<div class="movieName">No Identificado
						<div class="dropdown editFiles">
												<a data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog fa-lg"></i></a>
						  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						    <li role="presentation"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.', 2);" role="menuitem" tabindex="-1" href="#">Configurar Archivos</a></li>
						    <li role="presentation" class="divider"></li>
						    <li role="presentation"><a onclick="editVideoInfo('.$item->Id.');" role="menuitem" tabindex="-1" href="#">Editar Informaci&oacute;n</a></li>
						    <li role="presentation" class="divider"></li>
						    <li role="presentation"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.');" data-toggle="modal" role="menuitem" tabindex="-1" href="#">Ver Informaci&oacute;n</a></li>
						  </ul>
						</div></div>';
					echo '<div class="movieYear">Archivo: '.$fileName.'</div>';
						echo '<div class="movieGenre">&nbsp;</div>';
						echo '<div class="movieYear">&nbsp;</div>';
						echo ' <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
						echo ' <div class="movieButton"><a data-toggle="modal" class="btn btn-default disabled"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary disabled"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
					echo ' </td>';
				}
						echo '</tr>';
					echo '</table>';
				echo '</div>';
			}
		}
	?>