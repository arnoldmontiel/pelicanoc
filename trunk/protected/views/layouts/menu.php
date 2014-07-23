<!-- /////////MENU LATERAL MAIN///////// -->
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushMain">
<div class="cbp-title">Menu</div>
<a class="toggle-menu close-menu"> <i class="fa fa-times-circle"></i></a>
<a id="mobile-movie" class="mobileMenuItem" href="index.php">Mis Peliculas</a>
<!-- Comentado para Pelicano Lite #####
<a id="mobile-serie" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/indexserie') ?>">Mis Series</a>
-->
<a id="mobile-marketplace" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/marketplaceCategory') ?>">Marketplace</a>
<a id="mobile-download" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/downloads') ?>">Descargando
<span id="downloadingQty"
			class="badge downloadingQty"></span></a>
			<!-- Comentado para Pelicano Lite #####
			<a id="mobile-devices" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/devices') ?>"
			id="popover-disp">Dispositivos <span id="devicesQty"
			style="display: none" class="badge"></span></a>
			-->
</nav>
<!-- /////////////////////////////////////// -->
<?php if (isset($this->showFilter) && $this->showFilter): ?>
	<?php  if(true||$this->action->Id=="index"):?>
		<!-- /////////MENU LATERAL MIS PELICULAS///////// -->
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left pushSelectable" id="<?php echo($this->action->Id=="index")?'pushMisPeliculas':'pushMarketplace'?>">
			<div class="cbp-title">Filtrar</div>
			<div class="sideMenuBotones">
				<button class="btn btn-default btnLimpiar"><i class="fa fa-undo"></i> Limpiar Todo</button>
				<button class="btn btn-primary btnAplicar"><i class="fa fa-check"></i> Aplicar</button>
			</div>
			<a class="toggle-menuMisPeliculas close-menu"><i class="fa fa-times-circle"></i></a>
			<div class="pushMenuSuperGroup">
				<div class="pushMenuGroup" data-filter-group="header">
					<a class="pushMenuRadio pushMenuActive pushTodas" href="#" data-filter="*">Todas</a>
					<a class="pushMenuRadio pushNuevas" href="#" data-filter="flr-isnew">Sin Ver</a>
				</div>
				<div class="pushMenuGroup"  data-filter-group="genre">
					<div class="pushMenuGroupTitle">G&Eacute;NERO <button class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Limpiar</button></div>
					<?php 
						if($this->action->Id=="index")
							echo PelicanoHelper::getLeftFilter('genre');
						else
							echo PelicanoHelper::getLeftFilter('genre','marketplace');
					?>
				</div>
				<div class="pushMenuGroup"  data-filter-group="year">
					<div class="pushMenuGroupTitle">A&Ntilde;O <button class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Limpiar</button></div>
					<?php
						if($this->action->Id=="index") 
							echo PelicanoHelper::getLeftFilter('year');
						else
							echo PelicanoHelper::getLeftFilter('year','marketplace');
						?>
				</div>
			</div>
		</nav>
		<!-- /////////////////////////////////////// -->
	<?php  else:?>
		<!-- /////////MENU LATERAL FILTROS MARKETPLACE///////// -->
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left pushSelectable" id="pushMarketplace">
			<div class="cbp-title">Filtrar Marketplace</div>
			<div class="sideMenuBotones">
				<button class="btn btn-default btnLimpiar"><i class="fa fa-undo"></i> Limpiar Todo</button>
				<button class="btn btn-primary btnAplicar"><i class="fa fa-check"></i> Aplicar</button>
			</div>
			<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
			<div class="pushMenuSuperGroup">
				<div class="pushMenuGroup" data-filter-group="all">
					<a class="pushMenuRadio pushMenuActive pushTodas" href="#">Todas</a>					
				</div>
				<div class="pushMenuGroup"  data-filter-group="genre">
					<div class="pushMenuGroupTitle">G&Eacute;NERO <button class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Limpiar</button></div>
					<?php echo PelicanoHelper::getLeftFilter('genre','marketplace');?>
				</div>
				<div class="pushMenuGroup"  data-filter-group="year">
					<div class="pushMenuGroupTitle">A&Ntilde;O <button class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Limpiar</button></div>
					<?php echo PelicanoHelper::getLeftFilter('year','marketplace');?>
				</div>
			</div>
		</nav>
		<!-- /////////////////////////////////////// -->
	<?php  endif;?>
<?php  endif;?>
<?php if (isset($this->showMenu) && $this->showMenu): ?>
			<!-- /////////MENU PRINCIPAL///////// -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="Menu">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		<!-- <a class="navbar-brand visible-md visible-sm" href="#" id="MenuLogoMobile"></a>-->
		<a class="navbar-brand" href="#" id="MenuLogo"><img class="smallMenuIcon" src="./icons/smallIcon.png"> <span class="menuText  hidden-md hidden-sm hidden-nexus">pelicano</span></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="nav navbar-nav navbar-left  hidden-xs hidden-nexus-p">
				<ul class="nav navbar-nav " id="nav">
						<li id="li-movie"><a href="index.php">Mis Peliculas</a></li>
						<!-- Comentado para Pelicano Lite #####
						<li id="li-serie"><a href="<?php echo SiteController::createUrl('site/indexserie') ?>">Mis Series</a></li>
						-->
						<li id="li-marketplace"><a
						href="<?php echo SiteController::createUrl('site/marketplaceCategory') ?>">Marketplace</a></li>
						<li id="li-download"><a
						href="<?php echo SiteController::createUrl('site/downloads') ?>">Descargando
						<span id="downloadingQty"
							class="badge downloadingQty"></span></a></li>
							<!-- Comentado para Pelicano Lite #####
							<li id="li-devices"><a
							href="<?php echo SiteController::createUrl('site/devices') ?>"
									id="popover-disp">Dispositivos <span id="devicesQty"
											style="display: none" class="badge"></span></a></li>
											-->
											</ul>											
				</div>
			<!-- /.navbar menu -->
			<!-- 
          <div id="loginInfo" class="pull-right"><?php // echo $username; ?><br/><span class="points"><?php // echo isset($customer)?$customer->current_points:'0' ?>  points</span></div>
          <div id="newDisc" class="pull-right">Examinar Disco</div>          
        </div> -->
			<div class="nav navbar-nav navbar-right repUser hidden-xs">
				<ul class="nav navbar-nav pull-right hidden-xs">
					<li class="dropdown dropdownUsuario" ><a href="#" class="dropdown-toggle "
						data-toggle="dropdown">
							<i class="fa fa-user fa-fw"></i> 
							<span class="hidden-sm hidden-nexus-p visible-inline">
							<?php 
								$currentUser = User::getCurrentUser();
								$username = ($currentUser) ? $currentUser->username : '';
								echo $username;
							?> 
							</span>
							<i class="fa fa-caret-down fa-fw"></i></a>
						<ul id="dropdown-more" class="dropdown-menu">
							<!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> Ver Perfil</a></li>
							<li><a href="#"><i class="fa fa-tachometer fa-fw"></i> Ver
									Consumos</a></li> -->
									<li class="visible-sm visible-nexus-p hidden-nexus-l"><div class="insideUsername"><i class="fa fa-user fa-fw"></i><?php echo $username; ?></div></li>
							<li><a onclick="goToConfig();"><i class="fa fa-cogs fa-fw"></i> Config</a></li>
							<li><a href="<?php echo SiteController::createUrl('site/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
							<?php 
 								$modelThemes = Theme::model()->findAllByAttributes(array('hide'=>0));
 								if(isset($currentUser))
 								{
	 								foreach($modelThemes as $theme)
	 								{
	 									if($currentUser->Id_theme == $theme->Id)
	 										echo '<li class="menuTheme"><a onclick="changeTheme('.$theme->Id.');" class="menuThemeOption menuThemeOptionActive">'.$theme->description.'</a></li>';
	 									else 
	 										echo '<li><a onclick="changeTheme('.$theme->Id.');" class="menuThemeOption">'.$theme->description.'</a></li>';
	 								
	 								}
 								}
							?> 
						</ul></li>
				</ul>
				<button id="player-status" type="button" class="btn btn-reproduciendo reproduciendoOff navbar-btn pull-right"
					data-toggle="modal"><i class="fa fa-desktop fa-fw"></i>
					<span id="player-status-text"> No hay reproducciones </span><span id="player-status-quantity" class="badge"></span><i id="player-status-arrow" style="display: none;" class="fa fa-caret-down fa-fw"></i> 
				 <!-- 	No hay reproducciones -->
					</button>
			<div class="dropdown pull-right" id="has_errors" style="visibility:hidden;"><button class="btn btn-danger  btnAlarm navbar-btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning"></i> <i class="fa fa-caret-down"></i></button>
  			<div class="dropdown-menu dropdownAlert">
    			Se han detectado los siguientes errores:
  		  		<ul class="list-group">
  					<li id="error_NAS_space" class="list-group-item list-group-item-warning"><i class="fa fa-exclamation-circle"></i> El disco esta por llenarse</li>
  					<li id="error_player" class="list-group-item list-group-item-danger"><i class="fa fa-ban"></i> Hay players apagados o fuera de servicio</li>
  					<li id="error_NAS" class="list-group-item list-group-item-danger"><i class="fa fa-ban"></i> El servidor no responde</li>
				</ul>
    			Un reporte fue enviado, si tiene dudas contacte al administrador.
  				</div>
			</div>
			</div>
			<!-- /.navbar admin -->
			<div class="nav navbar-nav navbar-left  visible-xs visible-inline">
				<button class="toggle-menu menu-left btn btn-default navbar-btn"
					id="toggleMain">
					<i class="fa fa-reorder fa-fw"></i>
				</button>
			</div>
			<p class="navbar-text  visible-xs visible-inline" id="mobilePageName">
			<?php 
				$toggleId = 'toggleMisPeliculas';
				if($this->action->Id=="index")
				{
					echo "Mis Peliculas";					
				}
				elseif($this->action->Id=="indexserie")
				{
					echo "Mis Series";					
				}
				elseif($this->action->Id=="marketplace"||$this->action->Id=="marketplaceCategory")
				{
					$toggleId = 'toggleMarketplace';
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
		</div>
		<!-- /.container-fluid -->
	</nav>
	<!-- /.navbar-collapse -->
<?php  endif;?>
<?php if (isset($this->showFilter) && $this->showFilter): ?>
 
 
<!-- /////////MENU SECUNDARIO///////// -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuSecond">
		<div class="container-fluid">
	
	<?php  if($this->action->Id=="marketplace"):?>
	<div class="nav navbar-nav navbar-left">
		<div class="btn-group">
		    <button type="button" class="btn btn-primary dropdown-toggle navbar-btn marketAlternateBtn" data-toggle="dropdown">
      			Todas las Peliculas
      			<span class="caret"></span>
    		</button>
    		<ul class="dropdown-menu" role="menu">
      			<li id="market">
      				<a href="<?php echo SiteController::createUrl('site/marketplaceCategory') ?>">Por categorias</a>
      			</li>
    		</ul>
  		</div>
	</div>
  <?php elseif($this->action->Id=="marketplaceCategory"):?>
	<div class="nav navbar-nav navbar-left">
		<div class="btn-group">
		    <button type="button" class="btn btn-primary dropdown-toggle navbar-btn marketAlternateBtn" data-toggle="dropdown">
      			Por categorias
      			<span class="caret"></span>
    		</button>
    		<ul class="dropdown-menu" role="menu">
      			<li id="market">
      				<a href="<?php echo SiteController::createUrl('site/marketplace') ?>">Todas las Peliculas</a>
      			</li>
    		</ul>
  		</div>
	</div>
  <?php endif?>
  
  <?php if($this->action->Id!="marketplaceCategory"):?>	
  <div class="nav navbar-nav navbar-left hidden">
		    <!-- Comentado para Pelicano Lite #####
		    	<ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Pel&iacute;culas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Series</a></li>
				</ul>
				 -->
			</div>
			<div class="nav navbar-nav navbar-left">
				<button class="toggle-menu menu-left btn btn-primary navbar-btn jPushMenuBtn" id="<?php echo $toggleId;?>">
					<i class="fa fa-filter fa-fw"></i> Filtro
				</button>
				</div>
				


		<form class="navbar-form navbar-right" role="search">
				<div class="searchMain form-group" data-filter-group="title">
					<input id="main-search" type="text" class="form-control form-search" placeholder=" Buscar Pel&iacute;cula">
				</div>
			</form>
			
			<div id="filter-summary" class="filterDesc">Sin filtro</div>
  
  <?php endif?>
		</div><!-- /container-fluid -->
	</nav>
<?php endif; ?>


<script>
//-------------FILTROS MENU LATERAL --------------
			
jQuery(document).ready(function($) {
	
	$('#toggleMain.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushMain'});

	$('#toggleMisPeliculas.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushMisPeliculas'});

	$('#toggleMarketplace.toggle-menu').jPushMenu({
		closeOnClickOutside:false,
		menu: '#pushMarketplace'});
	
});
</script>
<script type="text/javascript">

//store filters
var filters = [];
filters['header'] = [];
filters['year'] = [];
filters['genre'] = [];
filters['title'] = [];

function updateFilterSummary()
{
	var summary = '';	

	if(filters['genre'].length > 0)
	{
		summary = summary + 'G&eacute;nero:';
		for(var index = 0; index < filters['genre'].length; index++)
		{
			if(index != 0)
				summary = summary + ', ' + filters['genre'][index].value;
			else
				summary = summary + ' ' + filters['genre'][index].value;
		}
	}

	if(filters['year'].length > 0)
	{
		summary = summary + ' A&ntilde;o:';
		for(var index = 0; index < filters['year'].length; index++)
		{
			if(index != 0)
				summary = summary + ', ' + filters['year'][index].value;
			else
				summary = summary + ' ' + filters['year'][index].value;
		}
	}

	if(summary.length == 0)
		summary = 'Todas las Peliculas';
	
	$("#filter-summary").html(summary);	
}

function setMenuFilters(obj)
{
	var $this = $(obj);
	var key = $this.parent().attr('data-filter-group');
	if(key != 'header')
	{
		if($this.hasClass('pushMenuActive'))
			filters[key].push({key:$this.attr('data-filter'),value:$this.text()});
		else
		{			
			for (var index in filters[key])
			{
				if(filters[key][index].key == $this.attr('data-filter'))
				{
					filters[key].splice( index, 1 );
					break;
				}
			}			
		}
	}
	else
	{
		filters[key] = [];
		filters[key].push({key:$this.attr('data-filter'),value:$this.text()});				
	}
}

function setTextFilter(obj)
{
	var $this = $(obj);
    var key = $this.parent().attr('data-filter-group');
    
    filters[key] = [];

    if($this.val().length > 0)
    {
    	var newkey = $this.val().toLowerCase().trim().replace(/ /gi,'-');    	
    	filters[key].push({key:newkey,value:$this.val()});
    }
}

function clearFilterByKey(obj)
{
	var $this = $(obj);
	var key = $this.parent().attr('data-filter-group');
	filters[key] = [];
	$this.parent().find('.pushMenuCheck').removeClass("pushMenuActive");
	$this.parent().find('.pushMenuCheck').removeClass("pushMenuClicked");
}

function clearFilters()
{
	for ( var prop in filters ) 
	{
		if(prop != 'header')
			filters[prop] = [];
	}
		
	$(".pushSelectable .pushMenuSuperGroup .pushMenuCheck ").removeClass("pushMenuActive");
	$(".pushSelectable .pushMenuSuperGroup .pushMenuCheck ").removeClass("pushMenuClicked");
	$('#main-search').val('');
}

$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	if($('*:focus').attr('id') == 'main-search')
    	{
    		$('#main-search').change();
    		$("#main-search").trigger('blur');
    		return false;
    	}    	
    	return false; 
    }
});

function goToConfig()
{
	$.post("<?php echo SiteController::createUrl('AjaxOpenGotoConfigDialog'); ?>"
		).success(
			function(data){
				$('#myModalConfigPassword').html(data);
		   		$('#myModalConfigPassword').modal('show');	  
			});
		return false;
	
}

function changeTheme(idTheme)
{
	$.post("<?php echo SiteController::createUrl('AjaxChangeTheme'); ?>",
			{
				idTheme:idTheme
			}
	).success(
		function(data){
			window.location.reload();  
		});
	return false;
}
</script>