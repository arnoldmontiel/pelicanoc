 <!--  <div id="myModalDiscIn" class="modal modalDetail">-->   
   <div id="myModalDiscIn" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
    	<h3 id="myModalLabel">Nuevo disco</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row-fluid">
		    <div class="span3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.span3PRINCIPAL -->
	    </div><!--/.rowPRINCIPAL -->
    </div>
    
	<div class="span9">
    
	    <div class="row-fluid detailMainGroup">
	    	<div class="span4 pagination-centered detailMain detailMainFirst">
	    		<button id="btn-play" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Reproducir</button>
	    	</div><!--/.span4 -->
	    	<div class="span4 pagination-centered detailMain">
				<button id="btn-play-ripp" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Rippear</button>    		
	    	</div><!--/.span4 -->
	    	<div class="span4 pagination-centered detailMain">
				<button id="btn-cancel" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Cancelar</button>    		
	    	</div><!--/.span4 -->
	    </div><!--/.row -->
	    
	    <div class="row-fluid detailSecondGroup">
		    
	    </div><!--/.row -->
    
    </div><!--/.span9PRINCIPAL -->
    
    <div class="modal-footer">
    </div>
  </div>
  <script>
	$('#btn-play').click(function(){
		    
		return false;
	});
  </script>
