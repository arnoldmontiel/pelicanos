<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<title>Pelicano Server</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="css/image-picker.css" rel="stylesheet" media="screen">
		<link href="js/select2-3.4.4/select2.css" rel="stylesheet" />		
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php include('estilos.php');?>
		
		<script src="js/tools.js"></script>
		<script src="js/select2-3.4.4/select2.js"></script>
		<script type="text/javascript" src="js/image-picker.min.js"></script>
		<script src="js/lite-uploader-master/jquery.liteuploader.js"></script>
	</head>
	<body>
		<?php 
			$active='inicio';
			include('menu.php');
		?>
		<?php echo $content; ?>
		
		<div id="myModalGeneric" class="modal fade" style="display: none;" aria-hidden="true">
		</div>
		<div id="myModalRequestDevice" class="modal fade" style="display: none;" aria-hidden="true">
		</div>
		<div id="myModalPorts" class="modal fade" style="display: none;" aria-hidden="true">
		</div>
		<div id="myModalEditarAsoc" class="modal fade in" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
		<div id="myModalCambiarAfiche" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
		<div id="myModalCambiarBackdrop" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
		<!-- Le javascript
		    ================================================== --> 
		<!-- Placed at the end of the document so the pages load faster --> 
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
