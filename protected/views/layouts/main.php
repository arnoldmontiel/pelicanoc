<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.icon-large.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- isotope -->
<link href="css/isotope.css" rel="stylesheet" media="screen">
<!--<link href="css/pelicano.css" rel="stylesheet" media="screen">
-->
<!-- Flexslider -->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- Modernizr -->
<script src="js/modernizr.js"></script>

	<?php include('estilos.php');?>

	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>


<script type="text/javascript">	
function getCurrentDisc()
{
	$.post("<?php echo SiteController::createUrl('AjaxGetCurrentDisc'); ?>"
		).success(
		function(data){
			var result = JSON.parse(data);
			if(result.is_in == 1)
			{
				$('#loginInfo').css('background-image','url("img/userIconIN.png")');
			}
			else
			{
				$('#loginInfo').css('background-image','url("img/userIcon.png")');
			}
			if(result.read == 0)
			{
				$.post("<?php echo SiteController::createUrl('AjaxCurrentDiscShowDetail'); ?>"
				).success(
					function(data){
						$('#view-details').html(data);
						$('#myModal').modal('show'); 
					});
			}
			
		});
}

$(document).ready(function(){
	$.ajaxSetup({
	    cache: false,
	    headers: {
	        'Cache-Control': 'no-cache'
	    }
	});
	
	setInterval(function() {
		getCurrentDisc();
	}, 5000);
	
	
	$('#nav li').removeClass('active');
	if(document.URL.indexOf('Serie') > 0)
		$('#li-serie').addClass('active');
	else if(document.URL.indexOf('marketplace') > 0)
		$('#li-marketplace').addClass('active');
	else if(document.URL.indexOf('download') > 0)
		$('#li-download').addClass('active');
	else 
		$('#li-movie').addClass('active');
	$("#search-query-filter").keyup(function(e){
		var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
	 	$('#search-filter').val(searchFilter); 	 	
		$('#wall .items').infinitescroll('filterText');
		});
	
	$(document).keypress(function(e) {
	    if(e.keyCode == 13) 
	    {
	    	if($('*:focus').attr('id') == 'main-search')
	    	{
	    		$('#main-search').change();
	    		return false;
	    	}    	
			return false; 
	    }
	});
	
	$('#main-search').change(function(){
		var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
	 	$('#search-filter').val(searchFilter); 	 	
		$('#wall .items').infinitescroll('filterText');  
	});

	$('#nav a').click(function(){		
		window.location = $(this).attr('href');
		return false;
	});
		
	$('#filtroGenero li').click(function(){
		  var selector = $(this).children().attr("data-filter");
		   
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

	$('#filtroGenero li.menuItem a').click(function () {
		  $('#filtroGenero li.active').removeClass('active')
		  $(this).parent('li').addClass('active');
		  $("#selectedGenero .selected").text($(this).text());
		})
	
    $('#MenuLogo').click(function(){    	
	  window.location = <?php echo '"'. SiteController::createUrl('site/index') . '"'; ?>;    	
	  return false;
	});

    $('#loginInfo').click(function(){
    	var image = $('#loginInfo').css('background-image');
    	if(image.indexOf('userIconIN.png')>0)
    	{
    		$.post("<?php echo SiteController::createUrl('AjaxCurrentDiscShowDetail'); ?>"
			).success(
				function(data){
					$('#view-details').html(data);
					$('#myModal').modal('show'); 
				});
    	}
    	
    });

    $('#btn-dune-control').click(function(){    	
    	$.post("<?php echo SiteController::createUrl('AjaxGetPlayback'); ?>"
    	).success(
    		function(data){
        		if(data != null)
        		{        			
        			var obj = jQuery.parseJSON(data);
        			if(obj.id != 0)
        			{
        				var param = '&id=' + obj.id + '&type=' + obj.type;
        				window.location = <?php echo '"'. SiteController::createUrl('OpenDuneControl') . '"'; ?> + param;    	
        				return false;
        			}
        			else
        				$('#myModalNoPlaying').modal('show');
        		}
        		else
        		{		        		    				
    				$('#myModalNoPlaying').modal('show');
        		} 
    		},"json");
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
          <li id="li-serie"><a href="#">Mis Series</a></li>
		  <li id="li-marketplace"><a href="<?php echo RippedMovieController::createUrl('site/marketplace') ?>">Marketplace</a></li>
		  <li id="li-download"><a href="<?php echo RippedMovieController::createUrl('site/downloads') ?>">Descargas</a></li>          
        </ul>
        <?php 
			 	$customer = Setting::getInstance()->getCustomer();
			 	$username = (User::getCurrentUser())?User::getCurrentUser()->username : ''; 
		?>
        <div id="loginInfo" class="pull-right"><?php echo $username; ?><br/><span class="points"><?php echo isset($customer)?$customer->current_points:'0' ?> points</span></div>		
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<?php if (isset($this->showFilter) && $this->showFilter): ?>
<div class="navbar navbar-fixed-top  navbarSecond">
  <div class="navbar-inner">
    <div class="container">
 
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
<!-- Everything you want hidden at 940px or less, place within here -->
<div class="nav-collapse collapse">
	<!-- .nav, .navbar-search, .navbar-form, etc -->
	<ul id="filtroGenero" class="nav">
		<li class="active menuItem generoTodas"><a  href="#" data-filter="*">Todas</a></li>
		<li class="menuItem generoComedia"><a href="#" data-filter=".comedy">Comedia</a></li>
		<li class="menuItem generoDrama"><a href="#" data-filter=".drama">Drama</a></li>
		<li class="menuItem generoRomance"><a href="#" data-filter=".romance">Romance</a></li>
		<li class="menuItem generoAdultos"><a href="#" data-filter=".fantasy">Fantasia</a></li>
		<li class="dropdown" id="filtroGeneroMob">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="selectedGenero"><span class="selected">Todos los G&eacute;neros</span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
            	<li><a href="#" data-sel="generoTodas" data-filter="*">Todos los G&eacute;neros</a></li>
				<li><a href="#" data-sel="generoComedia" data-filter=".comedy">Comedia</a></li>
                <li><a href="#" data-sel="generoDrama" data-filter=".drama">Drama</a></li>
                <li><a href="#" data-sel="generoRomance" data-filter=".romances">Romance</a></li>
                <li><a href="#" data-sel="generoAdultos" data-filter=".fantasy">Fantasia</a></li>
			</ul>
		</li>
	</ul>
    <ul id="filtroEdad" class="nav">
    	<li class="active menuItem edadATP"><a href="#">ATP</a></li>
        <li class="menuItem edad13"><a href="#">Mayores 13</a></li>
        <li class="menuItem edad16"><a href="#">Mayores 16</a></li>
        <li class="dropdown" id="filtroEdadMob">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="selectedEdad"><span class="selected">ATP</span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
            	<li><a href="#" data-sel="edadATP" data-filter=".comedia">ATP</a></li>
                <li><a href="#" data-sel="edad13" data-filter=".comedia">Mayores 13</a></li>
                <li><a href="#" data-sel="edad16" data-filter=".drama">Mayores 16</a></li>
			</ul>
		</li>
	</ul>	
    <form class="navbar-search pull-right">
    	<input type="text" id="search-query-filter" class="search-query" placeholder="Buscar en Peliculas">
    	<button id="btn-dune-controls" class="btn">Control</button>
	</form>	    
      		
</div>
</div>
</div>
</div>
<?php endif; ?>
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
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalNoPlaying')); 

echo CHtml::openTag('div',array('id'=>'view-no-playing'));
echo $this->renderPartial('../site/_noPlaying');
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalDiscIn')); 

echo CHtml::openTag('div',array('id'=>'view-disc-in'));
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>

<!-- floating DIV para Peliculas en Reproduccion -->
<div class="peliReroduciendo">
<div class="rep">
Reproduciendo:
<div class="tituloRep">Les Miserables</div>
</div>
<a class="btn" id="btn-dune-control"><i class="icon-keyboard"></i> Control Remoto</a>
</div>
<!-- /cierre floating -->
</body>
</html>
