 <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
      <h3 id="myModalLabel"><?php echo $model->original_title;?></h3>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 pagination-centered">
    <img class="aficheDetail" src="images/<?php echo $model->poster;?>" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
    
    <div class="col-md-9">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Cap&iacute;tulos</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Informaci&oacute;n</a></li>
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                <div class="tab-pane active" id="tab1">
                  <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>T&iacute;tulo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Anthony</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Mark</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Jacob</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Anthony</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Mark</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Jacob</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Anthony</td>
                  <td><button class="btn btn-primary btn-medium"><span class="iconFontButton iconPlay">{</span> Ver Cap&iacute;tulo</button></td>
                </tr>
              </tbody>
            </table>         
    </div><!--/.tab-pane --> 
    <div class="tab-pane" id="tab2">
                   
                
                  <div class="row detailMainGroup">
    <div class="col-md-4 pagination-centered detailMain detailMainFirst">
    <?php echo $model->genre;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 pagination-centered detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 pagination-centered detailMain">
     <?php    	
    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">    
    </div><!--/.col-md-4 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 pagination-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.col-md-3 -->
    <div class="col-md-9 pagination-left detailSecond">
    <?php echo $model->production_year;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 pagination-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 pagination-left detailSecond">
    Julianne Moore
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 pagination-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 pagination-left detailSecond">
    Julianne Moore / Martin Ciappesoni / Delfina Rossi / Manuel Montiel / Diane Keaton / Ricardo Darin
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 pagination-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.col-md-3 -->
    <div class="col-md-9 pagination-left detailSecond">
    <?php echo $model->running_time;?>mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 pagination-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 pagination-left detailSecond">
   	<?php echo $model->description;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->       
                </div><!--/.tab-pane --> 
    </div><!--/.tab-content --> 
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
 </div><!--/.modal-body -->
    <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cerrar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->