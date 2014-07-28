<?php
$modelTMDB =  $modelNzb->TMDBData;
if(isset($modelTMDB)&&$modelTMDB->big_poster!="")
{
	$moviePoster = $modelTMDB->big_poster;
}
else
{
	$moviePoster = $modelMyMovieNzb->big_poster;
}
$moviePoster = PelicanoHelper::getImageName($moviePoster,"_big");

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
		$('#selectize-genres').selectize({
	   			plugins: ['remove_button'],
		    	delimiter: ',',
		    	persist: true,
		    	create: function(input) {
		        	return {
		            	value: input,
		            	text: input
		        	}
		    	},
	   			onChange: function() {
		        	$('#input_genres').val(this.getValue());
		    	} 
			});
		
		$('#selectize-actors').selectize({
	   			plugins: ['remove_button'],
		    	delimiter: ',',
		    	persist: true,
		    	create: function(input) {
		        	return {
		            	value: input,
		            	text: input
		        	}
		    	},
	   			onChange: function() {
		        	$('#input_actors').val(this.getValue());
		    	} 
			});
		
			$('#selectize-directors').selectize({
	   			plugins: ['remove_button'],
		    	delimiter: ',',
		    	persist: true,
		    	create: function(input) {
		        	return {
		            	value: input,
		            	text: input
		        	}
		    	},
	   			onChange: function() {
		        	$('#input_directors').val(this.getValue());
		    	} 
			});
			$('#selectize-categories').selectize({
	   			plugins: ['remove_button'],
		    	delimiter: ',',
		    	persist: false,
		    	create: false,
	   			onChange: function() {
		        	$('#input_categories').val(this.getValue());
		    	} 
			});		
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
<img id="poster" class="peliAfiche" src="<?php echo $moviePoster;?>" border="0">
</div>
<div class="editImagesButtons">   
<a id="open-change-poster" data-toggle="modal"  class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Afiche</a>
<!--<a id="open-change-backdrop" data-toggle="modal" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Fondo</a>-->
</div>
</div>
    <!-- /col-md-3 -->
    <div class="col-md-9">
    <form class="form-horizontal" id="my-movie-form" role="form" method="post" >
    <?php    
	echo CHtml::hiddenField('idNzb',$modelNzb->Id);
	$actorsIds= array();
	foreach ($actors as $actor)
	{
		$actorsIds[]=$actor['id'];
	}
	
	echo CHtml::hiddenField('input_actors',implode(',', $actorsIds));
	echo CHtml::hiddenField('input_genres',$modelMyMovieNzb->genre);
	$categoriesIds= array();
	foreach ($categories as $category)
	{
		$categoriesIds[]=$category['id'];
	}
	
	echo CHtml::hiddenField('input_categories',implode(',', $categoriesIds));
	$directorsIds= array();
	foreach ($directors as $director)
	{
		$directorsIds[]=$director['id'];
	}
	echo CHtml::hiddenField('input_directors',implode(',', $directorsIds));	
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
    <select id="selectize-genres" name="genres[]" multiple placeholder="Seleccione un genero">	
		<?php
		$genresExplodes =explode(',', $modelMyMovieNzb->genre); 		
		foreach ($genresExplodes as $genre)
		{
			$genre = trim($genre);
			echo '<option value="'.$genre.'" selected>'.$genre.'</option>';
		}
		foreach ($genres as $genre)
		{
			echo '<option value="'.$genre.'" >'.$genre.'</option>';
		}
		?>
	</select>	
    
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldMarketCategory" class="col-md-1 control-label">Categorias en Market</label>
    <div class="col-md-11">
      <select id="selectize-categories" name="categories[]" multiple class="demo-default" placeholder="Seleccione una categor&iacute;a">	
		<?php		
		$marketCategories = $modelNzb->marketCategorys;
		foreach ($marketCategories as $marketCategory)
		{
			echo '<option value="'.$marketCategory->Id.'" selected>'.$marketCategory->description.'</option>';
		}
		foreach ($categories as $category)
		{
			echo '<option value="'.$category['id'].'">'.$category['text'].'</option>';
		}		
		?>
	</select>	
      
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
	<select id="selectize-directors" name="directors[]" multiple class="demo-default" placeholder="Seleccione un director">	
		<?php		
		foreach ($directors as $director)
		{
			echo '<option value="'.$director['id'].'" selected>'.$director['text'].'</option>';
		}
		?>
	</select>	
              
	</div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldActores" class="col-md-1 control-label">Actores</label>
    <div class="col-md-11">
		<select id="selectize-actors" name="actors[]" multiple class="demo-default" placeholder="Seleccione un actor">	
		<?php		
		foreach ($actors as $actor)
		{
			echo '<option value="'.$actor['id'].'" selected>'.$actor['text'].'</option>';
		}
		?>
	</select>	    
      
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