<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>GREEN</title>
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
$active='productos';
include('menu.php');?>
<ol class="breadcrumb">
  <li class="active"><a href="#">Productos</a></li>
</ol>
<div class="container" id="screenProductos">
  <h1 class="pageTitle">Productos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li><a href="#tabPendientes" data-toggle="tab">Datos Incompletos <span class="badge">4</span></a></li>
        <li><a href="#tabPorMarca" data-toggle="tab">por Marca </a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabTodos">
     <a href="agregarProducto.php" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Alto</th>
            <th style="text-align:left;">Ancho</th>
            <th style="text-align:left;">Largo</th>
            <th style="text-align:left;">Peso</th>
            <th style="text-align:left;">Tasa</th>
            <th style="text-align:left;">Dealer Cost</th>
            <th style="text-align:left;">MSRP</th>
            <th style="text-align:left;">Resumen</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabPendientes">
     <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Alto</th>
            <th style="text-align:left;">Ancho</th>
            <th style="text-align:left;">Largo</th>
            <th style="text-align:left;">Peso</th>
            <th style="text-align:left;">Tasa</th>
            <th style="text-align:left;">Dealer Cost</th>
            <th style="text-align:left;">MSRP</th>
            <th style="text-align:left;">Resumen</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td><a class="label label-danger" data-toggle="modal" data-target="#myModalPeque">Incompleto <i class="fa fa-pencil"></i> </a></td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td><a class="label label-danger" data-toggle="modal" data-target="#myModalPeque">Incompleto <i class="fa fa-pencil"></i> </a></td>
            <td>0.40 mt</td>
            <td><a class="label label-danger" data-toggle="modal" data-target="#myModalPeque">Incompleto <i class="fa fa-pencil"></i> </a></td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td><a class="label label-danger" data-toggle="modal" data-target="#myModalPeque">Incompleto <i class="fa fa-pencil"></i> </a></td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td><a class="label label-danger" data-toggle="modal" data-target="#myModalPeque">Incompleto <i class="fa fa-pencil"></i> </a></td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab2 --> 
     <div class="tab-pane" id="tabPorMarca">
     <a href="control.php" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalUploadExcel"><i class="fa fa-upload"></i>  Cargar Nuevo Excel</a>
     <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Productos</th>
            <th style="text-align:left;">Última Actualización</th>
            <th style="text-align:left;">Estado</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Vantage</td>
            <td>5 <span class="text-danger">(1)</span></td>
            <td>06/10/2013</td>
            <td><span class="label label-danger">Datos Incompletos</span></td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar Excel</button> <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalActualizar"><i class="fa fa-upload"></i> Cargar Actualización</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>RTI</td>
            <td>13</td>
            <td>06/10/2013</td>
            <td><span class="label label-success">Procesado</span></td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar Excel</button> <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalActualizar"><i class="fa fa-upload"></i> Cargar Actualización</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>SIM2</td>
            <td>30</td>
            <td>06/10/2013</td>
            <td><span class="label label-success">Procesado</span></td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar Excel</button> <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalActualizar"><i class="fa fa-upload"></i> Cargar Actualización</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>DBox</td>
            <td>8 <span class="text-danger">(4)</span></td>
            <td>06/10/2013</td>
            <td><span class="label label-danger">Datos Incompletos</span></td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar Excel</button> <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalActualizar"><i class="fa fa-upload"></i> Cargar Actualización</button><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab3 --> 
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<!--MODAL EXCEL-->
<div class="modal fade" id="myModalUploadExcel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cargar Nuevo Excel</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoArchivo">Archivo</label>
    <input type="file" id="campoArchivo">
  </div>
  <div class="form-group">
    <label for="campoMarca">Marca</label>
    <select class="form-control" id="campoMarca">
    <option>Opcion 1</option>
    <option>Opcion 2</option>
    <option>Opcion 3</option>
    </select>
  </div>
  <div class="form-group">
    <label for="campoPeso">Unidad de Peso</label>
    <select class="form-control" id="campoPeso">
    <option>Opcion 1</option>
    <option>Opcion 2</option>
    <option>Opcion 3</option>
    </select>
  </div>
  <div class="form-group">
    <label for="campoLineal">Unidad Lineal</label>
    <select class="form-control" id="campoLineal">
    <option>Opcion 1</option>
    <option>Opcion 2</option>
    <option>Opcion 3</option>
    </select>
  </div>
</form>

<!--Esto aparece una vez que le das Cargar-->
<div class="estadoModal">
    <label for="campoLineal">Estado</label>
<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i>
 <strong>Analizando archivo</strong>, espere por favor.</div>
 
 <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
 <strong>Se ha producido un error</strong>, revise el archivo e inténtelo nuevamente.</div>
 
 <div class="alert alert-success"><i class="fa fa-check"></i>
 <strong>La carga fue correcta.</strong></div>
 
 </div>
<!--Fin notificacion-->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL EXCEL-->


<!--MODAL ACTUALIZAR-->
<div class="modal fade" id="myModalActualizar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Actualizar Excel: Vantage</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoArchivo">Archivo</label>
    <input type="file" id="campoArchivo">
  </div>
  <div class="form-group">
    <label for="campoMarca">Marca</label>
    <select class="form-control" id="campoMarca" disabled="disabled">
    <option disabled="disabled">Vantage</option>
    </select>
  </div>
  <div class="form-group">
    <label for="campoPeso">Unidad de Peso</label>
    <select class="form-control" id="campoPeso">
    <option>Opcion 1</option>
    <option>Opcion 2</option>
    <option>Opcion 3</option>
    </select>
  </div>
  <div class="form-group">
    <label for="campoLineal">Unidad Lineal</label>
    <select class="form-control" id="campoLineal">
    <option>Opcion 1</option>
    <option>Opcion 2</option>
    <option>Opcion 3</option>
    </select>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Actualizar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL EXCEL-->


<!--MODAL PEQUE-->
<div class="modal fade" id="myModalPeque">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">AD4 - RTI: Dealer Cost</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoDealerCost">Dealer Cost</label>
        <input type="email" class="form-control" id="campoDealerCost" placeholder="USD">
  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL PEQUE-->

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>