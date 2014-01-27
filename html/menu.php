

<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">P SERVER</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <li <?php if ($active=="inicio"){ echo 'class="active"';}?> ><a href="index.php"><i class="fa fa-film fa-fw"></i> Pel&iacute;culas</a></li>
          <li <?php if ($active=="productos"){ echo 'class="active"';}?> ><a href="productos.php"><i class="fa fa-group fa-fw"></i> Resellers</a></li>
          <li <?php if ($active=="proveedores"){ echo 'class="active"';}?> ><a href="proveedores.php"><i class="fa fa-smile-o fa-fw"></i> Clientes</a></li>
          <li <?php if ($active=="precios"){ echo 'class="active"';}?> ><a href="precios.php"><i class="fa fa-hdd-o fa-fw"></i> Dispositivos</a></li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </nav>