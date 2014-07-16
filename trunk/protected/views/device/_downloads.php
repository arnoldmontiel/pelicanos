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
								'htmlOptions'=>array('width'=>'8%')
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
								'htmlOptions'=>array("class"=>"bold",'width'=>'23%'),
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
								'htmlOptions'=>array('width'=>'20%'),
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
								'htmlOptions'=>array('width'=>'5%')
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
								'htmlOptions'=>array('width'=>'7%')
						),
						array(
								'header'=>"Enviado",
								'value'=>'$data->date_sent',
								'type'=>'raw',
								'htmlOptions'=>array('width'=>'12%')
						),
						array(
								'header'=>"Inicio Descarga",
								'value'=>'$data->date_downloading',
								'type'=>'raw',
								'htmlOptions'=>array('width'=>'12%')
						),
						array(
								'header'=>"Fin Descarga",
								'value'=>'$data->date_downloaded',
								'type'=>'raw',
								'htmlOptions'=>array('width'=>'12%')
						),
					),
				)); ?>
  </div>
  </div>