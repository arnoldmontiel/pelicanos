<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'nzb-grid_published',
		'dataProvider'=>$modelNzb->searchPublished(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'filter'=>$modelNzb,
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
						return '<a onclick="viewVideoInfo('.$data->autoRipperId.');" data-toggle="modal" ><img class="tableMovieImage" src="images/'.$poster.'" width="50"></a>';
					},
					'type'=>'raw',
					'htmlOptions'=>array("width"=>"50;", "class"=>"tdImage", "valign"=>"top"),
				),
				array(
						'name'=>'title',
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
									<div>'.nl2br($description).'</div>';
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'year',
						'value'=>function($data){
							$year = '';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$year = $data->myMovieDiscNzb->myMovieNzb->production_year;
							
							return $year;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'rating',
						'value'=>function($data){
							$rating = '';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$rating = $data->myMovieDiscNzb->myMovieNzb->rating;
								
							return $rating;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Fecha de Creacion',
						'value'=>function($data){
							return $data->publishedDate;
						},
						'type'=>'raw',
						'headerHtmlOptions'=>array("width"=>"140"),
				),				
				array(
						'header'=>'Descargas',
						'value'=>function($data){
							return $data->downloadsQtyByReseller;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<div style="width:250px;">
										<a onclick="viewDownloads('.$data->Id.');" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
									</div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>