

<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">P SERVER</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <?php $active = Yii::app()->controller->id;?>
          <li <?php if ($active=="nzb"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("nzb/index")?>"><i class="fa fa-film fa-fw"></i> Pel&iacute;culas</a></li>
          <li <?php if ($active=="user"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("user/index")?>"><i class="fa fa-user fa-fw"></i> Usuarios</a></li>
          <li <?php if ($active=="reseller"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("reseller/index")?>"><i class="fa fa-group fa-fw"></i> Resellers</a></li>
          <li <?php if ($active=="clientes"){ echo 'class="active"';}?> ><a href="clientes.php"><i class="fa fa-smile-o fa-fw"></i> Clientes</a></li>
          <li <?php if ($active=="dispositivos"){ echo 'class="active"';}?> ><a href="dispositivos.php"><i class="fa fa-hdd-o fa-fw"></i> Dispositivos <span class="badge">1</span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> admin <i class="fa fa-caret-down fa-fw"></i></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
        </div><!-- /.navbar-collapse -->
      </nav>