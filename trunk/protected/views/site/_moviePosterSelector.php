     <div class="modal-dialog ">
        <div class="modal-content"> <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Cambiar Afiche</h4>
    </div>
    <div class="modal-body"> 
    <div class="modal-scroll">
    
        <div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
    <div>Sube tu imagen</div>
    <input type="file" id="selectedFile"  />
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
    o Elige una de la lista
    
       <select class="image-picker">
       <?php
       var_dump($posters); 
       foreach ($posters as $poster)
		{
        	echo "<option data-img-src='".$poster->file_path."' value='".$poster->file_path."'></option>";
		}
       ?>
      </select>
  </label>
</div>
      </div>
    </div><!--/.modal-body -->
    <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cancelar</button>
    <button id="btn-play" type="button" class="btn btn-primary btn-large"> Aceptar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
      <script type="text/javascript">

    jQuery("select.image-picker").imagepicker({
      hide_select:  true,
    });


  </script>