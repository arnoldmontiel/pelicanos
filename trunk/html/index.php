<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Pelicano Server</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include('estilos.php');?>
<script src="js/jquery.js"></script>
</head>
<body>
<?php 
$active='inicio';
include('menu.php');?>
<div class="container" id="screenInicio">
  <h1 class="pageTitle">Pel&iacute;culas</h1>
  <div class="row">
  <div class="col-md-12">
   <ul class="nav nav-tabs">
        <li class="active"><a href="#tabDraft" data-toggle="tab">Borradores <span class="badge">10</span></a></li>
        <li><a href="#tabApproved" data-toggle="tab">Aprobadas <span class="badge">5</span></a></li>
        <li><a href="#tabPublished" data-toggle="tab">Publicadas</a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabDraft">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/cover.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Django Unchained</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><button class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/fast.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">Rapido y Furioso 10</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><button class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/gone.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Lo que el viento se llevo</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><button class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/titanic.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Titanic</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><button class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/300.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">300</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><button class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</button></div>
     </td></tr></table>
     </div>
  </div><!--.tab-pane-->
  
  <div class="tab-pane" id="tabApproved">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/american.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">American Pie</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><button class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/gatsby.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">El Gran Gatsby</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><button class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</button></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/spiderman.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">Spiderman</div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><button class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</button></div>
     </td></tr></table>
     </div>
  </div><!--.tab-pane-->
  
  
   <div class="tab-pane" id="tabPublished">
     
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Afiche</th>
<th>Pelicula</th>
<th class="align-right">Año</th>
<th class="align-right">Rating</th>
<th width="140">Fecha de Creaci&oacute;n</th>
<th class="align-right">Descargas</th>
<th class="align-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/spiderman.jpg" width="50"/></a></td>
<td><div class="tablaNombre">Spiderman</div><div class="tablaGenero">Accion, Comedia, Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right"><a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar Informacion</a></td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/cover.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">Django Unchained</div><div class="tablaGenero">Suspenso, Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right"><a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar Informacion</a></td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/fast.jpg" width="50"/></a></td>
<td><div class="tablaNombre">Rapido y Furioso</div><div class="tablaGenero">Accion</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right"><a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar Informacion</a></td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/gone.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">Lo que el viento se llevo</div><div class="tablaGenero">Accion, Comedia, Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right"><a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar Informacion</a></td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/300.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">300</div><div class="tablaGenero">Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right"><a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar Informacion</a></td>
</tr>
</tbody>
</table>
     
  </div><!--.tab-pane-->
  
  </div><!--.tab-content-->
  </div><!--.col12-->
  </div><!--.row-->
  
</div>
<!-- /container --> 


<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;"> <div class="modal-dialog modalDetail">
        <div class="modal-content">
   	<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Spiderman</h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 col-sm-3 align-center">
    <img class="aficheDetail" src="images/spiderman.jpg" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
        
    <div class="col-md-9 col-sm-9">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Información</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
              <!-- <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>--> 
              <li class="pull-right"><button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Información</button></li>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	&nbsp;Crime, Drama    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    Unrated    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    RATING
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <div class="ratingStars">
    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>	</div>	
	
	<!--<img src="images/" width="100" height="20" border="0"> -->
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    AÑO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;2007    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Ridley Scott    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Russell Crowe / Denzel Washington / Chiwetel Ejiofor / Josh Brolin / Lymari Nadal / Ted Levine    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DURACIÓN
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    157mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    SINÓPSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
    &nbsp;Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly from the source in South East Asia and he comes up with a unique way of importing the drugs into the United States. Based on a true story.    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane" id="tab2">
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    TAMAÑO EN DISCO
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	0 B	</div><!--/.col-md-9 -->
	</div><!--/.row -->
		    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    BORRAR
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<!--<i id="btn-eraser" class="fa fa-eraser fa-lg"></i>-->
	<!--<button id="btn-eraser-popover" class="popover fade bottom in"><i class="fa fa-eraser fa-lg"></i></button>-->
	
	<a href="#" id="btn-eraser-popover" class="" data-original-title="" title=""><i id="btn-eraser" class="fa fa-eraser fa-lg"></i></a>

	</div><!--/.col-md-9 -->
	</div><!--/.row -->
	
	</div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    
    	    
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer dropup">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->	  	
</div><!--/.myModal -->	  	

<div id="myModalBorrador" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;"> <div class="modal-dialog modalDetail">
        <div class="modal-content">
   	<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Spiderman</h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 col-sm-3 align-center">
    <img class="aficheDetail" src="images/spiderman.jpg" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
        
    <div class="col-md-9 col-sm-9">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Información</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
              <!-- <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>--> 
              <li class="pull-right"><button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Información</button></li>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	&nbsp;Crime, Drama    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    Unrated    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    RATING
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <div class="ratingStars">
    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>	</div>	
	
	<!--<img src="images/" width="100" height="20" border="0"> -->
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    AÑO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;2007    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Ridley Scott    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Russell Crowe / Denzel Washington / Chiwetel Ejiofor / Josh Brolin / Lymari Nadal / Ted Levine    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DURACIÓN
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    157mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    SINÓPSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
    &nbsp;Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly from the source in South East Asia and he comes up with a unique way of importing the drugs into the United States. Based on a true story.    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane" id="tab2">
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    TAMAÑO EN DISCO
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	0 B	</div><!--/.col-md-9 -->
	</div><!--/.row -->
		    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    BORRAR
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<!--<i id="btn-eraser" class="fa fa-eraser fa-lg"></i>-->
	<!--<button id="btn-eraser-popover" class="popover fade bottom in"><i class="fa fa-eraser fa-lg"></i></button>-->
	
	<a href="#" id="btn-eraser-popover" class="" data-original-title="" title=""><i id="btn-eraser" class="fa fa-eraser fa-lg"></i></a>

	</div><!--/.col-md-9 -->
	</div><!--/.row -->
	
	</div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    
    	    
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer dropup">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-check-square-o"></i> Aprobar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->	  	
</div><!--/.myModalBorrador -->	

<div id="myModalAprobado" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;"> <div class="modal-dialog modalDetail">
        <div class="modal-content">
   	<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Spiderman</h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 col-sm-3 align-center">
    <img class="aficheDetail" src="images/spiderman.jpg" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
        
    <div class="col-md-9 col-sm-9">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Información</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
              <!-- <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>--> 
              <li class="pull-right"><button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Información</button></li>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	&nbsp;Crime, Drama    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    Unrated    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    RATING
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <div class="ratingStars">
    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>	</div>	
	
	<!--<img src="images/" width="100" height="20" border="0"> -->
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    AÑO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;2007    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Ridley Scott    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;Russell Crowe / Denzel Washington / Chiwetel Ejiofor / Josh Brolin / Lymari Nadal / Ted Levine    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DURACIÓN
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    157mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    SINÓPSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
    &nbsp;Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly from the source in South East Asia and he comes up with a unique way of importing the drugs into the United States. Based on a true story.    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane" id="tab2">
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    TAMAÑO EN DISCO
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	0 B	</div><!--/.col-md-9 -->
	</div><!--/.row -->
		    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    BORRAR
	</div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<!--<i id="btn-eraser" class="fa fa-eraser fa-lg"></i>-->
	<!--<button id="btn-eraser-popover" class="popover fade bottom in"><i class="fa fa-eraser fa-lg"></i></button>-->
	
	<a href="#" id="btn-eraser-popover" class="" data-original-title="" title=""><i id="btn-eraser" class="fa fa-eraser fa-lg"></i></a>

	</div><!--/.col-md-9 -->
	</div><!--/.row -->
	
	</div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    
    	    
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer dropup">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-share"></i> Publicar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->	  	
</div><!--/.myModalAprobado -->	

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>