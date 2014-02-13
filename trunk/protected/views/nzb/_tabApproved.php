<div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
	<?php 
		foreach($modelNzbApproved as $item)
		{
			
			$modelAutoRipper = AutoRipper::model()->findByAttributes(array('Id_nzb'=>$item->Id));
			
			if(isset($modelAutoRipper))
			{
				$fileName = $modelAutoRipper->name;
				if(strlen($fileName) > 25)
					$fileName = str_pad(substr($fileName,0,25),28,".",STR_PAD_RIGHT);
				
				echo '<div class="movieItem">';
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
					
					echo '<td valign="top" class="tdImage"><a onclick="viewVideoInfo('.$modelAutoRipper->Id.');" data-toggle="modal" ><img class="movieImage" src="images/'.$poster.'" width="100"/><i class="fa fa-info-circle iconOverlay"></i></a></td>';
					echo '<td>';
					echo '<div class="movieName">'.$title.'
							<a data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>';
						echo '<div class="movieYear">'.$item->myMovieDiscNzb->myMovieNzb->production_year.'</div>';
						echo '<div class="movieGenre">'. $genre.'</div>';
						echo '<div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>';
						echo '<div class="movieButton"><a onclick="publishConfirm('.$modelAutoRipper->Id.');" data-toggle="modal"  class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</a></div>';
					echo '</td>';
				}
				
					echo '</tr>';
				echo '</table>';
			echo '</div>';
			}
		}
	?>