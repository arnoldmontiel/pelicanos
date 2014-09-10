<div class="row"> 
  <div class="col-sm-12">
  	<table class="table table-striped table-bordered tablaIndividual">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Estado Actual</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width:20%">Espacio en NAS</td>
				<td id="space-summary"><span class="label label-danger">OK</span></td>
			</tr>
			<tr>
				<td style="width:20%">Error en NAS</td>
				<td id="nas-summary"><span class="label label-success">OK</span></td>
			</tr>
			<tr>
				<td style="width:20%">Error en Player</td>
				<td id="player-summary"><span class="label label-success">OK</span></td>
			</tr>
		</tbody>
	</table>
  
  <div class=errorLogScroll>
   <?php 
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'error-log-grid',
					'dataProvider'=>$modelErrorLog->search(),
					'filter'=>$modelErrorLog,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'summaryText'=>'',
					'columns'=>array(							
							array(
									'header'=>"Log Informe",
									'name'=>'error_type',							
									'value'=>function($data){
										$value = 'Desconocido';
										switch ($data->error_type) {
											case 1:
												$value = 'Players Error';
												if($data->has_error == 0)
													$value = 'Players OK';
												break;
											case 2:
												$value = 'NAS Error';
												if($data->has_error == 0)
													$value = 'NAS OK';
												break;
											case 3:
												$value = 'Espacio en NAS Error';
												if($data->has_error == 0)
													$value = 'Espacio en NAS OK';
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
					),
				)); ?>
				</div>
  </div>
  </div>