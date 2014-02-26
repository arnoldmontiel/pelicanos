<div class="modal-dialog myModalViewDownloads">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Descargas </h4>
        </div>
        <div class="modal-body">
         <ul class="nav nav-tabs">
        <li class="active"><a><span id="download-device-desc"></span> (ID: <span id="download-device-id"></span>)</a></li>
        <li id="total-qty" class="pull-right">Total Descargas <span id="downloaded-qty" class="label label-info"></span></li>
      </ul>
              <div class="grid-view">
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
								'name'=>"genre",
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
								'name'=>"nzb_status",
								'value'=>function($data){
									$value = '';
									if(isset($data->nzbState))
										$value = $data->nzbState->description;
						
									return $value;
								},
								'type'=>'raw',
						),
						'date_sent',
						'date_downloading',
						'date_downloaded',
					),
				)); ?>
              </div>
              </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content --> 
      
</div>
<!-- /.modal-dialog -->