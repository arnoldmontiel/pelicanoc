 <!--  <div id="myModal" class="modal modalDetail">-->   
   <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel">Playlists</h3>
    </div>
    <div class="modal-body"> 
    <div class="row-fluid">
    <div class="span3 pagination-centered">
    <span class="span4">
  		<div class="tabs-left">
	    <ul class="nav nav-tabs">
	    <?php
	    $isFirst = true; 
	    foreach ($models as $playlist)
	    {?>
	    
	    	<li<?php echo $isFirst?" class='active'":"";?>><a href="#"><?php echo $playlist->description;?></a></li>
	    <?php $isFirst=false;}?>    
		</ul>
	    </div><!--/.span3PRINCIPAL -->
	</span>
    </div><!--/.span3PRINCIPAL -->
