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
$active='clientes';
include('menu.php');?>
<div class="container" id="screenClientes">
<div class="row">
<div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
  <div class="col-sm-6 align-right">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearCliente"><i class="fa fa-plus"></i> Agregar Cliente</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Reseller</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direcci&oacute;n</th>
            <th>Dispositivos</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Juan Perez</td>
            <td>Arnold</td>
            <td>Montiel</td>
            <td>Lobos 1747</td>
            <td>
            <div>&bull; Castelar Norte - 50ed8335ae2ef</div>
            <div>&bull; Casa - 32342ddv5g5</div>
            <div>&bull; Quincho - 45435535 <span class="label label-danger">pendiente 20/12/2013</span></div>
            <div>&bull; Banio - 34234242 <span class="label label-danger">pendiente 20/12/2013</span></div>
            </td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalRequest" ><i class="fa fa-hdd-o"></i> Solicitar Dispositivo</button></td>
          </tr>
          <tr>
            <td>Juan Perez</td>
            <td>Delfina</td>
            <td>Rossi</td>
            <td>Olaya 1787</td>
            <td>
            <div>&bull; Casa - 2332d32dgg4</div>
            </td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalRequest" ><i class="fa fa-hdd-o"></i> Solicitar Dispositivo</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->


<div id="myModalCrearCliente" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Apellido</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Direcci&oacute;n</label>
  <input class="form-control" name="campoNombre" type="password">
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
<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>