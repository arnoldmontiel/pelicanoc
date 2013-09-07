
<div class="container" >
<div class="controlContainer">
  <div class="row-fluid">
    <div class="span3">
    <div class="controlAfiche">
<img class="peliAfiche" src="<?php echo "images/".$model->big_poster?>" border="0"> 
</div>   
</div>
    <!-- /span3 -->
    <div class="span9">
      <div class="row-fluid">
    <div class="span12">
    <div class="controlTitle"><?php echo $model->original_title?></div>
    </div>
    <!-- /span12 -->
 </div>
  <!-- /row interna -->
      <div class="row-fluid">
    <div class="span6">
    <div class="controlAudioSub">
<button type="button" class="btn btn-large btn-primary"id="subtButton">Cambiar Subt&iacute;tulos</button>
<button type="button" class="btn btn-large btn-primary noMargin" id="audioButton">Cambiar Audio</button>
</div>
    </div>
    <!-- /span6 -->
    <div class="span6">
    <div class="controlFlechas">
    <div class="flechasArriba">
<button type="button" class="btn btn-large btn-primary btn-warning" id="upButton"><i class="icon-chevron-up icon-white icon-2x"></i></button>
</div>
    <div class="flechasCentro">
<button type="button" class="btn btn-large btn-primary btn-warning" id="leftButton"><i class="icon-chevron-left icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-warning" id="enterButton"><i class="icon-ok-sign icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-warning" id="rightButton"><i class="icon-chevron-right icon-white icon-2x"></i></button>
</div>
    <div class="flechasAbajo">
<button type="button" class="btn btn-large btn-primary btn-warning" id="downButton"><i class="icon-chevron-down icon-white icon-2x"></i></button>
</div>
</div>
    </div>
    <!-- /span6 -->
 </div>
  <!-- /row interna -->
    </div>
    <!-- /span9 -->
  </div>
  <!-- /row -->
  
  <div class="row-fluid controlBackground">
    <div class="span6">
    <div class="controlNavegacion">
<button type="button" class="btn btn-large btn-primary btn-inverse" id="prevButton"><i class="icon-step-backward icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="rewButton"><i class="icon-backward icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="playButton"><i class="icon-play icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="stopButton"><i class="icon-stop icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="fwButton"><i class="icon-forward icon-white icon-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="nextButton"><i class="icon-step-forward icon-white icon-2x"></i></button>
</div>
    </div>
    <!-- /span6 -->
    <div class="span6">
    <div class="row-fluid">
    <div class="span8">
    <div class="controlProgress">
    <div class="progress">
  <div class="bar" style="width: 60%;"></div>
</div>
    </div>
    </div>
    <!-- /span8 -->
    <div class="span4">
    <div class="controlLenght">
    10:20:10 / 03:20:14
    </div>
    </div>
    <!-- /span4 -->
    </div>
    <!-- /row interna -->
    </div>
    <!-- /span6 -->
    </div>
  <!-- /row -->
    <div class="row-fluid">
    <div class="span9">
        <div class="controlNumeros">
<button type="button" class="btn" id="button0">0</button>
<button type="button" class="btn" id="button1">1</button>
<button type="button" class="btn" id="button2">2</button>
<button type="button" class="btn" id="button3">3</button>
<button type="button" class="btn" id="button4">4</button>
<button type="button" class="btn" id="button5">5</button>
<button type="button" class="btn" id="button6">6</button>
<button type="button" class="btn" id="button7">7</button>
<button type="button" class="btn" id="button8">8</button>
<button type="button" class="btn" id="button9">9</button>
</div>
    </div>
    <!-- /span9 -->
    <div class="span3">   
    <div class="controlConfig">
<button type="button" class="btn btn-large btn-primary btn-inverse" id="popUpMenuButton"><i class="icon-cog icon-white icon-large"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="returnButton"><i class="icon-reply icon-white icon-large"></i></button>
</div>
    </div>
    <!-- /span3 -->
    </div>
    </div>
  <!-- /row -->
  </div>
  <?php
Yii::app()->clientScript->registerScript(__CLASS__.'#startMovie', "
	
	ChangeBG('images/','".$model->backdrop."');

$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B748BF00',
 	});
});

$('#stopButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxStop') . "'
 	}).success(function()
 	{
		window.location = '".SiteController::createUrl('index')."'
	}
 	);	
});

$('#prevButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B649BF00',
 	});
});

$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E21DBF00',
 	});
});

$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E31CBF00',
 	});
});
  
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E41BBF00',
 	});
});

$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EB14BF00',
 	});
});

$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=FB04BF00',
 	});
});

$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F807BF00',
 	});
});

$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EA15BF00',
 	});
});

$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E916BF00',
 	});
});

$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E817BF00',
 	});
});

$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E718BF00',
 	});
});

$('#subtButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=AB54BF00',
 	});
});

$('#audioButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BB44BF00',
 	});
});

$('#aButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BF40BF00',
 	});
});
$('#button0').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F50ABF00',
 	});
});
$('#button1').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F40BBF00',
 	});
});
$('#button2').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F30CBF00',
 	});
});
$('#button3').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F20DBF00',
 	});
});
$('#button4').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F10EBF00',
 	});
});
$('#button5').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F00FBF00',
 	});
});
$('#button6').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=FE01BF00',
 	});
});
$('#button7').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EE11BF00',
 	});
});
$('#button8').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=ED12BF00',
 	});
});
$('#button9').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EC13BF00',
 	});
});
		
");
?>
	
	
	