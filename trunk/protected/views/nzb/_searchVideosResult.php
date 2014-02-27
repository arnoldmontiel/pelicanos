<?php
 if(empty($movies))
{	
	echo '<div class="loadingMessage"><i class="fa fa-frown-o"></i> No se encontraton resultados</div>';	
}
else
{
	foreach ($movies as $movie)
	{
		$date = date_parse($movie->release_date);
		$date = " (".$date['year'].")";
		echo "<a id='".$movie->id."' href='#' class='list-group-item'>".$movie->original_title.$date."</a>";
	}
	
}
?>