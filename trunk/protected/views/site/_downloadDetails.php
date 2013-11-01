 <!--  <div id="myModal" class="modal modalDetail">-->   
   <!--     <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">-->
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel"><?php echo $model->original_title;?></h3>
    </div>
    <div class="modal-body"> 
    <div class="row-fluid">
    <div class="span3 pagination-centered">
    <img class="aficheDetail" src="images/<?php echo $model->big_poster;?>" width="100%" height="100%" border="0">
    </div><!--/.span3PRINCIPAL -->
    
    <div class="span9">
    
    <div class="row-fluid detailMainGroup">
    <div class="span4 pagination-centered detailMain detailMainFirst">
    <?php echo $model->genre;?>
    </div><!--/.span4 -->
    <div class="span4 pagination-centered detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.span4 -->
    <div class="span4 pagination-centered detailMain">
    <?php    	
    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.span4 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $model->production_year;?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $casting['director'];?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $casting['actors'];?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $model->running_time;?>mm
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
   <?php echo $model->description;?>
    </div><!--/.span9 -->
    </div><!--/.row -->
    
    </div><!--/.span9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div>
    <div class="modal-footer">    
    </div>
   <!--    </div>-->
 
