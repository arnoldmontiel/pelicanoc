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
<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Isotope -->
<link href="css/isotope.css" rel="stylesheet" media="screen">
<!-- Flexslider -->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css"
	media="screen" />
<!-- Modernizr -->
<script src="js/modernizr.js"></script>
<!-- Image Picker -->
<link href="css/image-picker.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/image-picker.min.js"></script>
<!-- JS Select -->
<link href="js/select2-3.4.4/select2.css" rel="stylesheet" />
<script src="js/select2-3.4.4/select2.js"></script>
<script src="js/lite-uploader-master/jquery.liteuploader.js"></script>
<!-- Circular progress bar -->
<script src="js/jquery.knob.js"></script>
<!-- jPushMenu -->
<script src="js/jPushMenuDelfi.js"></script>
<link href="css/jPushMenu.css" rel="stylesheet" />
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<script>
$(function() {
    FastClick.attach(document.body);
});
// funcion super importante para que no scrollee el fondo en ipad:
//$(document)
//.on('show.bs.modal',  '.modal', function () { $("#content").addClass('modal-open') })
//.on('hidden.bs.modal', '.modal', function () { $("div").removeClass('modal-open') })

</script>

	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php include('estilos.php');?>

	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>


<script>
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
					$('#player-status-quantity').html(obj.playBack.count);
				}
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
    				if(obj.currentUSB.is_in == 0)
    				{
        				if($('#wizardDispositivos').length > 0)
        				{
    						$('#wizardDispositivos').html('');
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
	$("#player-status").click(
		function()
		{
	    	$.post("<?php echo SiteController::createUrl('AjaxShowPlayerStatus'); ?>"
	    	).success(
	    		function(data){
	        		if(data != null)
	        		{
		        		$("#myModalReproduciendo").html(data);
		        		$("#myModalReproduciendo").modal("show");        			
	        		}
	    		},"json");
			return false;
		
		}
	);
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
	}, 10000);	
	
	
	$('#pushMain .mobileMenuItem').removeClass('active');
	$('#nav li').removeClass('active');
	if(document.URL.indexOf('indexserie') > 0) {
		$('#li-serie').addClass('active');
		$('#mobile-serie').addClass('active');
	}
	else if(document.URL.indexOf('marketplace') > 0) {
		$('#li-marketplace').addClass('active');
	    $('#mobile-marketplace').addClass('active');
	}
	else if(document.URL.toUpperCase().indexOf('DEVICES') > 0) {
		$('#li-devices').addClass('active');
        $('#mobile-devices').addClass('active');
	}	
	else if(document.URL.indexOf('download') > 0) {
		$('#li-download').addClass('active');
        $('#mobile-download').addClass('active');
	}
    	else {
		$('#li-movie').addClass('active');
        $('#mobile-movie').addClass('active');
	}
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

<input id="media-type-filter" type="hidden" name="media-type-filter"
	value="*">
<input id="current-filter" type="hidden" name="current-filter" value="*">
<input id="search-filter" type="hidden" name="search-filter" value="">
<body class="cbp-spmenu-push">
<!-- /////////MENU LATERAL MAIN///////// -->
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushMain">
		<div class="cbp-title">Menu</div>
		<a class="toggle-menu close-menu"> <i class="fa fa-times-circle"></i></a>
		<a id="mobile-movie" class="mobileMenuItem" href="index.php">Mis Peliculas</a> 
<!-- Comentado para Pelicano Lite #####
		<a id="mobile-serie" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/indexserie') ?>">Mis Series</a> 
-->
		<a id="mobile-marketplace" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/marketplace') ?>">Marketplace</a>
		<a id="mobile-download" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/downloads') ?>">Descargando</a>
		<a id="mobile-devices" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/devices') ?>"
			id="popover-disp">Dispositivos <span id="devicesQty"
			style="display: none" class="badge"></span></a>
	</nav>
<!-- /////////////////////////////////////// -->
<!-- /////////MENU LATERAL GENEROS///////// -->
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushGenero">
		<div class="cbp-title">Filtrar por G&eacute;nero</div>
		<div class="pushMenuSuperGroup">
		<div class="pushMenuGroup">
		<a class="pushMenuActive" href="#" data-filter="*">Todos</a>
		<a href="#" data-filter=".comedy">Comedia</a>
		<a href="#" data-filter=".romance">Romance</a>
		<a href="#" data-filter=".fantasy">Fantas&iacute;a</a>
		</div>
		</div>
	</nav>
<!-- /////////////////////////////////////// -->
<!-- /////////MENU LATERAL FILTROS MARKETPLACE///////// -->
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushMarketplace">
		<div class="cbp-title">Filtrar B&uacute;squeda</div>
		<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
		<div class="pushMenuSuperGroup">
		<div class="pushMenuGroup">
		<a class="pushMenuActive" href="#">Estrenos</a>
		<a href="#">Populares</a>
		<a href="#">Recomendadas</a>
		</div>
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">G&Eacute;NERO</div>
		<a href="#">Comedia</a>
		<a href="#">Drama</a>
		<a href="#">Romance</a>
		<a href="#">Thriller</a>
		</div>
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">A&Ntilde;O</div>
		<a href="#">2013</a>
		<a href="#">2012</a>
		<a href="#">2010</a>
		</div>
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">IDIOMA</div>
		<a href="#">Todos</a>
		<a href="#">Arabe</a>
		<a href="#">Espa&ntilde;ol</a>
		<a href="#">Arabe</a>
		</div>
		</div>
	</nav>
<!-- /////////////////////////////////////// -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"
		id="Menu">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand hidden-md" href="#" id="MenuLogo">pelicano</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="nav navbar-nav navbar-left hidden-sm hidden-xs">
				<ul class="nav navbar-nav hidden-sm" id="nav">
					<li id="li-movie"><a href="index.php">Mis Peliculas</a></li>
					<!-- Comentado para Pelicano Lite #####	
					<li id="li-serie"><a href="<?php echo SiteController::createUrl('site/indexserie') ?>">Mis Series</a></li> 
					-->
					<li id="li-marketplace"><a
						href="<?php echo SiteController::createUrl('site/marketplace') ?>">Marketplace</a></li>
					<li id="li-download"><a
						href="<?php echo SiteController::createUrl('site/downloads') ?>">Descargando</a></li>
					<!-- Comentado para Pelicano Lite ##### 
					<li id="li-devices"><a
						href="<?php echo SiteController::createUrl('site/devices') ?>"
						id="popover-disp">Dispositivos <span id="devicesQty"
							style="display: none" class="badge"></span></a></li> 
					-->
				</ul>
          <?php
										$customer = Setting::getInstance ()->getCustomer ();
										$username = (User::getCurrentUser ()) ? User::getCurrentUser ()->username : '';
										?>
				</div>
			<!-- /.navbar menu -->
			<!-- 
          <div id="loginInfo" class="pull-right"><?php // echo $username; ?><br/><span class="points"><?php // echo isset($customer)?$customer->current_points:'0' ?>  points</span></div>
          <div id="newDisc" class="pull-right">Examinar Disco</div>          
        </div> -->
			<div class="nav navbar-nav navbar-right hidden-sm hidden-xs">
				<ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> admin <i
							class="fa fa-caret-down fa-fw"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user fa-fw"></i> Ver Perfil</a></li>
							<li><a href="#"><i class="fa fa-tachometer fa-fw"></i> Ver
									Consumos</a></li>
							<li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
						</ul></li>
				</ul>
			</div>
			<!-- /.navbar admin -->
			<div class="nav navbar-nav navbar-left visible-sm visible-xs">
				<button class="toggle-menu menu-left btn btn-default navbar-btn"
					id="toggleMain">
					<i class="fa fa-reorder fa-fw"></i>
				</button>
			</div>
			<p class="navbar-text visible-sm visible-xs" id="mobilePageName">
			<?php 
				if($this->action->Id=="index")
				{
					echo "Mis Peliculas";					
				}
				elseif($this->action->Id=="indexserie")
				{
					echo "Mis Series";					
				}
				elseif($this->action->Id=="marketplace")
				{
					echo "Marketplace";
				}
				elseif($this->action->Id=="downloads")
				{
					echo "Descargando";
				}
				elseif($this->action->Id=="devices")
				{
					echo "Dispositivos";
				}
				?>
			
			</p>
			<!-- /.navbarBotonCollapse -->
			<div class="nav navbar-nav navbar-right">
				<button id="player-status" type="button"
					class="btn btn-default navbar-btn btnReproduciendo"
					data-toggle="modal">
					Reproduciendo <span id="player-status-quantity" class="badge">0</span><i class="fa fa-caret-down fa-fw"></i>				</button>
			</div>
			<!-- /.navbarRproduciendo -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<!-- /.navbar-collapse -->
		
<?php if (isset($this->showFilter) && $this->showFilter): ?>
 

 <nav class="navbar navbar-default navbar-fixed-top" role="navigation"
		id="menuSecond">
		<div class="container-fluid">
			<div class="nav navbar-nav navbar-left">
		<ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Todas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Comedia</a></li>
					<li class="generoItem"><a href="#" data-filter=".drama">Drama</a></li>
					<li class="generoItem"><a href="#" data-filter=".romance">Romance</a></li>
					<li class="generoItem"><a href="#" data-filter=".fantasy">Fantasia</a></li>
				</ul>
				<button
					class="toggle-menu menu-left btn btn-default navbar-btn visible-xs visible-sm"
					id="toggleGenero">
					<i class="fa fa-filter fa-fw"></i> Genero
				</button>
			</div>
			<form class="navbar-form navbar-right" role="search">
				<div class="searchMain form-group">
					<input id="main-search" type="text"
						class="form-control form-search"
						placeholder=" Buscar Pel&iacute;cula">
				</div>
			</form>
		</div>
	</nav>
	 
	<!-- <div class="secondNavFixedTop clearfix">
<h2 class="sliderTitle pull-left">Pel&iacute;culas</h2> 			
			<div class="pull-left">
		<ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Todas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Comedia</a></li>
					<li class="generoItem"><a href="#" data-filter=".drama">Drama</a></li>
					<li class="generoItem"><a href="#" data-filter=".romance">Romance</a></li>
					<li class="generoItem"><a href="#" data-filter=".fantasy">Fantasia</a></li>
				</ul>
				<button
					class="toggle-menu menu-left btn btn-default navbar-btn visible-xs visible-sm"
					id="toggleGenero">
					<i class="fa fa-filter fa-fw"></i> Genero
				</button>
			</div>
			<div class="searchMain pull-right">
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input id="main-search" type="text"
						class="form-control form-search"
						placeholder=" Buscar Pel&iacute;cula">
				</div>
			</form>
			</div>
</div>
	 -->
<?php endif; ?>
<!-- <div class="wrapper"> -->

	<?php echo $content; ?>        
   <!-- </div>
	 end wrapper -->
	<div id="myModalEditName" class="modal fade in"></div>
	<div id="myModalEditarAsoc" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalCambiarBackdrop" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalCambiarAfiche" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModal" class="modal fade in" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalDiscIn" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalESExplorer" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>

	<div id="myModalReproduciendo" class="modal fade in"
		style="display: hidden;" aria-hidden="false">
		
		<!-- /.modal-dialog -->
	</div>

	<div id="myModalElegirPlayer" class="modal fade in"	style="display: hidden;" aria-hidden="false">
		<!-- /.modal-dialog -->
	</div>
<?php

/*
 * echo CHtml::openTag('div',array('id'=>'myModal')); //place holder echo CHtml::closeTag('div');
 */
?>

<?php
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalDiscIn'));

// echo CHtml::openTag('div',array('id'=>'view-disc-in'));
// echo CHtml::closeTag('div');

// $this->endWidget();?>
<?php
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalESExplorer'));

// echo CHtml::openTag('div',array('id'=>'view-es-explorer'));

// echo CHtml::closeTag('div');

// $this->endWidget();
?>


	<!--call jPushMenu, required-->
	<script>
jQuery(document).ready(function($) {
	
	$('#toggleMain.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushMain'});

	$('#toggleGenero.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushGenero'});

	$('#toggleMarketplace.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushMarketplace'});

	$( "#pushMarketplace .pushMenuSuperGroup a" ).click(function() {
		  $( this ).toggleClass( "pushMenuActive" );
		  return false;
		  		});

	//-------------FILTROS GENERO, PILLS Y PUSHMENU --------------
	
	$( "#pushGenero .pushMenuSuperGroup a" ).click(function() {
		 $(this).addClass('pushMenuActive').siblings().removeClass('pushMenuActive');
		  //Para marcar mas de uno:
		  //$( this ).toggleClass( "pushMenuActive" );
		  var selector = $(this).attr("data-filter");

		  //Desmarco todo el menu comun
		  $("#filtroGenero li").removeClass('active');
		  //Marco el item correspondiente en menu comun
		  $("#filtroGenero li a[data-filter='" + selector + "']").parent('li').addClass('active');
		  //Cerrar menu			
		  $('.jPushMenuBtn,body,.cbp-spmenu').removeClass('disabled active cbp-spmenu-open cbp-spmenu-push-toleft cbp-spmenu-push-toright');
		  $(".modal-backdrop").remove();
		   
		  $('#media-type-filter').val(selector);
		  $('#current-filter').val(selector);
		  
		  //clean search filter
		  $('#search-filter').val(null);
		  $('#index_search').val(null);

		  $('#wall .items').infinitescroll('retrieve');  
		  $('#wall .items').isotope({ filter: selector });
		  return false;
		  		});

	$('#filtroGenero li a').click(function(){
		  var selector = $(this).attr("data-filter");

		  $('#filtroGenero li.active').removeClass('active')
		  $(this).parent('li').addClass('active');
		  //CORREGIR
		  //$("#selectedGenero .selected").text($(this).text());

		  //Desmarco todo el menuMobile
		  $("#pushGenero .pushMenuSuperGroup a").removeClass('pushMenuActive');
		  //Marco el item correspondiente en menu mobile
		  $("#pushGenero .pushMenuSuperGroup a[data-filter='" + selector + "']").addClass('pushMenuActive');
			   
		  $('#media-type-filter').val(selector);
		  $('#current-filter').val(selector);
		  
		  //clean search filter
		  $('#search-filter').val(null);
		  $('#index_search').val(null);

		  $('#wall .items').infinitescroll('retrieve');  
		  $('#wall .items').isotope({ filter: selector });
		  return false;
		});

	//----------------------------- END--------------------------
	
});
</script>
</body>
</html>
