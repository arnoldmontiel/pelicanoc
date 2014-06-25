<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" manifest="pelicano.manifest">
<head>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport"	content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Bootstrap -->
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="./css/font-awesome.min.css">
<?php include('./estilos.php');?>


<body class="loginBody">
<div id="content">
<div class="container" id="screenLogin" >
    	 <div class="wrapper clearfix">
   <div class="row">
    <div class="col-md-12">
    <div class="loginWrapper">
    <div class="loginBrand">PELICANO</div>
    
    <div class="loginPanel inicioPanel">
<i class="fa fa-spinner fa-spin"></i>
    <p id="text">Iniciando Pelicano    </p>
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

</body>


<script type="text/javascript">
  setInterval(function(){
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
	  }
	  );	
  }, 3000);

</script>