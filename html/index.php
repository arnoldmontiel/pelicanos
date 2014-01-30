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
        <li><a href="#tabUploading" data-toggle="tab">Uploading</a></li>
        <li class="active"><a href="#tabDraft" data-toggle="tab">Borradores <span class="badge">10</span></a></li>
        <li><a href="#tabApproved" data-toggle="tab">Aprobadas <span class="badge">5</span></a></li>
        <li><a href="#tabPublished" data-toggle="tab">Publicadas</a></li>
        <li><a href="#tabRechazadas" data-toggle="tab">Rechazadas <span class="badge">1</span></a></li>
      </ul>
      <div class="tab-content">
      <div class="tab-pane" id="tabUploading">
     
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Disco</th>
<th>Estado</th>
<th class="align-right">Porcentaje</th>
<th class="align-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td>MEN_IN_BLACK</td>
<td>Archivos Borrados</td>
<td class="align-right">10%</td>
<td class="align-right"><a href="#myModalMovimientos" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o fa-fw"></i> Ver Movimientos</a></td>
</tr>
<tr>
<td>SPIDERMAN</td>
<td>Archivos Borrados</td>
<td class="align-right">10%</td>
<td class="align-right"><a href="#myModalMovimientos" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o fa-fw"></i> Ver Movimientos</a></td>
</tr>
<tr>
<td>DJANGO_UNCH</td>
<td>Archivos Borrados</td>
<td class="align-right">10%</td>
<td class="align-right"><a href="#myModalMovimientos" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o fa-fw"></i> Ver Movimientos</a></td>
</tr>
</tbody>
</table>
     
  </div><!--.tab-pane uploadgin-->
  
  <div class="tab-pane active" id="tabDraft">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/cover.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Django Unchained<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr>
     </table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/fast.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">Rapido y Furioso 10<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/gone.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Lo que el viento se llevo<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/titanic.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">Titanic<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/300.jpeg" width="100"/></a></td>
     <td>
     <div class="movieName">300<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr></table>
     </div>
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalBorrador" data-toggle="modal" ><img class="movieImage" src="images/noImage.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">Archivo no Identificado<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> MEN_INN_BLACK</div>
    <div class="movieGenre">&nbsp;</div>
    <div class="movieStatus"><span class="bold">Estado: Borrador</span></div>
      <div class="movieButton"><a  href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-default disabled"><i class="fa fa-check-square-o fa-fw"></i> Aprobar</a><a  href="#myModalConfirmRechazar" data-toggle="modal" class="btn btn-primary disabled"><i class="fa fa-ban fa-fw"></i> Rechazar</a></div>
     </td></tr></table>
     </div>
  </div><!--.tab-pane-->
  
  <div class="tab-pane" id="tabApproved">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula"></div>
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/american.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">American Pie<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><a href="#myModalConfirmPublicar" data-toggle="modal"  class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</a></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/gatsby.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">El Gran Gatsby<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><a href="#myModalConfirmPublicar" data-toggle="modal"  class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</a></div>
     </td></tr></table>
     </div>
     
     <div class="movieItem">
     <table cellspacing="5"><tr><td valign="top" class="tdImage"><a href="#myModalAprobado" data-toggle="modal" ><img class="movieImage" src="images/spiderman.jpg" width="100"/></a></td>
     <td>
     <div class="movieName">Spiderman<a href="#myModalBorrador" data-toggle="modal" class="editFiles"><i class="fa fa-cog fa-lg"></i></a></div>
    <div class="movieYear"> 2013</div>
    <div class="movieGenre">Drama, Comedia, Romance</div>
    <div class="movieStatus"><span class="bold">Estado: Aprobada</span></div>
      <div class="movieButton"><a href="#myModalConfirmPublicar" data-toggle="modal"  class="btn btn-primary"><i class="fa fa-share fa-fw"></i> Publicar</a></div>
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
<td class="align-right">
<div style="width:250px;">
<a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<a  href="#myModalDescargas" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
</div>
</td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/cover.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">Django Unchained</div><div class="tablaGenero">Suspenso, Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right">
<div style="width:250px;">
<a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<a  href="#myModalDescargas" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
</div>
</td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/fast.jpg" width="50"/></a></td>
<td><div class="tablaNombre">Rapido y Furioso</div><div class="tablaGenero">Accion</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right">
<div style="width:250px;">
<a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<a  href="#myModalDescargas" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
</div>
</td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/gone.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">Lo que el viento se llevo</div><div class="tablaGenero">Accion, Comedia, Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right">
<div style="width:250px;">
<a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<a  href="#myModalDescargas" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
</div>
</td>
</tr>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal" ><img class="tableMovieImage" src="images/300.jpeg" width="50"/></a></td>
<td><div class="tablaNombre">300</div><div class="tablaGenero">Drama</div><div>Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly ...</div></td>
<td class="align-right">2009</td>
<td class="align-right">9</td>
<td>12/20/2013</td>
<td class="align-right">259</td>
<td class="align-right">
<div style="width:250px;">
<a  href="#myModal" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<a  href="#myModalDescargas" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> Ver Descargas</a>
</div>
</td>
</tr>
</tbody>
</table>
     
  </div><!--.tab-pane-->
  <div class="tab-pane" id="tabRechazadas">
     
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Afiche</th>
<th>Pel&iacute;cula</th>
<th>Raz&oacute;n</th>
<th>Fecha</th>
<th>Usuario</th>
</tr>
</thead>
<tbody>
<tr>
<td width="50"><a href="#myModal" data-toggle="modal"><img class="tableMovieImage" src="images/spiderman.jpg" width="50"></a></td>
<td><div class="tablaNombre">Spiderman (2009)</div></td>
<td><span class="label label-info">La pelicula se corta en el minuto 1.32</span></td>
<td>12/20/2013</td>
<td>amontiel</td>
</tr>
</tbody>
</table>
     
  </div><!--.tab-pane rechazadas-->
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
                <li class="active"><a href="#tab11" data-toggle="tab">Información</a></li>
                <li class=""><a href="#tab12" data-toggle="tab">Avanzado</a></li>
              <li class=""><a href="#tab13" data-toggle="tab">Configurar Archivos</a></li>
              <li class="pull-right"><button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Información</button></li>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab11">
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
    
	<div class="tab-pane" id="tab12">
    
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
                <li class="active"><a href="#tab21" data-toggle="tab">Información</a></li>
              <li class=""><a href="#tab23" data-toggle="tab">Archivos</a></li>
                <li class=""><a href="#tab22" data-toggle="tab">Avanzado</a></li>
              <li class="pull-right"><button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Editar Información</button></li>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab21">
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
    
	<div class="tab-pane" id="tab22">
    
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
    
    <div class="tab-pane" id="tab23"><!--/.bookmarks -->
    
    <table class="table tablaArchivos">
    <thead>
<tr>
<th>Archivo</th>
<th>Peso</th>
<th>Tipo</th>
</tr>
</thead>
    <tr><td>spidermanMain.mkv</td>
    <td>100mb</td>
    <td>
    <select class="form-control">
  <option>Main</option>
  <option>Extras</option>
  <option>Deleted Scenes</option>
  <option>Otro</option>
</select>
    </td>
    </tr>
    <tr><td>spiderman.mkv</td>
    <td>100mb</td>
    <td>
    <select class="form-control">
  <option>Main</option>
  <option>Extras</option>
  <option>Deleted Scenes</option>
  <option>Otro</option>
</select>
    </td>
    <tr><td>spidermanother.mkv</td>
    <td>100mb</td>
    <td>
    <select class="form-control">
  <option>Main</option>
  <option>Extras</option>
  <option>Deleted Scenes</option>
  <option>Otro</option>
</select>
    </td>
    </table>
    	    
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer dropup">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    <a href="#myModalConfirmAprobar" data-toggle="modal" class="btn btn-primary btn-lg"><i class="fa fa-check-square-o"></i> Aprobar</a>
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

<div id="myModalConfirmAprobar" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Aprobar Pel&iacute;cula</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-12">
      <p>La pel&iacute;cula presenta la siguiente configuraci&oacute;n:</p>
      </div>
      </div>
      <div class="row">
      <div class="col-md-3 text-center">
      <img src="images/spiderman.jpg" width="100%">
      </div>
      <div class="col-md-9">
     <div class="bold"> Spiderman (2013)</div>
<table class="table tablaArchivos">
    <thead>
<tr>
<th>Archivo</th>
<th>Peso</th>
<th>Tipo</th>
</tr>
</thead>
    <tbody><tr><td>spidermanMain.mkv</td>
    <td>100mb</td>
    <td>Main
    </td>
    </tr>
    <tr><td>spiderman.mkv</td>
    <td>100mb</td>
    <td>Extras
    </td>
    </tr><tr><td>spidermanother.mkv</td>
    <td>100mb</td>
    <td>Extras	
    </td>
    </tr></tbody></table> 
      </div>
      </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-check-square-o"></i> Aprobar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>

<div id="myModalConfirmPublicar" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Publicar Pel&iacute;cula</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-12">
      <p>La pel&iacute;cula presenta la siguiente configuraci&oacute;n:</p>
      </div>
      </div>
      <div class="row">
      <div class="col-md-3 text-center">
      <img src="images/spiderman.jpg" width="100%">
      </div>
      <div class="col-md-9">
     <div class="bold"> Spiderman (2013)</div>
<table class="table tablaArchivos">
    <thead>
<tr>
<th>Archivo</th>
<th>Peso</th>
<th>Tipo</th>
</tr>
</thead>
    <tbody><tr><td>spidermanMain.mkv</td>
    <td>100mb</td>
    <td>Main
    </td>
    </tr>
    <tr><td>spiderman.mkv</td>
    <td>100mb</td>
    <td>Extras
    </td>
    </tr><tr><td>spidermanother.mkv</td>
    <td>100mb</td>
    <td>Extras	
    </td>
    </tr></tbody></table> 
      </div>
      </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-share"></i> Publicar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>

<div id="myModalConfirmRechazar" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Rechazar Django Unchained (2013)</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Raz&oacute;n</label>
<textarea id="budget-note" rows="3" class="form-control" placeholder="Escriba una raz&oacute;n..."></textarea>  
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-ban"></i> Rechazar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>


<div id="myModalMovimientos" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Ver Movimientos</h4>
      </div>
      <div class="modal-body">
      <ul class="nav nav-tabs">
        <li class="active"><a>MEN_IN_BLACK</a></li>
      </ul>
 <table class="table tablaArchivos">
    <thead>
<tr>
<th>Descripci&oacute;n de Estado</th>
<th>Fecha</th>
<th>Descripci&oacute;n</th>
</tr>
</thead>
    <tbody>
    <tr>
    <td>Expulsado</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Expulsando</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creado Par2</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creando Par2</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creado RAR</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creando RAR</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creado 7zip</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Creando 7zip</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>iniciando</td>
    <td>2014-01-16 06:45:09</td>
    <td>&nbsp;</td>
    </tr>
    </tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>


<div id="myModalDescargas" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Ver Descargas</h4>
      </div>
      <div class="modal-body">
      <ul class="nav nav-tabs">
        <li class="active"><a>Spiderman</a></li>
        <li id="total-qty" class="pull-right">Total Descargas <span class="label label-info">550</span></li>
      </ul>
 <table class="table tablaArchivos">
    <thead>
<tr>
<th>Reseller</th>
<th>Cliente</th>
<th>Dispositivo</th>
<th>Fecha Inicio</th>
<th>Fecha Fin</th>
</tr>
</thead>
    <tbody>
    <tr>
    <td>Venezuela</td>
    <td>Juan Perez</td>
    <td>Castelar Norte - 998838i</td>
    <td>10/10/2013 20:00:00</td>
    <td>10/10/2013 21:00:00</td>
    </tr>
    <tr>
    <td>Venezuela</td>
    <td>Juan Perez</td>
    <td>Castelar Norte - 998838i</td>
    <td>10/10/2013 20:00:00</td>
    <td>10/10/2013 21:00:00</td>
    </tr>
    <tr>
    <td>Venezuela</td>
    <td>Juan Perez</td>
    <td>Castelar Norte - 998838i</td>
    <td>10/10/2013 20:00:00</td>
    <td>10/10/2013 21:00:00</td>
    </tr>
    <tr>
    <td>Venezuela</td>
    <td>Juan Perez</td>
    <td>Castelar Norte - 998838i</td>
    <td>10/10/2013 20:00:00</td>
    <td>10/10/2013 21:00:00</td>
    </tr>
    <tr>
    <td>Venezuela</td>
    <td>Juan Perez</td>
    <td>Castelar Norte - 998838i</td>
    <td>10/10/2013 20:00:00</td>
    <td>10/10/2013 21:00:00</td>
    </tr>
    </tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>


<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>