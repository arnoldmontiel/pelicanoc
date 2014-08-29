<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport"	content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-title" content="Pelicano">

<!-- *************** ALL ICONS *******************  -->
<link rel="shortcut icon" href="./icons/favicon.ico">
<!-- For iPad with high-resolution Retina display running iOS � 7: -->
<link rel="apple-touch-icon" sizes="152x152" href="./icons/apple-touch-icon-152x152.png">
<!-- For iPad with high-resolution Retina display running iOS � 6: -->
<link rel="apple-touch-icon" sizes="144x144" href="./icons/apple-touch-icon-144x144.png">
<!-- For iPhone with high-resolution Retina display running iOS � 7: -->
<link rel="apple-touch-icon" sizes="120x120" href="./icons/apple-touch-icon-120x120.png">
<!-- For iPhone with high-resolution Retina display running iOS � 6: -->
<link rel="apple-touch-icon" sizes="114x114" href="./icons/apple-touch-icon-114x114.png">
<!-- For the iPad mini and the first- and second-generation iPad on iOS � 7: -->
<link rel="apple-touch-icon" sizes="76x76" href="./icons/apple-touch-icon-76x76.png">
<!-- For the iPad mini and the first- and second-generation iPad on iOS � 6: -->
<link rel="apple-touch-icon" sizes="72x72" href="./icons/apple-touch-icon-72x72.png">
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
<link rel="apple-touch-icon" href="./icons/all-touch-icon.png">
<!-- *************** ALL ICONS *******************  -->
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php include('estilos.php');?>
</head>

<body class="loginBody">
<div id="content">

<div class="container" id="screenLogin" >
    	 <div class="wrapper clearfix">
   <div class="row">
    <div class="col-md-12">
    <div class="loginWrapper">
    <div class="loginBrand">PELICANO</div>
    
    <div class="loginPanel">
	<?php echo $content; ?>
    
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
</html>
