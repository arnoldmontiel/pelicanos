<script type="text/javascript">
function openForm(id)
{
	$.post("<?php echo ResellerController::createUrl('AjaxOpenForm'); ?>",
			{
				idReseller:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}
</script>
<div class="container" id="screenResellers">
	<div class="row">
		<div class="col-sm-6">
  			<h1 class="pageTitle">Resellers</h1>
  		</div>
  		<div class="col-sm-6 align-right">
  			<a onclick="openForm(0);" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearReseller"><i class="fa fa-plus"></i> Agregar Reseller</a>
  		</div>
  	</div>
  	<div class="row">
    	<div class="col-sm-12">
		    <?php		
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'reseller-grid',
				'dataProvider'=>$modelUser->searchReseller(),
				'selectableRows' => 0,
				'filter'=>$modelUser,
				'summaryText'=>'',	
				'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
				'columns'=>array(					
						array(
							'name'=>'reseller_desc',
							'value'=>'$data->reseller->description',
						),
						'username',
						'password',
						'email',
						array(
								'header'=>'Acciones',
								'value'=>function($data){
									return '<button onclick="openForm('.$data->Id_reseller.')" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
			              					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
								},
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
								'headerHtmlOptions'=>array("style"=>"text-align:right;"),
						),
					),
				));		
			?>
		</div>
    	<!-- /.col-sm-12 --> 
  	</div>
  	<!-- /.row --> 
</div>