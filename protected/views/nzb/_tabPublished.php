<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'nzb-grid_rejected',
		'dataProvider'=>$modelNzb->searchPublished(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array(
					'header'=>'Afiche',
					
					'value'=>function($data){
						$poster = 'noImage.jpg';
						if(isset($data->Id_TMDB_data))
						{
							$poster = $data->TMDBData->poster;
						}
						elseif (isset($data->myMovieDiscNzb->myMovieNzb->poster))
						{
							$poster = $data->myMovieDiscNzb->myMovieNzb->poster;
						}	
						return '<img class="tableMovieImage" src="images/'.$poster.'" width="50">';
					},
					'type'=>'raw',
					'htmlOptions'=>array("width"=>"50;"),
				),
				array(
						'header'=>'Película',
						'value'=>function($data){
							$title = 'No Identificado';
							$genre = '';
							$description = '';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
							{
								$title = $data->myMovieDiscNzb->myMovieNzb->original_title;
								$genre = $data->myMovieDiscNzb->myMovieNzb->genre;
								$description = $data->myMovieDiscNzb->myMovieNzb->description;
							}
							$value = '<div class="tablaNombre">'.$title.'</div>
									<div class="tablaGenero">'.$genre.'</div>
									<div>'.$description.'</div>';
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Año',
						'value'=>function($data){
							$year = '';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$year = $data->myMovieDiscNzb->myMovieNzb->production_year;
							
							return $year;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Rating',
						'value'=>function($data){
							$rating = '';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$rating = $data->myMovieDiscNzb->myMovieNzb->rating;
								
							return $rating;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Fecha',
						'value'=>function($data){
							return $data->rejectedDate;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Usuario',
						'value'=>function($data){
							return $data->rejectedUser;
						},
						'type'=>'raw',
				),
			),
		));		
?>