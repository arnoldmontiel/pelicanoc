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
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="1"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="2"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="3"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="4"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="5"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="6"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="7"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="8"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="9"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="10"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="11"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="12"></option>
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