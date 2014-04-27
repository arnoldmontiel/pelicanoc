<!-- /////////MENU LATERAL MAIN///////// -->
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushMain">
<div class="cbp-title">Menu</div>
<a class="toggle-menu close-menu"> <i class="fa fa-times-circle"></i></a>
<a id="mobile-movie" class="mobileMenuItem" href="index.php">Mis Peliculas</a>
<!-- Comentado para Pelicano Lite #####
<a id="mobile-serie" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/indexserie') ?>">Mis Series</a>
-->
<a id="mobile-marketplace" class="mobileMenuItem" href="<?php echo SiteController::createUrl('site/marketplace') ?>">Marketplace</a>
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


			<!-- /////////MENU LATERAL MIS PELICULAS///////// -->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left pushSelectable" id="pushMisPeliculas">
			<div class="cbp-title">Filtrar Mis Peliculas</div>
			<div class="sideMenuBotones"><button class="btn btn-default btnLimpiar"><i class="fa fa-undo"></i> Limpiar</button><button class="btn btn-primary btnLimpiar"><i class="fa fa-check"></i> Aplicar</button></div>
			<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
			<div class="pushMenuSuperGroup">
			<div class="pushMenuGroup">
			<a class="pushMenuRadio pushMenuActive pushTodas" href="#" data-filter="*">Todas</a>
			<a class="pushMenuRadio pushNuevas" href="#">Sin Ver</a>
			</div>
			<div class="pushMenuGroup">
			<a href="#" data-filter=".comedy">Comedia</a>
			<a href="#" data-filter=".romance">Romance</a>
			<a href="#" data-filter=".fantasy">Fantas&iacute;a</a>
			</div>
			<div class="pushMenuGroup">
			<div class="pushMenuGroupTitle">A&Ntilde;O</div>
			<a href="#">2013</a>
			<a href="#">2012</a>
			<a href="#">2010</a>
			</div>
			</div>
			</nav>
			<!-- /////////////////////////////////////// -->
			
			<!-- /////////MENU LATERAL FILTROS MARKETPLACE///////// -->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left pushSelectable" id="pushMarketplace">
			<div class="cbp-title">Filtrar B&uacute;squeda</div>
			<div class="sideMenuBotones"><button class="btn btn-default btnLimpiar"><i class="fa fa-undo"></i> Limpiar</button><button class="btn btn-primary btnLimpiar"><i class="fa fa-check"></i> Aplicar</button></div>
			<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
			<div class="pushMenuSuperGroup">
			<div class="pushMenuGroup">
			<a class="pushMenuRadio pushMenuActive pushTodas" href="#">Todas</a>
			<a class="pushMenuRadio pushNuevas" href="#">Nuevas</a>
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
			</div>
			</nav>
			<!-- /////////////////////////////////////// -->
			
			
			<!-- /////////MENU PRINCIPAL///////// -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="Menu">
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
				<button id="player-status" type="button" class="btn btn-default navbar-btn btnReproduciendo btnNoRep"
					data-toggle="modal"><i class="fa fa-desktop fa-fw"></i>
					<span id="player-status-text"> No hay reproducciones </span><span id="player-status-quantity" class="badge"></span><i id="player-status-arrow" style="display: none;" class="fa fa-caret-down fa-fw"></i> 
				 <!-- 	No hay reproducciones -->
					</button>
			</div>
			<!-- /.navbarRproduciendo -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<!-- /.navbar-collapse -->
		
<?php if (isset($this->showFilter) && $this->showFilter): ?>
 
 
<!-- /////////MENU SECUNDARIO///////// -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuSecond">
		<div class="container-fluid">
			<div class="nav navbar-nav navbar-left">
		    <!-- Comentado para Pelicano Lite #####
		    	<ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Pel&iacute;culas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Series</a></li>
				</ul>
				 -->
			</div>
			<div class="nav navbar-nav navbar-left">
				<button class="toggle-menu menu-left btn btn-primary navbar-btn jPushMenuBtn" id="toggleMisPeliculas">
					<i class="fa fa-filter fa-fw"></i> Filtro
				</button>
			</div>
				<div class="filterDesc pull-left">Todas las Peliculas</div>
			<form class="navbar-form navbar-right" role="search">
				<div class="searchMain form-group">
					<input id="main-search" type="text" class="form-control form-search" placeholder=" Buscar Pel&iacute;cula">
				</div>
			</form>
		</div>
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

	$( ".pushSelectable .pushMenuSuperGroup a" ).click(function() {
		  if ($(this).hasClass('pushMenuRadio')){
			  $('.pushSelectable .pushMenuSuperGroup a.pushMenuRadio').removeClass( "pushMenuActive" );
			  $(this).addClass( "pushMenuActive" );
		  }else{
			$( this ).toggleClass( "pushMenuActive" );
		  }
	});
	$( ".pushSelectable .btnLimpiar" ).click(function() {
		$(".pushSelectable .pushMenuSuperGroup a").removeClass("pushMenuActive");
		$(".pushSelectable .pushMenuSuperGroup a.pushMenuRadio.pushTodas").addClass("pushMenuActive");
	});

	
		
});
</script>