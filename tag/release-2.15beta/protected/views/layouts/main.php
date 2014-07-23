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
<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
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

<!-- Isotope -->
<script src="js/isotope/dist/imagesloaded.pkgd.min.js"></script>
<script src="js/isotope/dist/isotope.pkgd.min.js"></script>
<?php 
$theme="light-theme.css";
if(isset(User::getCurrentUser()->theme))
	$theme=User::getCurrentUser()->theme->file_name;
?>
<!-- Theme -->
<link href="css/<?php echo $theme;?>" rel="stylesheet" />



	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php include('estilos.php');?>

	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>


<script>
function getIsAlive()
{
	$.post("<?php echo SiteController::createUrl('AjaxIsAlive'); ?>"
	).success(
		function(data){			
		}).error(function(){
			window.location = 'http://<?php echo $_SERVER['HTTP_HOST']?>';
		});
	return false;
	
}
function getCurrentState()
{
	$.post("<?php echo SiteController::createUrl('AjaxGetCurrentState'); ?>"
	).success(
		function(data){

			setTimeout(		
	 			'getCurrentState()'
	 		, 10000);	
				
    		if(data != null)
    		{        			
    			var obj = jQuery.parseJSON(data);
    			if(obj.systemStatus != null)
    			{
        			var error = 0;
    				if(obj.systemStatus.error_players == 1)
        			{
    					error=1;
    					$('#error_player').show();
        			}
        			else
        			{
        				$('#error_player').hide();
        			}
    				if(obj.systemStatus.error_NAS == 1)
        			{
    					error=1;
    					$('#error_NAS').show();
        			}
    				else
        			{
        				$('#error_NAS').hide();
        			}
    				if(obj.systemStatus.error_NAS_space == 1)
        			{
    					error=1;
    					$('#error_NAS_space').show();
        			}
    				else
        			{
        				$('#error_NAS_space').hide();
        			}
        			if(error==1)
        			{
        				$('#has_errors').css('visibility', 'visible');
        			}
        			else
        			{
        				$('#has_errors').css('visibility', 'hidden');
        			}
				}    				    				
    			if(obj.downloading != null)
    			{
    				if(obj.downloading.qty >= 1)
        			{
    					$('.downloadingQty').html(obj.downloading.qty);
        			}
        			else
        			{
        				$('.downloadingQty').html("");
        			}
				}    				    				
    			if(obj.playBack != null)
    			{    				    				
					$('#player-status-quantity').html(obj.playBack.count);

					if(obj.playBack.count == 0)
					{
						$("#player-status").removeClass('reproduciendoOn');
						$("#player-status").addClass('reproduciendoOff');
						$("#player-status-text").text(' No hay reproducciones ');
						$('#player-status-quantity').hide();
						$('#player-status-arrow').hide();
					}
					else
					{
						$("#player-status").removeClass('reproduciendoOff');
						$("#player-status").addClass('reproduciendoOn');
						$("#player-status-text").text(' Reproduciendo ');
						$('#player-status-quantity').show();
						$('#player-status-arrow').show();
					}
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
		},"json").error(function(){
			setTimeout(		
		 			'getCurrentState()'
		 		, 10000);	
			setTimeout(		
		 			'getIsAlive()'
		 		, 15000);	
			});	
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
	<?php 
		if(isset($this->currentStatus)&&$this->currentStatus==true)
			echo "getCurrentState();"
	?>
	
	$.ajaxSetup({
	    cache: false,
	    headers: {
	        'Cache-Control': 'no-cache'
	    }
	});

	
// 	setInterval(function() {		
// 		getCurrentState();
// 	}, 10000);	
	
	
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
	

	$('#dropdown-more li a').click(function(){
		if($(this).attr('onclick')!=null)	return true;
		window.location = $(this).attr('href');
		return false;
	});

	$('#market a').click(function(){
		window.location = $(this).attr('href');
		return false;
	});
	$('#nav a').click(function(){
		window.location = $(this).attr('href');
		return false;
	});
	$('#pushMain a').click(function(){
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
<script type="application/javascript">
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);
    </script>
<?php include 'menu.php';?>


	<?php echo $content; ?>        

	
	<div id="myModalVelocidad" class="modal fade in" aria-hidden="false">
	<div class="modal-dialog">
				<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	        <h4 class="modal-title">Editar Velocida de Descarga</h4>
	      </div>
	      <div class="modal-body">
	
	  <div class="form-group">
	  <label class="required">Velocidad (en KB/s) <span class="required">*</span></label>    <input id ="setSpeedLimit" class="form-control"  type="text" value="">  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="button" onclick="saveSpeedlimit(this)" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
	      </div>
	    </div>
				<!-- /.modal-content -->
			</div>
			
	</div>
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
	<div id="myModalConfigPassword" class="modal fade in" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
		style="display: hidden;"></div>
	<div id="myModalReproduciendo" class="modal fade in"
		style="display: hidden;" aria-hidden="false">
		
		<!-- /.modal-dialog -->
	</div>

	<div id="myModalElegirPlayer" class="modal fade in"	style="display: hidden;" aria-hidden="false">
		<!-- /.modal-dialog -->
	</div>
	
	
	<div id="myModalAlerta" class="modal fade in"  aria-hidden="false"><div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">Alerta</h4>
				</div>
				<div class="modal-body">
				<div class="alert alert-danger noMargin">
        <h4><i class="fa fa-warning"></i>  La pel&iacute;cula no se encuentra disponible</h4>
       Esto puede deberse a que la pelicula haya sido borrada o movida de lugar.</br></br>
Por favor, contacte al administrador.
      </div>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
</div>

	<div id="myModalError" class="modal fade in" aria-hidden="false"><div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">Error</h4>
				</div>
				<div class="modal-body">
				<div class="alert alert-danger noMargin">
        <h4><i class="fa fa-warning"></i> Lo sentimos, se ha producido un error. </h4>
        Vuelva a intentarlo. <br/>
        Mientras tanto un informe ha sido enviado al sistema para su an&aacute;lisis.
      </div>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
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


</body>
</html>
