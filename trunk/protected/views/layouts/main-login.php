<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport"	content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php include('estilos.php');?>
</head>

<body class="loginBody">
<div class="container" id="screenLogin" >

   <div class="row">
    <div class="col-md-12">
    <div class="loginWrapper">
    <div class="loginBrand">PELICANO</div>
    
    <div class="loginPanel">
    <form class="loginForm" method="post" action="index.html">
        <p><input type="text" class="inputLogin" name="login" value="" placeholder="Usuario or Email"></p>
        <p><input type="password" class="inputLogin" name="password" value="" placeholder="Password"></p>
        <div class="checkbox">
        <label>
          <input type="checkbox"> Recordarme
        </label>
      </div>
      <div class="separatorLine"></div>
        <button class="btn btn-primary">Ingresar</button>
      </form>
      </div>
    </div>
    </div>
    </div>
    </div>
    
<div class="container" id="page">

	<div id="header">
	</div><!-- header -->

	<div class="second-menu">
	
	</div>
		
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by WestIdeas.
	</div><!-- footer -->

</div><!-- page -->

</div>
</body>
</html>
