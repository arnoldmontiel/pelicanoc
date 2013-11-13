<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Isotope -->
<link href="css/isotope.css" rel="stylesheet" media="screen">
<!-- Flexslider -->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- Modernizr -->
<script src="js/modernizr.js"></script>
<!-- Image Picker -->
<link href="css/image-picker.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/image-picker.min.js"></script>
<!-- JS Select -->
<link href="js/select2-3.4.4/select2.css" rel="stylesheet"/>
<script src="js/select2-3.4.4/select2.js"></script>
<script src="js/lite-uploader-master/jquery.liteuploader.js"></script>


	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
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
    				if(obj.currentUSB.devicesQty >= 1)
        			{
    					$('#devicesQty').show();
    					$('#devicesQty').html(obj.currentUSB.devicesQty);
        			}
    				else
    				{
    					$('#popover-disp').popover('hide');
    					$('#devicesQty').hide();
    				}
					
    				if(obj.currentUSB.is_in == 1 && obj.currentUSB.read == 0)
    				{    			        					
    					if(!$('#popover-dispositivos').is(":visible"))
    					{        					    						
    						$('#popover-disp').popover('show');
    						$('#popoverDisTitle').text(obj.currentUSB.label);
    						$('#btnGoToDevice').attr('iddevice',obj.currentUSB.idUnread);
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
									$('#myModal').html(data);
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

function markPopoverAsRead()
{
	$.post("<?php echo SiteController::createUrl('AjaxMarkCurrentESRead'); ?>"
	).success(
		function(data){
			$('#popover-disp').popover('hide');
	});
}


function closePopover()
{
	markPopoverAsRead();	
}

function goToDevices()
{
	var id = $("#btnGoToDevice").attr('iddevice');
	$('#popover-disp').popover('hide');
	window.location = <?php echo '"'. SiteController::createUrl('site/GoToDevices') . '"'; ?> + "&idSelected="+id;    
	return false;
}

$(document).ready(function(){
	var elem ='Nuevo Dispositivo conectado<div id="popoverDisTitle" class="popoverDisTitle">USB (Kingston)</div><div class="popoverButtons"><button type="button" onclick="closePopover()" class="btn btn-default">Cerrar</button><button type="button" onclick="goToDevices()" id="btnGoToDevice" class="btn btn-primary noMargin">Examinar</button></div></div>';
	$('#popover-disp').popover({
        placement: 'bottom',
        content:elem,
        html:true,
        template:'<div id="popover-dispositivos" class="popover fade bottom in"><div class="arrow"></div><div class="popover-content"><div class="popoverDisTitle"></div></div>'
    });
	
	getCurrentState();
	$.ajaxSetup({
	    cache: false,
	    headers: {
	        'Cache-Control': 'no-cache'
	    }
	});

	
	setInterval(function() {		
		getCurrentState();
	}, 5000);	
	
	
	$('#nav li').removeClass('active');
	if(document.URL.indexOf('Serie') > 0)
		$('#li-serie').addClass('active');
	else if(document.URL.indexOf('marketplace') > 0)
		$('#li-marketplace').addClass('active');
	else if(document.URL.indexOf('devices') > 0)
		$('#li-devices').addClass('active');
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
		});
	
	$('#popover-disp').click(function(){
		$('#popover-disp').popover('hide');
	});
	
    $('#MenuLogo').click(function(){    	
	  window.location = <?php echo '"'. SiteController::createUrl('site/index') . '"'; ?>;    	
	  return false;
	});

    $('#newDisc').click(function(){
    	$.post("<?php echo SiteController::createUrl('AjaxCurrentDiscShowDetail'); ?>"
		).success(
			function(data){
				$('#myModal').html(data);
				$('#myModal').modal('show'); 
			});
    });
    
    $('#playlist').click(function(){
    	$.post("<?php echo SiteController::createUrl('AjaxPlaylistsShow'); ?>"
		).success(
			function(data){
				$('#myModal').html(data);
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
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">Pelicano</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav" id="nav">
            <li id="li-movie"><a href="index.php">Mis Peliculas</a></li>
          <li id="li-serie"><a href="#">Mis Series</a></li>
		  <li id="li-marketplace"><a href="<?php echo SiteController::createUrl('site/marketplace') ?>">Marketplace</a></li>
		  <li id="li-download"><a href="<?php echo SiteController::createUrl('site/downloads') ?>">Descargas</a></li>   
		  <li id="li-devices"><a href="<?php echo SiteController::createUrl('site/devices') ?>" id="popover-disp">Dispositivos <span id="devicesQty" style="display:none" class="badge"></span></a></li>
        </ul>
          <?php 
			 	$customer = Setting::getInstance()->getCustomer();
			 	$username = (User::getCurrentUser())?User::getCurrentUser()->username : ''; 
		?>
          <div id="loginInfo" class="pull-right"><?php echo $username; ?><br/><span class="points"><?php echo isset($customer)?$customer->current_points:'0' ?>  points</span></div>
          <!--  <div id="playlist" class="pull-right"><i class="icon-bookmark"></i>Playlist</div>-->
          <div id="newDisc" class="pull-right">Examinar Disco</div>          
        </div><!-- /.navbar-collapse -->
      </nav>
<?php if (isset($this->showFilter) && $this->showFilter): ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="menuSecond">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div  id="filtros" class="collapse navbar-collapse navbar-ex5-collapse">
<ul id="filtroGenero" class="nav navbar-nav clearfix">
        <li class="active menuItem generoTodas"><a href="#" data-filter="*">Todas</a></li>
      <li class="menuItem generoComedia"><a href="#" data-filter=".comedy">Comedia</a></li>
      <li class="menuItem generoDrama"><a href="#" data-filter=".drama">Drama</a></li>
      <li class="menuItem generoRomance"><a href="#" data-filter=".romance">Romance</a></li>
      <li class="menuItem generoAdultos"><a href="#" data-filter=".fantasy">Fantasia</a></li>
     <li class="dropdown" id="filtroGeneroMob">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="selectedGenero"><span class="selected">Todos los G&eacute;neros</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu" id="filtroGenero">
                          <li><a href="#" data-sel="generoTodas" data-filter="*">Todos los G&eacute;neros</a></li>
                          <li><a href="#" data-sel="generoComedia" data-filter=".comedy">Comedia</a></li>
                          <li><a href="#" data-sel="generoDrama" data-filter=".drama">Drama</a></li>
                          <li><a href="#" data-sel="generoRomance" data-filter=".romance">Romance</a></li>
                          <li><a href="#" data-sel="generoAdultos" data-filter=".fantasy">Fantasia</a></li>
                        </ul>
                      </li>
      </ul>
     <form class="navbar-form navbar-right" role="search">
      <div class="form-group">
        <input type="search" id="search-query-filter" class="form-control" placeholder="Buscar Pel&iacute;culas">
      </div>
    </form>
        </div><!-- /.navbar-collapse -->
      </nav>

<?php endif; ?>

	<?php echo $content; ?>        
    
<div id="myModalEditName" class="modal fade in">
</div>    
<div id="myModalEditarAsoc" class="modal fade in">
</div>	
<div id="myModalCambiarBackdrop" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModalCambiarAfiche" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModalDiscIn" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModalESExplorer" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<?php
 
/*
echo CHtml::openTag('div',array('id'=>'myModal'));
//place holder
echo CHtml::closeTag('div'); 
*/?>

<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalDiscIn')); 

// echo CHtml::openTag('div',array('id'=>'view-disc-in'));
// echo CHtml::closeTag('div'); 

// $this->endWidget(); ?>
<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalESExplorer')); 

// echo CHtml::openTag('div',array('id'=>'view-es-explorer'));

// echo CHtml::closeTag('div'); 

// $this->endWidget(); 
?>
<!-- floating DIV para Peliculas en Reproduccion -->
<div id="playback" class="peliReroduciendo">
<div class="rep">
Reproduciendo:
<div id="playback-title" class="tituloRep"></div>
</div>
 <a type="button" id="btn-dune-control" class="btn btn-default"><i class="fa fa-keyboard-o"></i> Control Remoto</a>
</div>
<!-- /cierre floating -->
</body>
</html>
