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
$active='usuarios';
include('menu.php');?>
<div class="container" id="screenUsuarios">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pageTitle">Usuarios</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabAdmin" data-toggle="tab">Administradores</a></li>
        <li><a href="#tabMovie" data-toggle="tab">Movie Managers</a></li>
      </ul>
      <div class="tab-content">
      <div class="tab-pane active" id="tabAdmin">
      <a data-toggle="modal" data-target="#myModalCrearAdmin" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Administrador</a>
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>E-mail</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Arnold Montiel</td>
            <td>amontiel</td>
            <td>amontiel</td>
            <td>amontiel@gruposmartliving.com</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
              </td>
          </tr>
          <tr>
            <td>Delfina Rossi</td>
            <td>drossi</td>
            <td>drossi</td>
            <td>drossi@gruposmartliving.com</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
              </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tabAdmin -->
      
      <div class="tab-pane" id="tabMovie">
      <a  data-toggle="modal" data-target="#myModalCrearMovie" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Movie Manager</a>
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>E-mail</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Pablo Pedraza</td>
            <td>ppedraza</td>
            <td>ppedraza</td>
            <td>ppedraza@gruposmartliving.com</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
              </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tabMovie -->
      </div><!-- /.tabContent -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->

<div id="myModalCrearAdmin" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Administrador</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Usuario</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Password</label>
  <input class="form-control" name="campoNombre" type="password">
  </div>
  <div class="form-group">
  <label for="campoNombre">E-mail</label>
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


<div id="myModalCrearMovie" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Movie Manager</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Usuario</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Password</label>
  <input class="form-control" name="campoNombre" type="password">
  </div>
  <div class="form-group">
  <label for="campoNombre">E-mail</label>
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