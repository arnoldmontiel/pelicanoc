<div class="container" id="screenDevices">
  <div class="row pageTitleContainer">
    <div class="col-md-12">
    <h1 class="pageTitle">Dispositivos Conectados</h1>
    </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
  <div class="row">
    <div class="col-md-3">
    <ul class="nav nav-pills nav-stacked" >
        <li class="active"><a href="#">USB1</a><a type="button" class="ejectBTN btn btn-default"><i class="fa fa-eject"></i></a></li>
        <li><a href="#">USB 2</a><a type="button" class="ejectBTN btn btn-default"><i class="fa fa-eject"></i></a></li>
        <li><a href="#">Bluray</a><a type="button" class="ejectBTN btn btn-default"><i class="fa fa-eject"></i></a></li>
      </ul>
    </div> <!-- /col-md-3 -->
    <!-- ACA EMPIEZA PASO 1
    <div class="col-md-9" id="wizardDispositivos">
        <h3>USB 1 (Kingston)</h2>
        Indique si alguno de estos archivos es un video personal, luego proceda a analizar el disco para encontrar las peliculas.       
        <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre de Archivo</th>
              <th>Ruta</th>
              <th>Es Video personal? <div class="checkbox">
  <label>
    <input type="checkbox" value=""> Marcar Todos
  </label>
</div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>monsterUniversityBRIP.avi</td>
              <td>D://movies/monsterUniversityBRIP.avi</td>
              <td><div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>monsterUniversityBRIP.avi</td>
              <td>D://movies/monsterUniversityBRIP.avi</td>
              <td><div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div></td>
            </tr>
            <tr>
              <td>3</td>
              <td>monsterUniversityBRIP.avi</td>
              <td>D://movies/monsterUniversityBRIP.avi</td>
              <td><div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div></td>
            </tr>
          </tbody>
        </table>
        <div class="buttonGroup"><button type="button" class="btn btn-primary">Analizar Disco</button></div>
      </div>
    </div> ACA TERMINA PASO 1--> <!-- /col-md-9 -->
    
    <!-- /ACA EMPIEZA PASO 2 -->
    <div class="col-md-9" id="wizardDispositivos">
        <h2>USB 1 (Kingston) <i class="fa fa-spinner fa-spin"></i> Analizando...</h2>
        Lista de videos detectados:       
        <div class="table-responsive">
        <h3>Peliculas</h3>
        <table class="table  tablaIndividual">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Editar</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th> <button type="button" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Monsters Inc (2005)</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-link"></i> Asociacion</button></td>
              <td>D://movies/monsterUniversityBRIP.avi</td>
              <td><i class="fa fa-warning"></i> El archivo ya existe en la biblioteca</td>
              <td><button type="button" class="btn btn-primary">Sobreescribir</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>American Pie (2005)</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-link"></i> Asociacion</button></td>
              <td>D://movies/camPie.avi</td>
              <td><i class="fa fa-smile-o"></i> Disponible</td>
              <td><button type="button" class="btn btn-primary">Importar</button></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Monsters University (2013)</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-link"></i> Asociacion</button></td>
              <td>D://movies/monsterUniversityBRIP.avi</td>
              <td><i class="fa fa-spinner fa-spin"></i> Importando...</td>
              <td><button type="button" class="btn btn-danger">Cancelar</button></td>
            </tr>
            <tr>
              <td>4</td>
              <td>mujerBonita.avi</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-link"></i> Asociacion</button></td>
              <td>D://movies/mujerBonita.avi</td>
              <td><i class="fa fa-spinner fa-spin"></i> Analizando...</td>
              <td><button type="button" class="btn btn-primary" disabled="disabled">Importar</button></td>
                          </tr>
          </tbody>
        </table>
        <h3>Videos Personales</h3>
        <table class="table  tablaIndividual">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Editar</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th> <button type="button" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Casamiento</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Nombre</button></td>
              <td>D://otros/casamiento.avi</td>
              <td><i class="fa fa-check"></i> Importado</td>
              <td><button type="button" class="btn btn-primary" disabled="disabled">Finalizado</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>V800098</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Nombre</button></td>
              <td>D://otros/V800098.avi</td>
              <td><i class="fa fa-smile-o"></i> Disponible</td>
              <td><button type="button" class="btn btn-primary">Importar</button></td>
            </tr>
          </tbody>
        </table>
        <h3>Desconocidos</h3>
        <table class="table tablaIndividual">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Editar</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th> <button type="button" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>saaaaaaaaaaaaaaaa</td>
              <td> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Nombre</button></td>
              <td>D://otros/saaaaaaaaaaaaaaaaa.avi</td>
              <td><i class="fa fa-smile-o"></i> Disponible</td>
              <td><button type="button" class="btn btn-primary">Importar</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> <!-- /col-md-9 -->
        <!-- /ACA TERMINA PASO 2 -->
    
    
    </div> <!-- /row -->
</div> <!-- /container -->