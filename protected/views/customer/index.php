<div class="container" id="screenClientes">
<div class="row">
<div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    	<?php echo $this->renderPartial('_customerGrid',array('model'=>$model)); ?>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container -->