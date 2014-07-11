<script type="text/javascript">
function openForm(id)
{
	$.post("<?php echo MarketCategoryController::createUrl('AjaxOpenForm'); ?>",
			{
				idCategory:id
			}
		).success(
			function(data){
				$('#myModalGeneric').html(data);
				$('#myModalGeneric').modal('show');
			});
	return false;
}
function deleteReseller(id)
{
	if (confirm('¿Desea borrar esta categoría?')) 
	{
		$.post("<?php echo MarketCategoryController::createUrl('AjaxDelete'); ?>",
			{
			idCategory:id
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('market-category-grid');
			});
		return false;
	}
	return false;
}
</script>
<div class="container" id="screenMarketCategory">
	<div class="row">
		<div class="col-sm-6">
  			<h1 class="pageTitle">Categorias del Market</h1>
  		</div>
  		<div class="col-sm-6 align-right">
  			<a onclick="openForm(0);" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearReseller"><i class="fa fa-plus"></i> Agregar Categor&iacute;a</a>
  		</div>
  	</div>
  	<div class="row">
    	<div class="col-sm-12">
		    <?php		
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'market-category-grid',
				'dataProvider'=>$modelMarketCategory->search(),
				'selectableRows' => 0,
				'filter'=>$modelMarketCategory,
				'summaryText'=>'',	
				'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
				'columns'=>array(					
						array(
								'header'=>'Descripci&oacute;n',
								'name'=>'description',
								'value'=>'$data->description',
						),	
						array(
								'header'=>'Orden',
								'name'=>'order',
								'value'=>'$data->order',
						),
						array(
								'header'=>'Oculto',
								'value'=>function($data){
									return ($data->hide == 0)?'No':'Si';
								},
								'type'=>'raw',
								'headerHtmlOptions'=>array("style"=>"white-space:nowrap;"),
						),
						array(
								'header'=>'Acciones',
								'value'=>function($data){
									return '<button onclick="openForm('.$data->Id.')" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
			              					<button onclick="deleteReseller('.$data->Id.')" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
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