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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
function getCurrentState()
{
	$.post("<?php echo SiteController::createUrl('AjaxGetCurrentState'); ?>"
	).success(
		function(data){
    		if(data != null)
    		{        			
    			var obj = jQuery.parseJSON(data);
    			if(obj.playBack != null)
    			{
        			if(obj.playBack.id != 0)
        			{
    					$('#playback-title').html(obj.playBack.originalTitle);
    					$('#playback').show();
        			}
        			else
        				$('#playback').hide();
    			}
    			else
    				$('#playback').hide();

    			if(obj.currentUSB != null)
    			{
    				if(obj.currentUSB.is_in == 1)
					{
						$('#externalStorage').show();
					}
					else
					{
						$('#externalStorage').hide();
					}

    				/*
    				if(obj.currentUSB.state == 1) //stand-by
					{
    					$('#externalStorage').css("background-image", "url(img/usb_black.png)");
    					$('#myModalExternalStorage').find('#btn-process').show();
						$('#myModalExternalStorage').find('#btn-ripping').hide();
					}
					else if(obj.currentUSB.state == 2) //on copy
					{
						$('#externalStorage').css("background-image", "url(img/usb_green.png)");
						$('#myModalExternalStorage').find('#ESModalMsg').text('Descargando contenido.');
						$('#myModalExternalStorage').find('#btn-process').hide();
						$('#myModalExternalStorage').find('#btn-ripping').show();
					}
					else // finish copy
					{
						$('#externalStorage').css("background-image", "url(img/usb_red.png)");
						$('#myModalExternalStorage').find('#ESModalMsg').text('Contenido descargado con �xito.');
						$('#myModalExternalStorage').find('#btn-process').hide();						
						$('#myModalExternalStorage').find('#btn-ripping').hide();
						$('#myModalExternalStorage').find('#btn-cancel').html('Cerrar');
					}					
    				 */
					
    				if(obj.currentUSB.is_in == 1 && obj.currentUSB.read == 0)
    				{    					
    					if(!$('#myModalExternalStorage').is(':visible'))
						{							
							$('#myModalExternalStorage').modal('show');							
						}
    				}    				
    			}    			
    			
				if(obj.currentDisc != null)
				{
					if(obj.currentDisc.is_in == 1)
					{
						$('#newDisc').show();
					}
					else
					{
						$('#newDisc').hide();
					}
					if(obj.currentDisc.read == 0)
					{
						$.post("<?php echo SiteController::createUrl('AjaxCurrentDiscShowDetail'); ?>"
						).success(
							function(data){
								if(!$('#myModal').is(':visible'))
								{
									$('#view-details').html(data);
									$('#myModal').modal('show');
								} 
							});
					}
				}
    		}
    		else
    		{		        		    				
				$('#playback').hide();
    		} 
		},"json");
	return false;
}

function getExternalUnit()
{
	if($('#myModalExternalStorage').is(':visible'))
	{
		$.post("<?php echo SiteController::createUrl('AjaxGetExternalStorage'); ?>"
		).success(
			function(data){
				$('#external-unit').html(data);
		});
	}
}

function getUnitExplorer()
{
	if($('#myModalExternalStorage').is(':visible'))
	{
		if($('#hidden-working').val() != 0)
		{
			$.post("<?php echo SiteController::createUrl('AjaxGetUnitContent'); ?>",
					{
						id:$('#hidden-unit').val()			    
					}
			).success(
				function(data){
					if(data != 0)
					{
						$('#explorer-unit').html(data);
						$('#hidden-working').val(0);
					}
					else
					{
						$('#explorer-unit').html("<p>La unidad se esta escaneando...</p>");
					}
			});	
		}		
	}
}

$(document).ready(function(){
	getCurrentState();
	$.ajaxSetup({
	    cache: false,
	    headers: {
	        'Cache-Control': 'no-cache'
	    }
	});

	
	setInterval(function() {
		getExternalUnit();
		getUnitExplorer();
		getCurrentState();
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
//	$("#search-query-filter").keyup(function(e){
		//if($(this).val().length <=3)	return false;
//		return false;
//		var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
//	 	$('#search-filter').val(searchFilter); 	 	
//		$('#wall .items').infinitescroll('filterText');
//		});
	$("#search-query-filter").change(function(e){
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
	    	if($('*:focus').attr('id') == 'search-query-filter')
	    	{
	    		$("#search-query-filter").change();
	    		$("#search-query-filter").trigger('blur');
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

    $('#newDisc').click(function(){
    	$.post("<?php echo SiteController::createUrl('AjaxCurrentDiscShowDetail'); ?>"
		).success(
			function(data){
				$('#view-details').html(data);
				$('#myModal').modal('show'); 
			});
    });
    $('#externalStorage').click(function(){
    	if(!$('#myModalExternalStorage').is(':visible'))
		{							
			$('#myModalExternalStorage').modal('show');							
		}
    });
    $('#playlist').click(function(){
    	$.post("<?php echo SiteController::createUrl('AjaxPlaylistsShow'); ?>"
		).success(
			function(data){
				$('#view-details').html(data);
				$('#myModal').modal('show'); 
			});
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
        				var param = '&id=' + obj.id + '&type=' + obj.type + '&id_resource=' + obj.id_resource;
        				window.location = <?php echo '"'. SiteController::createUrl('OpenDuneControl') . '"'; ?> + param;    	
        				return false;
        			}
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
      <!--  <div id="playlist" class="pull-right"><i class="icon-bookmark"></i>Playlist</div>-->
        <div id="newDisc" class="pull-right">Examinar Disco</div>
        <div id="externalStorage" class="pull-right">Disco Externo</div>
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
    <form class="navbar-search pull-right">
    	<input type="search" id="search-query-filter" class="search-query" placeholder="Buscar en Peliculas">    	
	</form>	    
      		
</div>
</div>
</div>
</div>
<?php endif; ?>
<div class="container" >
 
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
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalExternalStorage')); 

echo CHtml::openTag('div',array('id'=>'view-external-storage'));
echo $this->renderPartial('../site/_externalStorage');
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalDiscIn')); 

echo CHtml::openTag('div',array('id'=>'view-disc-in'));
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalESExplorer')); 

echo CHtml::openTag('div',array('id'=>'view-es-explorer'));

echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
<!-- floating DIV para Peliculas en Reproduccion -->
<div id="playback" class="peliReroduciendo">
<div class="rep">
Reproduciendo:
<div id="playback-title" class="tituloRep"></div>
</div>
<a class="btn" id="btn-dune-control"><i class="icon-keyboard"></i> Control Remoto</a>
</div>
<!-- /cierre floating -->
</body>
</html>
