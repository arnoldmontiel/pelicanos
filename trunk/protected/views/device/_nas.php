<div class="row"> 
  <div class="col-sm-12">
   <?php 
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'nas-grid',
					'dataProvider'=>$modelClientSetting->search(),
					'filter'=>$modelClientSetting,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'summaryText'=>'',
					'columns'=>array(							
							array(
									'header'=>'Espacio total',							
									'value'=>function($data){
										return PelicanoHelper::format_bytes($data->disc_total_space);
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"width:20%"),
							),
							array(
									'header'=>'Espacio utilizado',
									'value'=>function($data){
										return PelicanoHelper::format_bytes($data->disc_used_space);
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"width:20%"),
							),
							array(
									'header'=>'Responde NAS',
									'value'=>function($data){
										return ($data->is_nas_alive==1)?'SI':'No';
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"width:20%"),
							),
					),
				)); ?>
  </div>
  </div>