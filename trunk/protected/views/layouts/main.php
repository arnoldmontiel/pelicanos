<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Pelicano Server</title>
<meta name="viewport"	content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Image Picker -->
<link href="css/image-picker.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/image-picker.min.js"></script>
<!-- JS Select -->
<link href="js/select2-3.4.4/select2.css" rel="stylesheet" />
<script src="js/select2-3.4.4/select2.js"></script>
<!-- JS selectize -->
<link href="css/selectize/selectize.legacy.css" rel="stylesheet" />
<script src="js/selectize/selectizeDelfi.js"></script>
<!-- EXTRA -->
<script src="js/tools.js"></script>
<script src="js/lite-uploader-master/jquery.liteuploader.js"></script>
<?php include('estilos.php');?>

<!-- JQUERY -->

</head>
<body>
		<?php
		$active = 'inicio';
		include ('menu.php');
		?>
		<?php echo $content; ?>
		
		<div id="myModalGeneric" class="modal fade" style="display: none;"
		aria-hidden="true"></div>
	<div id="myModalRequestDevice" class="modal fade"
		style="display: none;" aria-hidden="true"></div>
	<div id="myModalPorts" class="modal fade" style="display: none;"
		aria-hidden="true"></div>
	<div id="myModalEditarAsoc" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalConsumptionDetail" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalConsumptionConfig" class="modal fade in" tabindex="-1"
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
