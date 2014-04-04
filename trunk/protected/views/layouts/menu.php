<script type="text/javascript">
<?php if(Yii::app()->user->checkAccess('DeviceManage')):?>
setInterval(function() {
	getPendingDevices();
}, 5 * 60 * 1000); // cada 5 minutos verifica los dispositivos pendientes

getPendingDevices();

function getPendingDevices()
{
	$.post("<?php echo Yii::app()->createUrl('device/AjaxGetPendingDeviceQty'); ?>"
		).success(
			function(data){
				$('#pendingDevicesQty').text(data);	  
			});
	return false;
}
<?php endif?>
</script>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">P SERVER</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <?php $active = Yii::app()->controller->id;?>
          <?php if(Yii::app()->user->checkAccess('NzbManage')):?>
          <li <?php if ($active=="nzb"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("nzb/index")?>"><i class="fa fa-film fa-fw"></i> Pel&iacute;culas</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('NzbManageRe')):?>
          <li <?php if ($active=="nzb"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("nzb/indexRe")?>"><i class="fa fa-film fa-fw"></i> Pel&iacute;culas</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('UserManage')):?>
          <li <?php if ($active=="user"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("user/index")?>"><i class="fa fa-user fa-fw"></i> Usuarios</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('ResellerManage')):?>
          <li <?php if ($active=="reseller"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("reseller/index")?>"><i class="fa fa-group fa-fw"></i> Resellers</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('CustomerManageRe')):?>
          <li <?php if ($active=="customer"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("customer/indexRe")?>"><i class="fa fa-smile-o fa-fw"></i> Clientes</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('CustomerManage')):?>
          <li <?php if ($active=="customer"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("customer/index")?>"><i class="fa fa-smile-o fa-fw"></i> Clientes</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('DeviceManageRe')):?>
          <li <?php if ($active=="device"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("device/indexRe")?>"><i class="fa fa-hdd-o fa-fw"></i> Dispositivos</a></li>
          <?php endif?>
          <?php if(Yii::app()->user->checkAccess('DeviceManage')):?>
          <li <?php if ($active=="device"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("device/index")?>"><i class="fa fa-hdd-o fa-fw"></i> Dispositivos <span id="pendingDevicesQty" class="badge"></span></a></li>
          <?php endif?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> <?php echo Yii::app()->user->name;?> <i class="fa fa-caret-down fa-fw"></i></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo Yii::app()->createUrl('site/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
        </div><!-- /.navbar-collapse -->
      </nav>