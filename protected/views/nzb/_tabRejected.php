<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'nzb-grid_rejected',
		'dataProvider'=>$modelNzb->searchRejected(),
		'selectableRows' => 0,
		'summaryText'=>'',
		'filter'=>$modelNzb,
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array(
					'header'=>'Afiche',
					
					'value'=>function($data){
						$poster = 'no_image.jpg';
						if(isset($data->Id_TMDB_data))
						{
							if(isset($data->TMDBData->poster))
								$poster = $data->TMDBData->poster;
						}
						elseif (isset($data->myMovieDiscNzb->myMovieNzb->poster))
						{
							$poster = $data->myMovieDiscNzb->myMovieNzb->poster;
						}
						$poster = PelicanoHelper::getImageName($poster);
						return '<img class="tableMovieImage" src="'.$poster.'" width="50">';
					},
					'type'=>'raw',
					'htmlOptions'=>array("width"=>"50;"),
				),
				array(
						'name'=>'title',
						'value'=>function($data){
							$title = 'No Identificado';
							if(isset($data->myMovieDiscNzb->myMovieNzb))
							{
								$title = $data->myMovieDiscNzb->myMovieNzb->original_title;
								$year = $data->myMovieDiscNzb->myMovieNzb->production_year;
								if(!empty($year))
									$title = $title . ' ('.$year.')';
							}
							return '<div class="tablaNombre">'.$title.'</div>';
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Razón',
						'value'=>function($data){
							return '<span class="label label-info">'.$data->reject_note.'</span>';
						},
						'type'=>'raw',
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