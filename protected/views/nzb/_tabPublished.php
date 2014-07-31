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
						
						return '<a onclick="viewVideoInfo('.$data->autoRipperId.');" data-toggle="modal" ><img class="tableMovieImage valignTop" src="'.$poster.'" width="50"></a>';
					},
					'type'=>'raw',
					'htmlOptions'=>array("width"=>"50;", "class"=>"tdImage valignTop", "valign"=>"top"),
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
						'header'=>'Puntos',
						'value'=>function($data){
							
								return '<div class="inputInlineGroup clearfix"><input type="text" idnzb="'.$data->Id.'" onkeyup="checkNumber(this);" class="form-control text-center inputInlineSmall pull-left" name="points_'.$data->Id.'" id="points_'.$data->Id.'" disabled value="'.$data->points.'">
										<button id="edit_'.$data->Id.'" type="button" onclick="updatePoints('.$data->Id.');" class="btn btn-default btn-sm pull-right"><i class="fa fa-pencil"></i> </button>
  										<button id="cancel_'.$data->Id.'" type="button" onclick="cancelEditPoints('.$data->Id.');" class="hidden btn btn-default btn-sm  pull-right"><i class="fa fa-times-circle"></i></button>
  										<button id="save_'.$data->Id.'" type="button" onclick="savePoints('.$data->Id.');" class="hidden btn btn-primary btn-sm  pull-right"><i class="fa fa-save"></i></button></div>';
							
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-left"),
						'headerHtmlOptions'=>array("class"=>"align-left"),
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
							return $data->downloadsQty;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-center"),
						'headerHtmlOptions'=>array("class"=>"align-center"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<div style="width:306px;">
										<a onclick="deletePublication('.$data->Id.');" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a>
										<a onclick="viewVideoInfo('.$data->autoRipperId.');" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
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