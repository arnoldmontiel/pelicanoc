<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.icon-large.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- isotope -->
<link href="css/isotope.css" rel="stylesheet" media="screen">
<!--<link href="css/pelicano.css" rel="stylesheet" media="screen">
-->


	<?php include('estilos.php');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>


<script type="text/javascript">	
function getCurrentDisc()
{
	$.post("<?php echo SiteController::createUrl('AjaxGetCurrentDisc'); ?>"
		).success(
		function(data){
			var image = $('#loginInfo').css('background-image');			
			if(data == 0)
				$('#loginInfo').css('background-image','url("img/userIcon.png")');
			else{
				if(image.indexOf('userIcon.png')>0)
				{
					$('#loginInfo').css('background-image','url("img/userIconIN.png")');
					$.post("<?php echo SiteController::createUrl('AjaxDiscIn'); ?>"
					).success(
						function(data){		
							$('#myModalDiscIn').html(data);
							$('#myModalDiscIn').modal('show'); 
						});
				}
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
	/*
	setInterval(function() {
		getCurrentDisc();
	}, 5000);
	*/
	
	$('#nav li').removeClass('active');
	if(document.URL.indexOf('Serie') > 0)
		$('#li-serie').addClass('active');
	else if(document.URL.indexOf('marketplace') > 0)
		$('#li-marketplace').addClass('active');
	else if(document.URL.indexOf('download') > 0)
		$('#li-download').addClass('active');
	else 
		$('#li-movie').addClass('active');
	$("#main-search").keyup(function(e){
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
  	});
  	
    

});
   
    
</script>
</head>

<input id="media-type-filter" type="hidden" name="media-type-filter" value="*">
<input id="current-filter" type="hidden" name="current-filter" value="*">
<input id="search-filter" type="hidden" name="search-filter" value="">
<body id="screenControl">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">Pelicano</a>
          </div>
          <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
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
		<?php if (isset($this->showFilter) && $this->showFilter): ?>
        <form class="navbar-search pull-right">
          <input type="text" id="main-search" class="search-query" placeholder="Buscar...">
        </form>
        <?php endif; ?>
		</div><!-- /.navbar-collapse -->
      </nav>
<?php if (isset($this->showFilter) && $this->showFilter): ?>
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
        <button id="btn-dune-control" class="btn">Control</button>
      </div>
      <!-- /btn group -->
    </div>
    <!-- /span6 -->
  </div>
  <!-- /row -->     
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
 </div>
	<?php echo $content; ?>        

<div id="myModalDiscIn" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModalESExplorer" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="myModalExternalStorage" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>
<div id="modalBookmark" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
</div>

<?php //  
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalExternalStorage')); 

// echo CHtml::openTag('div',array('id'=>'view-external-storage'));
// echo $this->renderPartial('../site/_externalStorage');
// echo CHtml::closeTag('div'); 

// $this->endWidget(); ?>
<?php //  
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalDiscIn')); 

// echo CHtml::openTag('div',array('id'=>'view-disc-in'));
// echo CHtml::closeTag('div'); 

// $this->endWidget(); ?>
</body>
</html>
