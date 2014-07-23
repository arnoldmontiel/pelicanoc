<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" manifest="pelicano.manifest">
<head>
<title>Pelicano</title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport"	content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="./pelicano/icons/favicon.ico">
<meta name="apple-mobile-web-app-title" content="Pelicano">

<!-- *************** ALL ICONS *******************  -->
<link rel="shortcut icon" href="./pelicano/icons/favicon.ico">
<!-- For iPad with high-resolution Retina display running iOS � 7: -->
<link rel="apple-touch-icon" sizes="152x152" href="./pelicano/icons/apple-touch-icon-152x152.png">
<!-- For iPad with high-resolution Retina display running iOS � 6: -->
<link rel="apple-touch-icon" sizes="144x144" href="./pelicano/icons/apple-touch-icon-144x144.png">
<!-- For iPhone with high-resolution Retina display running iOS � 7: -->
<link rel="apple-touch-icon" sizes="120x120" href="./pelicano/icons/apple-touch-icon-120x120.png">
<!-- For iPhone with high-resolution Retina display running iOS � 6: -->
<link rel="apple-touch-icon" sizes="114x114" href="./pelicano/icons/apple-touch-icon-114x114.png">
<!-- For the iPad mini and the first- and second-generation iPad on iOS � 7: -->
<link rel="apple-touch-icon" sizes="76x76" href="./pelicano/icons/apple-touch-icon-76x76.png">
<!-- For the iPad mini and the first- and second-generation iPad on iOS � 6: -->
<link rel="apple-touch-icon" sizes="72x72" href="./pelicano/icons/apple-touch-icon-72x72.png">
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
<link rel="apple-touch-icon" href="./pelicano/icons/all-touch-icon.png">
<!-- *************** ALL ICONS *******************  -->
<!-- Bootstrap -->
<link href="./pelicano/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./pelicano/js/jquery.js"></script>
<script type="text/javascript" src="./pelicano/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="./pelicano/css/font-awesome.min.css">
<?php include('./pelicano/protected/views/layouts/estilos.php');?>


<body class="loginBody">
<div id="content">
<div class="container" id="screenLogin" >
    	 <div class="wrapper clearfix">
   <div class="row">
    <div class="col-md-12">
    <div class="loginWrapper">
    <div class="loginBrand">PELICANO</div>
    
    <div class="loginPanel inicioPanel" onclick="delayRedirect()">
	<i class="fa fa-spinner fa-spin"></i>
    <span id="text">Iniciando Pelicano    </span>
      <div id="esperando" class="hidden">
      Dando mas tiempo para agregar acceso directo.
      </div>
    
    <div id="detalles" class="hidden">
      Pelicano no responde, esto puede deberse a:
      <ul>
      <li>Pelicano puede estar apagado</li>
      <li>Pelicano puede estar fuera de la red</li>
      <li>Un problema de conexi&oacute;n</li>
      </ul>
      Si el problema persiste contacte al administrador.
      </div>
    </div>
    	<div class="loginFooter">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved
	</div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>

</body>


<script type="text/javascript">
var timer;
startRedirect();
function startRedirect()
{
	timer =	setInterval(function(){
	  $.ajax({
		  type: 'JSON',
		  url: 'http://<?php echo $_SERVER['HTTP_HOST']?>/pelicano/index.php?r=site/ajaxIsAlive'
	  }).success(function()
	  {
		  window.location = 'http://<?php echo $_SERVER['HTTP_HOST']?>/pelicano'
	  }
	  ).error(function()
	  {
	    $("#text").html("Error - Reintentando");
	    $("#detalles").removeClass('hidden');
	  }
	  );	
  }, 3000);
}

function delayRedirect()
{
	$("#esperando").removeClass('hidden');
	clearTimeout(timer);
	timer =	setInterval(function(){
	  $.ajax({
		  type: 'JSON',
		  url: 'http://<?php echo $_SERVER['HTTP_HOST']?>/pelicano/index.php?r=site/ajaxIsAlive'
	  }).success(function()
	  {
		  window.location = 'http://<?php echo $_SERVER['HTTP_HOST']?>/pelicano'
	  }
	  ).error(function()
	  {
	    $("#text").html("Error - Reintentando");
	    $("#detalles").removeClass('hidden');
	  }
	  );	
  }, 20000);
}
</script>