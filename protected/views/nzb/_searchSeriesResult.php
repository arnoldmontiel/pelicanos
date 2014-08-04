<?php
 if(empty($series))
{	
	echo '<div class="loadingMessage"><i class="fa fa-frown-o"></i> No se encontraton resultados</div>';	
}
else
{
	foreach ($series as $serie)
	{
		$date = date_parse($serie->first_air_date);
		$date = " (".$date['year'].")";
		echo "<a id='".$serie->id."' href='#' class='list-group-item'>".$serie->original_name.$date."</a>";
	}
	
}
?>