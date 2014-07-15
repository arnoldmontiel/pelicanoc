 <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
      <h3 id="myModalLabel">Playlists</h3>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 pagination-centered">
    <span class="col-md-4">
  		<div class="tabs-left">
	    <ul class="nav nav-tabs">
	    <?php
	    $isFirst = true; 
	    foreach ($models as $playlist)
	    {?>
	    
	    	<li<?php echo $isFirst?" class='active'":"";?>><a href="#"><?php echo $playlist->description;?></a></li>
	    <?php $isFirst=false;}?>    
		</ul>
		<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;  min-height: 300px;  ">
		<div class="tab-pane active" id="tab1">
		</div>
		</div>
	    </div><!--/.col-md-3PRINCIPAL -->
	</span>
    </div><!--/.col-md-3PRINCIPAL -->
    
    </div><!--/.row -->    
    </div><!--/.modal-body -->
       <div class="modal-footer">
    	<button id="btn-eject" class="btn btn-primary btn-large"><i class="fa fa-eject fa-lg"></i></button>
         </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
