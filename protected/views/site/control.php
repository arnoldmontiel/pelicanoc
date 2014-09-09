
<div class="container" id="screenControl">
<div class="controlContainer">
  <div class="row rowControlVariable">
    <div class="col-sm-4 col-nexus-4">
    <div class="controlAfiche">
    <?php 
    echo CHtml::link(
    				
    				CHtml::image($big_poster,'',array(
    								"class"=>"aficheImg",
    								)),
    				
    				'',array("class"=>"aficheClickControl","idMovie"=>$model->Id,
    								"idResource"=>$idResource,
    								"sourceType"=>$sourceType,"onclick"=>"showDetails(this)"));
	?>
<!--  <img class="aficheImg" src="<?php echo $big_poster?>" border="0">-->    	
</div>   
</div>
    <!-- /col-sm-4 -->
    <div class="col-sm-8 col-nexus-8">
      <div class="row">
    <div class="col-sm-12">
    <div class="controlTitle"><?php echo $model->original_title?> </div>
     <!-- DROPDOWN PARA CAMBIAR ARCHIVO Q ESTOY MIRANDO -->
     <?php     
     if($sourceType==1):
     ?>
     <?php
     $setting = Setting::getInstance();
     $isMovieTester = $setting->is_movie_tester;
      
     $nzb = Nzb::model()->findByPk($idResource);
     
     if($isMovieTester)
     	$selectedDescription = str_replace(".mkv","",$nzb->mkv_file_name);
     else
     	$selectedDescription = $nzb->nzbType->description;
      
     if(isset($nzb->Id_nzb))
     {
     	$nzb = $nzb->nzb;     	
     }
     $nzbs=$nzb->nzbs;
     if(!empty($nzbs)):?>
     <div class="chooseFile">
     <div class="dropdown">
		<a id="drop" role="button" data-toggle="dropdown" href="#">
		<span id="selectedDescription">
			<?php
				echo $selectedDescription; 
			?>
			</span>
		<i class="fa fa-caret-down"></i>
		</a>
        <ul id="menu1" class="dropdown-menu controlDropdown scrollable-dropdown" role="menu" aria-labelledby="drop">     
		<li><a href="javascript:play(this,<?php echo $nzb->Id?>,<?php echo $player->Id ?>)">		
			<?php 
			if($isMovieTester)
				echo str_replace(".mkv","",$nzb->mkv_file_name);
			else
				echo $nzb->nzbType->description;
			?>
		</a></li>        	
		<li role="presentation" class="divider"></li>	
     <?php foreach ($nzbs as $nzbItem) {?>
		<li><a onclick="play(this,<?php echo $nzbItem->Id?>,<?php echo $player->Id ?>)">
			<?php
				if($isMovieTester)
					echo str_replace(".mkv","",$nzbItem->mkv_file_name);
				else
					echo $nzbItem->nzbType->description;
			?>
		</a></li>        	
		<li role="presentation" class="divider"></li>	
     <?php }?>
		</ul>
	</div>
	<span id="waiting-switch" class="controlTitleLoading hidden"><i class="fa fa-spinner fa-spin"></i></span>
	</div>
	<?php endif?>
    <?php endif?>
    </div>
    <!-- /col-sm-8 -->
 </div><!-- /row interna -->
      <div class="row ">
    <div class="col-sm-5" style="text-align:left;">
<!-- <div class="btn-group">
 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    archivopelicula grande.mkv 80GB <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Pel&iacute;cula</a></li>
    <li class="divider"></li>
    <li><a href="#">Extras</a></li>
    <li class="divider"></li>
    <li><a href="#">Comentarios de Actores</a></li>
  </ul>
</div> -->
    <div class="controlAudioSub">
<button type="button" class="btn btn-lg btn-primary" id="subtButton">Cambiar Subt&iacute;tulos</button>
<button type="button" class="btn btn-lg btn-primary noMargin" id="audioButton">Cambiar Audio</button>
</div>
<?php if($sourceType > 10):?>
<div class="controlBookmark">
<button type="button" class="btn btn-large btn-primary" id="bookmarkButton"><i class="fa fa-bookmark fa-2x"></i></button>
</div>
<?php endif;?>
    </div>
    <!-- /col-sm-5 -->
    <div class="col-sm-7">
    <div class="controlFlechas pull-right">
    <div class="flechasArriba">
<button type="button" class="btn btn-lg btn-alternate" id="upButton"><i class="fa fa-chevron-up fa-2x"></i></button>
</div>
    <div class="flechasCentro">
<button type="button" class="btn btn-lg btn-alternate" id="leftButton"><i class="fa fa-chevron-left fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-alternate" id="enterButton"><i class="fa fa-check fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-alternate" id="rightButton"><i class="fa fa-chevron-right fa-2x"></i></button>
</div>
    <div class="flechasAbajo">
<button type="button" class="btn btn-lg btn-alternate" id="downButton"><i class="fa fa-chevron-down fa-2x"></i></button>
</div>
</div>
    </div>
    <!-- /col-sm-7 -->
 </div>
  <!-- /row interna -->
    </div>
    <!-- /col-sm-9 -->
  </div>
  <!-- /row -->
  
  <div class="row controlBackground rowControlVariable">
    <div class="col-md-7 col-sm-12">
    <div class="controlNavegacion">
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="prevButton"><i class="fa fa-step-backward fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="rewButton"><i class="fa fa-backward fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="pauseButton"><i class="fa fa-pause fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="playButton"><i class="fa fa-play fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="stopButton"><i class="fa fa-stop fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="fwButton"><i class="fa fa-forward fa-2x"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="nextButton"><i class="fa fa-step-forward fa-2x"></i></button>
</div>
    </div>
    <!-- /col-sm-6 -->
    <div class="col-md-5 col-sm-12">
    <div class="row">
    <div class="col-sm-7">
    <div class="controlProgress">
    <div class="progress">
        <div class="progress-bar" id="progressBar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
    </div>
    </div>
    </div>
    <!-- /col-sm-7 -->
    <div class="col-sm-5">
    <div class="controlLenght">
    <span id="currentTime"></span> / 
    <span id="totalTime"></span>
    </div>
    </div>
    <!-- /col-sm-5 -->
    </div>
    <!-- /row interna -->
    </div>
    <!-- /col-sm-6 -->
    </div>
  <!-- /row -->
    <div class="row rowControlVariable">
    <div class="col-md-9 col-sm-8">
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
    <!-- /col-sm-9 -->
    <div class="col-md-3 col-sm-4">   
    <div class="controlConfig">
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="popUpMenuButton"><i class="fa fa-cog fa-lg"></i></button>
<button type="button" class="btn btn-lg btn-primary btn-inverse" id="returnButton"><i class="fa fa-reply fa-lg"></i></button>
</div>
    </div>
    <!-- /col-sm-3 -->
    </div>  <!-- /row -->
  </div><!-- /controlContainer -->
</div><!-- /container -->
  <input type="hidden" name="hidden-end-value" id="hidden-end-value">
  	
<?php //  
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'modalBookmark')); 
// echo CHtml::openTag('div',array('id'=>'view-bookmarks'));
// //place holder
// echo CHtml::closeTag('div');
// $this->endWidget(); ?>
 <?php
if(isset($player->type) && $player->type == 1)
{
	$script="
$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'PLA',Id_player:".$player->Id."},
});
		return false;
});
$('#pauseButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'PAU',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#stopButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxStop') . "',
     	data: {Id_player:".$player->Id."}
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
		data: {ir_code:'PRE',Id_player:".$player->Id."},
});
     			return false;
});
	
$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NXT',Id_player:".$player->Id."},
});
     			return false;
});
	
$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'REV',Id_player:".$player->Id."},
});
				return false;
});
	
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'FWD',Id_player:".$player->Id."},
});
        		return false;
});
	
$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'SEL',Id_player:".$player->Id."},
});
				return false;
});
	
$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'RET',Id_player:".$player->Id."},
});
				return false;
});
	
$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'MNU',Id_player:".$player->Id."},
});
							return false;
});
	
$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NUP',Id_player:".$player->Id."},
});
     		return false;
});
	
$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NDN',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NLT',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NRT',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#subtButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'SUB',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#audioButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'AUD',Id_player:".$player->Id."},
});
		return false;
});
	
$('#button0').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU0',Id_player:".$player->Id."},
});
    		return false;
});
$('#button1').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU1',Id_player:".$player->Id."},
});
		return false;
});
$('#button2').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU2',Id_player:".$player->Id."},
});
		return false;
});
$('#button3').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU3',Id_player:".$player->Id."},
});
		return false;
});
$('#button4').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU4',Id_player:".$player->Id."},
});
		return false;
});
$('#button5').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU5',Id_player:".$player->Id."},
});
    		return false;
});
$('#button6').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU6',Id_player:".$player->Id."},
});
    		return false;
});
$('#button7').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU7',Id_player:".$player->Id."},
});
		return false;
});
$('#button8').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU8',Id_player:".$player->Id."},
});
		return false;
});
$('#button9').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'NU9',Id_player:".$player->Id."},
});
		return false;
});
";
}
elseif(isset($player->type) && $player->type == 0)
{
	$script="
$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'B748BF00',Id_player:".$player->Id."},
});
});
$('#pauseButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'B748BF00',Id_player:".$player->Id."},
});
});
	
$('#stopButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxStop') . "',
		data: {Id_player:".$player->Id."}
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
		data: {ir_code:'B649BF00',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E21DBF00',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E31CBF00',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E41BBF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'EB14BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'FB04BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F807BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'EA15BF00',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E916BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E817BF00',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'E718BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#subtButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'AB54BF00',Id_player:".$player->Id."},
});
		return false;
});
	
$('#audioButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'BB44BF00',Id_player:".$player->Id."},
});
			return false;
});
	
$('#button0').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F50ABF00',Id_player:".$player->Id."},
});
			return false;
});
$('#button1').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F40BBF00',Id_player:".$player->Id."},
});
				return false;
});
$('#button2').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F30CBF00',Id_player:".$player->Id."},
});
   				return false;
});
$('#button3').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F20DBF00',Id_player:".$player->Id."},
});
   				return false;
});
$('#button4').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F10EBF00',Id_player:".$player->Id."},
});
   				return false;
});
$('#button5').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'F00FBF00',Id_player:".$player->Id."},
});
	return false;
});
$('#button6').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'FE01BF00',Id_player:".$player->Id."},
});
	return false;
});
$('#button7').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'EE11BF00',Id_player:".$player->Id."},
});
	return false;
});
$('#button8').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: {ir_code:'ED12BF00',Id_player:".$player->Id."},
 	});
	return false;
});
$('#button9').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'EC13BF00',Id_player:".$player->Id."},
 	});
   				return false;
});
";	
}	
else 
{
	$script="
$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: {ir_code:'CMD_MELE_PLAYPAUSE',Id_player:".$player->Id."},
 	});
	return false;
});
$('#pauseButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: {ir_code:'CMD_MELE_PLAYPAUSE',Id_player:".$player->Id."},
 	});
	return false;
});
$('#stopButton').click(function(){		
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxStop') . "',
		data: {Id_player:".$player->Id."}
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
   		data: {ir_code:'CMD_PREV',Id_player:".$player->Id."},
 	});
	return false;
});
	
$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_NEXT',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_FFWD',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_FRWD',Id_player:".$player->Id."},
});
		return false;
});
	
$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_SELECT',Id_player:".$player->Id."},
});
		return false;
});
	
$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_RETURN',Id_player:".$player->Id."},
});
		return false;
});
	
$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_MENU',Id_player:".$player->Id."},
});
		return false;
});
	
$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_UP',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_DOWN',Id_player:".$player->Id."},
});
		return false;
});
	
$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_LEFT',Id_player:".$player->Id."},
});
    		return false;
});
	
$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_RIGHT',Id_player:".$player->Id."},
});
		return false;
});
	
$('#subtButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_STITLE',Id_player:".$player->Id."},
});
		return false;
});
	
$('#audioButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_AUDIO',Id_player:".$player->Id."},
});
			return false;
});
	
$('#button0').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_ZERO',Id_player:".$player->Id."},
});
			return false;
});
$('#button1').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_ONE',Id_player:".$player->Id."},
});
				return false;
});
$('#button2').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_TWO',Id_player:".$player->Id."},
});
   				return false;
});
$('#button3').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_THREE',Id_player:".$player->Id."},
});
   				return false;
});
$('#button4').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_FOUR',Id_player:".$player->Id."},
});
   				return false;
});
$('#button5').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_FIVE',Id_player:".$player->Id."},
});
	return false;
});
$('#button6').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_SIX',Id_player:".$player->Id."},
});
	return false;
});
$('#button7').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_SEVEN',Id_player:".$player->Id."},
});
	return false;
});
$('#button8').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: {ir_code:'CMD_EIGHT',Id_player:".$player->Id."},
 	});
	return false;
});
$('#button9').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
		data: {ir_code:'CMD_NINE',Id_player:".$player->Id."},
 	});
   				return false;
});
";
}			

$firstPart =
"//ChangeBG('','".$backdrop."');
	
setInterval(function() {
	//checkEndScene();
	getProgressBar();
}, 1000);	

function getProgressBar()
{
 	$.post('".SiteController::createUrl('AjaxGetProgressBar')."',
		{idPlayer:".$player->Id."}).success(
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
";
Yii::app()->clientScript->registerScript(__CLASS__.'#startMovie',$firstPart . $script);
?>
<script type="text/javascript">
function showDetails(object)
{
	var sourceType = $(object).attr("sourceType");
	var id = $(object).attr("idMovie");
	var idResource = $(object).attr("idResource");		
	var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource; 
	$.ajax({
   		type: 'POST',
   		url: '<?php echo SiteController::createUrl('AjaxMovieShowControlDetail') ?>',
   		data: param,
 	}).success(function(data)
 	{
 	
		$('#myModal').html(data);	
   		$('#myModal').modal({
				show: true
		});		
	}
 	);
   	return false;	
}

function play(object,idNzb,idPlayer)
{
	$('#waiting-switch').removeClass('hidden');
	$.ajax({
		type: 'POST',
	   	url: '<?php echo SiteController::createUrl('AjaxPlayNzbByPlayer')?> ',
		data: {idNzb:idNzb,idPlayer:idPlayer}
	}).success(
		function(data){
			$("#selectedDescription").html($(object).html());
			$('#waiting-switch').addClass('hidden');	 	
		}
	);
}

</script>

	
	
	