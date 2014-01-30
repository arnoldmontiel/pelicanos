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
$active='dispositivos';
include('menu.php');?>
<div class="container" id="screenDispositivos">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Dispositivos Pedidos</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Resller</th>
            <th>Cliente</th>
            <th>Fecha Pedido</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Venezuela</td>
            <td>Juan Perez</td>
            <td>10/10/2013</td>
            <td class="align-right"><button data-toggle="modal" data-target="#myModalCrearDispositivo" type="button" class="btn btn-default btn-sm" ><i class="fa fa-plus"></i> Crear Dispositivo</button>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Dispositivos</h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Resller</th>
            <th>Cliente</th>
            <th>Fecha Creaci&oacute;n</th>
            <th>Descargas</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Venezuela</td>
            <td>Juan Perez</td>
            <td>10/10/2013</td>
            <td>200</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button>
              </td>
          </tr>
          <tr>
            <td>Venezuela</td>
            <td>Arnold Montiel</td>
            <td>10/10/2013</td>
            <td>10</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button>
              </td>
          </tr>
          <tr>
            <td>Venezuela</td>
            <td>Pedro Pablo</td>
            <td>10/10/2013</td>
            <td>14</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button>
              </td>
          </tr>
          <tr>
            <td>Venezuela</td>
            <td>Simon Cowell</td>
            <td>10/10/2013</td>
            <td>87</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#myModalViewDownloads" ><i class="fa fa-clock-o"></i> Ver Descargas</button>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->



<div id="myModalCrearDispositivo" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Crear Dispositivo</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Cliente</label>
  <div>Juan Perez</div>
  </div>
  <div class="form-group">
  <label for="campoNombre">Reseller</label>
  <div>Venezuela</div>
  </div>
  <div class="form-group">
  <label for="campoNombre">Dato1</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Dato2</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Dato3</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div>



<div id="myModalViewDownloads" class="modal fade in" style="display: hidden;" aria-hidden="false">
  <div id="container-modal-addProduct" style="">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Descargas </h4>
        </div>
        <div class="modal-body">
         <ul class="nav nav-tabs">
        <li class="active"><a>Castelar Norte (ID: 30909fdjf)</a></li>
        <li id="total-qty" class="pull-right">Total Descargas <span class="label label-info">550</span></li>
      </ul>
              <div id="product-grid-add" class="grid-view">
                <table class="table table-striped table-bordered tablaIndividual">
                  <thead>
                    <tr>
                      <th>ID Imdb</th>
                      <th>T&iacute;tulo</th>
                      <th>G&eacute;nero</th>
                      <th>Año</th>
                      <th>Nzb Status</th>
                      <th>Fecha Enviado</th>
                      <th>Inicio Descarga</th>
                      <th>Fin Descarga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>tt1343092</td>
                      <td class="bold">The Great Gatsby</td>
                      <td>Drama, Romance</td>
                      <td>2013</td>
                      <td>Sent</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                    </tr>
                    <tr>
                      <td>tt1343092</td>
                      <td class="bold">Spiderman</td>
                      <td>Drama, Romance</td>
                      <td>2013</td>
                      <td>Sent</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                    </tr>
                    <tr>
                      <td>tt1343092</td>
                      <td class="bold">Titanic</td>
                      <td>Drama, Romance</td>
                      <td>2013</td>
                      <td>Sent</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                    </tr>
                    <tr>
                      <td>tt1343092</td>
                      <td class="bold">Rapido y Furioso</td>
                      <td>Drama, Romance</td>
                      <td>2013</td>
                      <td>Sent</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                      <td>2013-12-28 14:00:23</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content --> 
      
    </div>
    <!-- /.modal-dialog --></div>
</div>


<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>