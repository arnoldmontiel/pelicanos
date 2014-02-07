<div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
	<?php 
		foreach($modelAutoRipperDraft as $item)
		{
			echo '<div class="movieItem">';
				echo '<table cellspacing="5">';
					echo '<tr>';
			if(isset($item->Id_nzb))
			{
				echo '<td valign="top" class="tdImage"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" ><img class="movieImage" src="images/cover.jpeg" width="120"/><i class="fa fa-info-circle iconOverlay"></i></a></td>';
				echo '<td>';
				echo '<div class="movieName">Volviendo al Futuro
<div class="dropdown editFiles">
						<a data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog fa-lg"></i></a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Configurar Archivos</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Editar Informaci&oacute;n</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" role="menuitem" tabindex="-1" href="#">Ver Informaci&oacute;n</a></li>
  </ul>
</div></div>';
					echo '<div class="movieYear">2013</div>';
					echo '<div class="movieGenre">Drama, Comedia, Romance</div>';
					echo '<div class="movieYear">Archivo: '.$item->name.'</div>';
					echo '<div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
					echo '<div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
				echo '</td>';
			}
			else 
			{
				echo '<td valign="top" class="tdImage"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" ><img class="movieImage" src="images/noImage.jpg" width="120"/><i class="fa fa-info-circle iconOverlay"></i></a></td>';
				echo '<td>';
				echo '<div class="movieName">No Identificado
<div class="dropdown editFiles">
						<a data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog fa-lg"></i></a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Configurar Archivos</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Editar Informaci&oacute;n</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a onclick="editVideoData('.$item->Id.');" data-toggle="modal" role="menuitem" tabindex="-1" href="#">Ver Informaci&oacute;n</a></li>
  </ul>
</div></div>';echo '<div class="movieYear">Archivo: '.$item->name.'</div>';
					echo '<div class="movieGenre">&nbsp;</div>';
					echo '<div class="movieYear">&nbsp;</div>';
					echo ' <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>';
					echo ' <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default disabled"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary disabled"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>';
				echo ' </td>';
			}
					echo '</tr>';
				echo '</table>';
			echo '</div>';
		}
	?>