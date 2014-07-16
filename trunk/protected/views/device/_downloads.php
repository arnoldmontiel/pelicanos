<div class="row"> 
  <div class="col-sm-12">
   <?php 
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'nzb-device-grid',
					'dataProvider'=>$modelNzbDevice->searchSummary(),
					'filter'=>$modelNzbDevice,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'summaryText'=>'',
					
					'columns'=>array(
						array(
								'name'=>"id_imdb",
								'value'=>function($data){
									$value = '';
									if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
										$value = $data->nzb->myMovieDiscNzb->myMovieNzb->imdb;
								
									return $value;
								},
								'type'=>'raw',
						),
						array(
								'name'=>"title",
								'value'=>function($data){
									$value = '';
									if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
										$value = $data->nzb->myMovieDiscNzb->myMovieNzb->original_title;
						
									return $value;
								},
								'type'=>'raw',
								'htmlOptions'=>array("class"=>"bold"),
						),
						array(
								'header'=>"Genero",
								'value'=>function($data){
									$value = '';
									if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
										$value = $data->nzb->myMovieDiscNzb->myMovieNzb->genre;
						
									return $value;
								},
								'type'=>'raw',
						),
						array(
								'name'=>"year",
								'value'=>function($data){
									$value = '';
									if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
										$value = $data->nzb->myMovieDiscNzb->myMovieNzb->production_year;
						
									return $value;
								},
								'type'=>'raw',
						),
						array(
								'name'=>'nzb_status',
								'value'=>function($data){
									$value = '';
									if(isset($data->nzbState))
										$value = $data->nzbState->description;
						
									return $value;
								},
								'type'=>'raw',
						),
						array(
								'header'=>"Fecha enviado",
								'value'=>'$data->date_sent',
								'type'=>'raw',
						),
						array(
								'header'=>"Fecha comienzo descarga",
								'value'=>'$data->date_downloading',
								'type'=>'raw',
						),
						array(
								'header'=>"Fecha fin descargado",
								'value'=>'$data->date_downloaded',
								'type'=>'raw',
						),
					),
				)); ?>
  </div>
  </div>