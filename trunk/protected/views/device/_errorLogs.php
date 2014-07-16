<div class="row"> 
  <div class="col-sm-12">
   <?php 
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'error-log-grid',
					'dataProvider'=>$modelErrorLog->search(),
					'filter'=>$modelErrorLog,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'summaryText'=>'',
					'columns'=>array(							
							array(
									'name'=>'error_type',							
									'value'=>function($data){
										$value = 'Desconocido';
										switch ($data->error_type) {
											case 1:
												$value = 'Error en Players';
												break;
											case 2:
												$value = 'Error en NAS';
												break;
											case 3:
												$value = 'Error de espacio en NAS';
												break;
										}
										return $value;
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"width:20%"),
									'filter'=>CHtml::listData(
											array(
													array('id'=>'1','value'=>'Players'),
													array('id'=>'2','value'=>'NAS'),
													array('id'=>'3','value'=>'Espacio en NAS')
											)
											,'id','value'
									),
							),
							array(
									'header'=>"Fecha",
									'value'=>'$data->date',
									'type'=>'raw',
							),
							array(
									'header'=>'Error solucionado',
									'value'=>function($data){
										$value = 'NO';
										if($data->has_error == 0)
											$value = 'SI';
										return $value;
									},
									'type'=>'raw',
							),
					),
				)); ?>
  </div>
  </div>