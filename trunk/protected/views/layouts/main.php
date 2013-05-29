<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.icon-large.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- isotope -->
<link href="css/isotope.css" rel="stylesheet" media="screen">
<!--<link href="css/pelicano.css" rel="stylesheet" media="screen">
-->


	<?php include('estilos.php');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>


<script type="text/javascript">	
$(document).ready(function(){
	
	$('#nav li').removeClass('active');
	if(document.URL.indexOf('Serie') > 0)
		$('#li-serie').addClass('active');
	else if(document.URL.indexOf('marketplace') > 0)
		$('#li-marketplace').addClass('active');
	else if(document.URL.indexOf('download') > 0)
		$('#li-download').addClass('active');
	else 
		$('#li-movie').addClass('active');

	$('#main-search').change(function(){
		var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
	 	$('#search-filter').val(searchFilter); 	 	
		$('#wall .items').infinitescroll('filterText');  
	});

	$('#nav a').click(function(){		
		window.location = $(this).attr('href');
		return false;
	});
	
	$('#filtroGenero button').click(function(){
		  var selector = $(this).attr('data-filter');  
		  $('#media-type-filter').val(selector);
		  $('#current-filter').val(selector);
		  
		  //clean search filter
		  $('#search-filter').val(null);
		  $('#index_search').val(null);

		  $('#wall .items').infinitescroll('retrieve');  
		  $('#wall .items').isotope({ filter: selector });
		  $('#wall .items').isotope('shuffle');
		  return false;
		});
	
    $('#MenuLogo').click(function(){    	
	  window.location = <?php echo '"'. SiteController::createUrl('site/index') . '"'; ?>;    	
	  return false;
	});

});
   
    
</script>
</head>

<input id="media-type-filter" type="hidden" name="media-type-filter" value="*">
<input id="current-filter" type="hidden" name="current-filter" value="*">
<input id="search-filter" type="hidden" name="search-filter" value="">
<body id="screenHome">
<div class="navbar navbar-fixed-top">
<div class="navbar-inner" id="Menu">
    <div class="container"> 
    	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
    		<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
    	</a> 
    	<a class="brand" id="MenuLogo" href="#">Pelicano</a>
      <div class="nav-collapse collapse">
        <ul id="nav" class="nav">
          <li id="li-movie"><a href="index.php">Mis Peliculas</a></li>
          <li id="li-serie"><a href="<?php echo SiteController::createUrl('site/indexSerie') ?>">Mis Series</a></li>        
		  <li id="li-marketplace"><a href="<?php echo RippedMovieController::createUrl('rippedMovie/index') ?>">Marketplace</a></li>
          <li id="li-download"><a href="#">Descargas</a></li>
        </ul>
        <?php 
			 	$customer = Setting::getInstance()->getCustomer();
			 	$username = (User::getCurrentUser())?User::getCurrentUser()->username : ''; 
		?>
        <div id="loginInfo" class="pull-right"><?php echo $username; ?><br/><span class="points"><?php echo isset($customer)?$customer->current_points:'0' ?> points</span></div>

        <form class="navbar-search pull-right">
          <input type="text" id="main-search" class="search-query" placeholder="Buscar...">
        </form>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<div class="navbar navbar-fixed-top  navbarSecond">
              <div class="navbar-inner">
                <div class=" row-fluid visible-desktop visible-tablet btn-toolbar">
    <div class="span6">
      <div id="filtroGenero" class="btn-group">
        <button class="btn" data-filter="*">Todas</button>
        <button class="btn" data-filter=".comedy">Comedia</button>
        <button class="btn" data-filter=".drama">Drama</button>
        <button class="btn" data-filter=".romance">Romance</button>
        <button class="btn" data-filter=".fantasy">Fantasia</button>
      </div>
      <!-- /btn group -->
    </div>
    <!-- /span6 -->
    <div class="span6 pagination-right">
      <div id="filtroEdad" class="btn-group">
        <button class="btn">ATP</button>
        <button class="btn">Mayores 13</button>
        <button class="btn">Mayores 16</button>
      </div>
      <!-- /btn group -->
    </div>
    <!-- /span6 -->
  </div>
  <!-- /row -->     
              </div>
            </div>
<div class="container" >
  <div class=" row-fluid visible-phone btn-toolbar">
    <div class="span12">
      <button class="btn dropdown-toggle" data-toggle="dropdown">G&eacute;nero <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="#">Todos</a></li>
        <li><a href="#">Comedia</a></li>
        <li><a href="#">Drama</a></li>
        <li><a href="#">Romance</a></li>
        <li><a href="#">Adultos</a></li>
      </ul>
      <button class="btn dropdown-toggle" data-toggle="dropdown">P&uacute;blico <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="#">ATP</a></li>
        <li><a href="#">Mayores 13</a></li>
        <li><a href="#">Mayores 16</a></li>
      </ul>
    </div>
    <!-- /span12 -->
  </div>
  <!-- /row -->
 
 
 <?php
 //$descargar='no'; 
 //include('movieDetails.php'); 
 //include('serieDetails.php'); ?>

  <div class="row-fluid">
    <div class="span12">
    
      	<?php echo $content; ?>        
    
      <!-- /content -->
    </div>
    <!-- /span12 -->
  </div>
  <!-- /row -->
</div>
<!-- /container -->

</body>
</html>
