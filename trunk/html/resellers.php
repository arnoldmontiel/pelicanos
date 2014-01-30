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
$active='resellers';
include('menu.php');?>
<div class="container" id="screenResellers">
<div class="row">
<div class="col-sm-6">
  <h1 class="pageTitle">Resellers</h1>
  </div>
  <div class="col-sm-6 align-right">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearReseller"><i class="fa fa-plus"></i> Agregar Reseller</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual">
        <thead>
          <tr>
            <th>Descripci&oacute;n</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>E-mail</th>
            <th class="align-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Juan Perez</td>
            <td>jperez</td>
            <td>jperez</td>
            <td>juan@perez.com</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
              </td>
          </tr>
          <tr>
            <td>Pablo Pedraza</td>
            <td>ppedraza</td>
            <td>ppedraza</td>
            <td>pablo@pedraza.com</td>
            <td class="align-right"><button type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i> Editar</button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
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

<div id="myModalCrearReseller" class="modal fade in" style="display: hidden;" aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Reseller</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Descripci&oacute;n</label>
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

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>