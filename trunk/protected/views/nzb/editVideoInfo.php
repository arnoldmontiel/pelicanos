<?php
$modelTMDB =  $modelNzb->TMDBData;
$moviePoster = 'noImage.jpg';
if(isset($modelTMDB)&&$modelTMDB->big_poster!="")
{
	$moviePoster = $modelTMDB->big_poster;
}
elseif(isset($modelMyMovieNzb->big_poster))
{
	$moviePoster = $modelMyMovieNzb->big_poster;
}

if(isset($modelTMDB)&&$modelTMDB->backdrop!="")
{
	$backdrop = $modelTMDB->backdrop;
}
else
{
	$backdrop = $modelMyMovieNzb->backdrop;
}

Yii::app()->clientScript->registerScript('update-video-info-head', "
		var date = new Date;	 	
		if('".$backdrop."'!='')			
	   		ChangeBG('images/','".$backdrop."'+ '?' +date.valueOf());			
",CClientScript::POS_BEGIN);

Yii::app()->clientScript->registerScript('update-video-info', "
		$('#myModalCambiarAfiche').on('hidden.bs.modal', function () {
  			$(this).html('');
		})
		$('#myModalCambiarBackdrop').on('hidden.bs.modal', function () {
  			$(this).html('');
		})
		
		$('#open-movie-list').click(function()
		{
		$('#open-movie-list').attr('disabled', 'disabled');
		$('#open-movie-list i').removeClass();
		$('#open-movie-list i').addClass('fa fa-spinner fa-spin');
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxFillVideoList') . "',
	   		data: {idNzb:'".$modelNzb->Id."',idMyMovieNzb:'".$modelMyMovieNzb->Id."'},
	 	}).success(function(data)
	 	{	
			$('#myModalEditarAsoc').html(data);
			$('#myModalEditarAsoc').modal('show');	   						   				
			$('#open-movie-list').removeAttr('disabled');
	   		$('#open-movie-list i').removeClass();
			$('#open-movie-list i').addClass('fa fa-link');
		}
	 	).error(function(){
			$('#open-movie-list').removeAttr('disabled');
			$('#open-movie-list i').removeClass();
			$('#open-movie-list i').addClass('fa fa-link');
		});
	   		return false;	   				
		}
		);
		
		$('#open-change-poster').click(function()
		{
		$('#open-change-poster').attr('disabled', 'disabled');
		$('#open-change-poster i').removeClass();
		$('#open-change-poster i').addClass('fa fa-spinner fa-spin');
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxFillMoviePosterSelector') . "',
	   		data: {idNzb:'".$modelNzb->Id."'},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarAfiche').html(data);
			$('#myModalCambiarAfiche').modal('show');	   						   				
			$('#open-change-poster').removeAttr('disabled');
	   		$('#open-change-poster i').removeClass();
			$('#open-change-poster i').addClass('fa fa-pencil');
		}
	 	).error(function(){
			$('#open-change-poster').removeAttr('disabled');
	   		$('#open-change-poster i').removeClass();
			$('#pen-change-poster i').addClass('fa fa-pencil');
	   				
	   				});
	   		return false;	   				
		}
		);
		$('#open-change-backdrop').click(function()
		{
		$('#open-change-backdrop').attr('disabled', 'disabled');
		$('#open-change-backdrop i').removeClass();
		$('#open-change-backdrop i').addClass('fa fa-spinner fa-spin');
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxFillVideoBackdropSelector') . "',
	   		data: {idNzb:'".$modelNzb->Id."'},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarBackdrop').html(data);
			$('#myModalCambiarBackdrop').modal('show');	   						   				
			$('#open-change-backdrop').removeAttr('disabled');
	   		$('#open-change-backdrop i').removeClass();
			$('#open-change-backdrop i').addClass('fa fa-pencil');
	   	}
	 	).error(function(){
			$('#open-change-backdrop').removeAttr('disabled');
	   		$('#open-change-backdrop i').removeClass();
			$('#open-change-backdrop i').addClass('fa fa-pencil');	   				
		});			
	   		return false;
		}
		);
	   				
		$('#actors').select2({tags:[],tokenSeparators: [',']});
		$('#directors').select2({tags:[],tokenSeparators: [',']});
		$('#genres').select2({tags:[],tokenSeparators: [',']});
	   	$('#marketcategories').select2({tags:[],tokenSeparators: [',']});
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxGetGenres') . "',
	   		data: {idMyMovieNzb:'".$modelMyMovieNzb->Id."'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {	   				
				item = data[i];
				if(first)
   				{
	   				first = false;
	   				vals = item;
				}
	   			else
	   			{
	   				vals = vals+','+item;
	   			}
			} 				
			$('#genres').select2({tags:data,tokenSeparators: [',']});
	   		$('#genres').val(vals).trigger('change');
			$('#input_genres').val(vals);	   						   				
		}
	 	);
		$('#genres').on('change',function(e){ $('#input_genres').val(e.val);});

	   	$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxGetMarketCategories') . "',
	   		data: {idNzb:'".$modelNzb->Id."'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data.used) {
				item = data.used[i];
				if(first)
   				{
	   				first = false;
	   				vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
			$('#marketcategories').select2({tags:data.available,tokenSeparators: [',']});
	   		$('#marketcategories').val(vals).trigger('change');
			$('#input_categories').val(vals);	   						   				
		}
	 	);
		$('#marketcategories').on('change',function(e){ $('#input_categories').val(e.val);});
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxGetPersons') . "',
	   		data: {idMyMovieNzb:'".$modelMyMovieNzb->Id."',type:'Actor'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#actors').select2({tags:data,tokenSeparators: [',']});
	   		$('#actors').val(vals).trigger('change');
			$('#input_actors').val(vals);	   						   				
		}
	 	);
		$('#actors').on('change',function(e){ $('#input_actors').val(e.val);});
		$.ajax({
	   		type: 'POST',
	   		url: '". NzbController::createUrl('AjaxGetPersons') . "',
	   		data: {idMyMovieNzb:'".$modelMyMovieNzb->Id."',type:'Director'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	 				
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#directors').select2({tags:data,tokenSeparators: [',']});
	   		$('#directors').val(vals).trigger('change');
	   		$('#input_directors').val(vals);	
	   					   				
		}
	 	);
		$('#directors').on('change',function(e){ $('#input_directors').val(e.val);});
		");
?>
<div class="container" id="screenEditMovie">
  <div class="row">
    <div class="col-md-12">
    <h2 class="pageSubtitle">Editar Pelicula</h2>
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
    <div class="row pageTitleContainer">
    <div class="col-md-6">
            <h1 class="pageTitle"><?php echo $modelMyMovieNzb->original_title; ?></h1>
        </div> <!-- /col-md-6 -->
    <div class="col-md-6 align-right">
		<button id="unlink-source" type="button" class="btn btn-danger"><i class="fa fa-unlink "></i> Reset</button>
		<button id="open-movie-list" type="submit" class="btn btn-primary"><i class="fa fa-link "></i> Buscar Información</button>
        </div> <!-- /col-md-6 -->
    </div>
    <div class="row superContainer">
    <div class="col-md-3">
    <div class="editAfiche">
<img id="poster" class="aficheImg" src="images/<?php echo $moviePoster;?>" border="0">
</div>
<div class="editImagesButtons">   
<a id="open-change-poster" data-toggle="modal"  class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Afiche</a>
<a id="open-change-backdrop" data-toggle="modal" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Fondo</a>
</div>
</div>
    <!-- /col-md-3 -->
    <div class="col-md-9">
    <form class="form-horizontal" id="my-movie-form" role="form" method="post" >
    <?php    
	echo CHtml::hiddenField('idNzb',$modelNzb->Id);	
	echo CHtml::hiddenField('input_actors');
	echo CHtml::hiddenField('input_genres');	
	echo CHtml::hiddenField('input_categories');
	echo CHtml::hiddenField('input_directors');	
	?>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldTitulo" class="col-md-1 control-label">Titulo</label>
    <div class="col-md-11">
      <input type="text" class="form-control" id="fieldTitulo" name="<?php echo get_class($modelMyMovieNzb).'[original_title]'?>" placeholder="Título" value="<?php echo $modelMyMovieNzb->original_title; ?>">
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldGenero" class="col-md-1 control-label">Genero</label>
    <div class="col-md-11">
      <div id="genres" style="width:100%">
    </div>
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldMarketCategory" class="col-md-1 control-label">Categorias en Market</label>
    <div class="col-md-11">
      <div id="marketcategories" style="width:100%">
    </div>
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
    <div class="col-md-3">
  <div class="form-group">
    <label for="fieldValoracion" class="col-md-4 control-label">Publico</label>
      <div class="col-md-8">
      <?php
		$parentalControl=ParentalControl::model()->findAll();
		$list= CHtml::listData(
		$parentalControl, 'Id', 'description');
		echo CHtml::dropDownList(get_class($modelMyMovieNzb).'[Id_parental_control]', $modelMyMovieNzb->Id_parental_control, $list);
		?>
      
      </div>
  </div>
    </div><!-- /col-md-3 -->
    <div class="col-md-3">
  <div class="form-group">
    <label for="fieldRating" class="col-md-3 control-label">Rating</label>
      <div class="col-md-9">
              <?php 
		$from = 1;
		$to = 10;
		$ratings = array();
		foreach (range($from, $to) as $number) {
			$ratings[$number] = $number; 
		}
		echo CHtml::dropDownList(get_class($modelMyMovieNzb).'[rating]', $modelMyMovieNzb->rating, $ratings);
		?>
      
          </div>
  </div>
  </div><!-- /col-md-3 -->
    <div class="col-md-3">
  <div class="form-group">
    <label for="fieldAno" class="col-md-2 control-label">Año</label>
        <div class="col-md-10">
        <?php 
		$yearNow = date("Y");
		$yearFrom = $yearNow - 100;
		$yearTo = $yearNow;
		$arrYears = array();
		foreach (range($yearFrom, $yearTo) as $number) {
			$arrYears[$number] = $number; 
		}
		$arrYears = array_reverse($arrYears, true);
		echo CHtml::dropDownList(get_class($modelMyMovieNzb).'[production_year]', $modelMyMovieNzb->production_year, $arrYears);
		?>
	</div>
  </div>
    </div><!-- /col-md-3 -->
    <div class="col-md-3">
  <div class="form-group">
    <label for="fieldDuracion" class="col-md-4 control-label">Duracion</label>
      <div class="col-md-8">
      <input type="text" class="form-control" id="fieldDuracion" placeholder="Duración" name="<?php echo get_class($modelMyMovieNzb).'[running_time]'?>" value="<?php echo $modelMyMovieNzb->running_time; ?>">
               <span>m</span> </div>
  </div>
  </div><!-- /col-md-3 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldDirector" class="col-md-1 control-label">Director</label>
              <div class="col-md-11">
	<div id="directors" style="width:100%">
    </div>
	</div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldActores" class="col-md-1 control-label">Actores</label>
              <div class="col-md-11">
	<div id="actors" style="width:100%">
    </div>
      
	</div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldResumen" class="col-md-1 control-label">Resumen</label>
              <div class="col-md-11">
<textarea class="form-control" id="fieldResumen" name="<?php echo get_class($modelMyMovieNzb).'[description]'?>" rows="5"><?php echo $modelMyMovieNzb->description; ?></textarea>
                  </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
 <div class="row">
        <div class="col-md-12">
 	<div class="buttonGroup">
 		<button type="button" onclick="goBack();" class="btn btn-default btn-lg"><i class="fa fa-arrow-left "></i> Volver</button>
 		<button type="submit" class="btn btn-primary btn-lg noMargin"><i class="fa fa-save "></i> Guardar</button></div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->    
</form>
    </div>
    <!-- /col-md-9 -->
 </div><!-- /row interna -->
 </div> <!-- /container -->  
<script>
function unlink()
{
	$.post("<?php echo NzbController::createUrl('AjaxUnlinkVideo'); ?>",
			{
				idNzb:<?php echo $modelNzb->Id; ?>
			 }
			).success(
				function(data){
					location.reload(); 
			}).error(function(data){
					location.reload(); 
			});

}

function goBack()
{	
	window.location = "<?php echo NzbController::createUrl("index")?>"; 
	return false;
}

function cancelar()
{
	  $('#unlink-source').popover('hide');
}
$(function () {
	  var elem ='<p>¿Seguro desea desasociar este contenido?</p><div class="popoverButtons"><button id="btn-remove-cancel" class="btn btn-default" type="button" onclick="cancelar()">No</button>'+
	  '<button id="btn-remove-ok" class="btn btn-primary  noMargin" type="button" onclick="unlink()">Si</button></div>';
	  
	  $('#unlink-source').popover({
      title: 'Confirmar',
      placement: 'bottom',
      content:elem,
      html:true
  });
});										
		
</script>