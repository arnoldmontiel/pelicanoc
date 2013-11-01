
<div class="container" id="mainControl">
<div class="controlContainer">
  <div class="row">
    <div class="col-md-4">
    <div class="controlAfiche">
<img class="aficheImg" src="<?php echo "images/".$big_poster?>" border="0"> 
</div>   
</div>
    <!-- /col-md-3 -->
    <div class="col-md-8">
      <div class="row">
    <div class="col-md-12">
    <div class="controlTitle"><?php echo $model->original_title?></div>
    </div>
    <!-- /col-md-8 -->
 </div>
  <!-- /row interna -->
      <div class="row">
    <div class="col-md-5">
    <div class="controlAudioSub">
<button type="button" class="btn btn-large btn-primary" id="subtButton">Cambiar Subt&iacute;tulos</button>
<button type="button" class="btn btn-large btn-primary noMargin" id="audioButton">Cambiar Audio</button>
</div>
<?php if($sourceType > 10):?>
<div class="controlBookmark">
<button type="button" class="btn btn-large btn-primary" id="bookmarkButton"><i class="fa fa-bookmark fa-2x"></i></button>
</div>
<?php endif;?>
    </div>
    <!-- /col-md-5 -->
    <div class="col-md-7">
    <div class="controlFlechas pull-right">
    <div class="flechasArriba">
<button type="button" class="btn btn-large btn-primary btn-warning" id="upButton"><i class="fa fa-chevron-up fa-2x"></i></button>
</div>
    <div class="flechasCentro">
<button type="button" class="btn btn-large btn-primary btn-warning" id="leftButton"><i class="fa fa-chevron-left fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-warning" id="enterButton"><i class="fa fa-check fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-warning" id="rightButton"><i class="fa fa-chevron-right fa-2x"></i></button>
</div>
    <div class="flechasAbajo">
<button type="button" class="btn btn-large btn-primary btn-warning" id="downButton"><i class="fa fa-chevron-down fa-2x"></i></button>
</div>
</div>
    </div>
    <!-- /col-md-7 -->
 </div>
  <!-- /row interna -->
    </div>
    <!-- /col-md-9 -->
  </div>
  <!-- /row -->
  
  <div class="row controlBackground">
    <div class="col-md-6">
    <div class="controlNavegacion">
<button type="button" class="btn btn-large btn-primary btn-inverse" id="prevButton"><i class="fa fa-step-backward fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="rewButton"><i class="fa fa-backward fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="playButton"><i class="fa fa-play fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="stopButton"><i class="fa fa-stop fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="fwButton"><i class="fa fa-forward fa-2x"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="nextButton"><i class="fa fa-step-forward fa-2x"></i></button>
</div>
    </div>
    <!-- /col-md-6 -->
    <div class=col-md-6>
    <div class="row">
    <div class="col-md-7">
    <div class="controlProgress">
    <div class="progress">
        <div class="progress-bar" id="progressBar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
    </div>
    </div>
    </div>
    <!-- /col-md-7 -->
    <div class="col-md-5">
    <div class="controlLenght">
    <span id="currentTime"></span> / 
    <span id="totalTime"></span>
    </div>
    </div>
    <!-- /col-md-5 -->
    </div>
    <!-- /row interna -->
    </div>
    <!-- /col-md-6 -->
    </div>
  <!-- /row -->
    <div class="row">
    <div class="col-md-9">
        <div class="controlNumeros">
<button type="button" class="btn btn-default" id="button0">0</button>
<button type="button" class="btn btn-default" id="button1">1</button>
<button type="button" class="btn btn-default" id="button2">2</button>
<button type="button" class="btn btn-default" id="button3">3</button>
<button type="button" class="btn btn-default" id="button4">4</button>
<button type="button" class="btn btn-default" id="button5">5</button>
<button type="button" class="btn btn-default" id="button6">6</button>
<button type="button" class="btn btn-default" id="button7">7</button>
<button type="button" class="btn btn-default" id="button8">8</button>
<button type="button" class="btn btn-default" id="button9">9</button>
</div>
    </div>
    <!-- /col-md-9 -->
    <div class="col-md-3">   
    <div class="controlConfig">
<button type="button" class="btn btn-large btn-primary btn-inverse" id="popUpMenuButton"><i class="fa fa-cog fa-lg"></i></button>
<button type="button" class="btn btn-large btn-primary btn-inverse" id="returnButton"><i class="fa fa-reply fa-lg"></i></button>
</div>
    </div>
    <!-- /col-md-3 -->
    </div>
    </div>  <!-- /row -->
  </div><!-- /controlContainer -->
</div><!-- /container -->
  <input type="hidden" name="hidden-end-value" id="hidden-end-value">
  	
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'modalBookmark')); 
echo CHtml::openTag('div',array('id'=>'view-bookmarks'));
//place holder
echo CHtml::closeTag('div');
$this->endWidget(); ?>
 <?php
Yii::app()->clientScript->registerScript(__CLASS__.'#startMovie', "
	
	ChangeBG('images/','".$backdrop."');
	
setInterval(function() {
	//checkEndScene();
	getProgressBar();
}, 1000);	

function getProgressBar()
{
 	
 	$.post('".RippedMovieController::createUrl('AjaxGetProgressBar')."'	
		).success(
		function(data){	
			var obj = jQuery.parseJSON(data);
			if(obj != null && obj.currentProgress >= 0)
			{			
				$('#progressBar').width(obj.currentProgress+'%');
				$('#currentTime').html(obj.currentTime); 
				$('#totalTime').html(obj.totalTime);
			}
		});		
}

function checkEndScene()
{
	var endValue = $('#hidden-end-value').val();
	if(endValue != '')
	{
		$.ajax({
			type: 'POST',
		   	url: '". SiteController::createUrl('AjaxGetDunePosition') . "'
		}).success(
			function(data){	 	
				if(endValue <= data)
				{
					$.ajax({
						type: 'POST',
					   	url: '". SiteController::createUrl('AjaxPauseDune') . "'
					}).success(
						function(data){	 	
							$('#hidden-end-value').val('');	
					});					
				}
		});
	}		
}

$('#bookmarkButton').click(function(){
	var id = '".$idResource."';
	var sourceType = '".$sourceType."';	
	var param = 'id='+id+'&sourceType='+sourceType; 
	$.ajax({
		type: 'POST',
	   	url: '". SiteController::createUrl('AjaxShowBookmark') . "',
	   	data: param,
	}).success(
		function(data){	 	
			$('#view-bookmarks').html(data);
			$('#modalBookmark').modal('show');			
	});
});
		
	
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
	
	
	