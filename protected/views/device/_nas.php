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
										$value = PelicanoHelper::format_bytes($data->disc_used_space);
										$percent = 0;
										if($data->disc_total_space > 0)
											$percent = round($data->disc_used_space * 100 / $data->disc_total_space,2);
										 
										return $value . ' ('.$percent.'% del total)';
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