<div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
	<?php 
		foreach($modelAutoRipperDraft as $item)
		{
			echo '<div class="movieItem">';
				echo '<table cellspacing="5">';
					echo '<tr>';
			if(isset($item->Id_nzb))
			{
				echo '<td valign="top" class="tdImage"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" ><img class="movieImage" src="images/cover.jpeg" width="100"/></a></td>';
				echo '<td>';
					echo '<div class="movieName">Django Unchained<a onclick="editVideoData('.$item->Id.');" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>';
					echo '<div class="movieYear"> 2013</div>';
					echo '<div class="movieGenre">Drama, Comedia, Romance</div>';
					echo '<div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
					echo '<div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
				echo '</td>';
			}
			else 
			{
				echo '<td valign="top" class="tdImage"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" ><img class="movieImage" src="images/noImage.jpg" width="100"/></a></td>';
				echo '<td>';
					echo '<div class="movieName">Archivo no Identificado<a onclick="editVideoData('.$item->Id.');" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>';
					echo '<div class="movieYear"> '.$item->name.'</div>';
					echo '<div class="movieGenre">&nbsp;</div>';
					echo ' <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
					echo ' <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default disabled"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary disabled"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
				echo ' </td>';
			}
					echo '</tr>';
				echo '</table>';
			echo '</div>';
		}
	?>