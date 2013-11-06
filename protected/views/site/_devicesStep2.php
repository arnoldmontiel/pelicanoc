
<h2>USB 1 (Kingston) <i class="fa fa-spinner fa-spin"></i> Analizando...</h2>
	Lista de videos detectados:       
    <div class="table-responsive">
    	<h3>Peliculas</h3>
	        <table class="table table-bordered tablaIndividual">
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
				<?php
        			$index = 0;
        			foreach($modelESDatas as $modelESData)
        			{
        				$index++;
        				echo CHtml::openTag("tr",array('id'=>'idTr_'.$modelESData->Id));
        				
        					echo CHtml::openTag("td");
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td");
	        				if(empty($modelESData->file))
	        				{
	        					$paths = explode('/', $modelESData->path);
	        					$size = count($paths);
	        					if($size>0)
	        						echo $paths[$size-1];
	        				}
	        				else
	        					echo $modelESData->file;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td");
	        					echo "<button type='button' class='btn btn-primary'><i class='fa fa-link'></i> Asociacion</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $modelESData->path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESData->Id));
	        					echo "<i class='fa fa-spinner fa-spin'></i> Analizando...";
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td");
	        					echo "<button type='button' class='btn btn-primary' disabled='disabled'>Importar</button>";
	        				echo CHtml::closeTag("td");
	        				
	        			echo CHtml::closeTag("tr");
        			}	
        		?>	           
	          </tbody>
	        </table>
        <h3>Videos Personales</h3>
        <table class="table table-bordered tablaIndividual">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Editar</th>
              <th>Ruta</th>
              <td>Estado</td>
              <th> <button type="button" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody>
           <?php
        			$index = 0;
        			foreach($modelESDataPersonals as $modelESDataPersonal)
        			{
        				$index++;        				
        				echo CHtml::openTag("tr",array('id'=>'idTr_'.$modelESDataPersonal->Id));
        				
        					echo CHtml::openTag("td");
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td");
	        				if(empty($modelESDataPersonal->file))
	        				{
	        					$paths = explode('/', $modelESDataPersonal->path);
	        					$size = count($paths);
	        					if($size>0)
	        						echo $paths[$size-1];
	        				}
	        				else
	        					echo $modelESDataPersonal->file;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td");
	        					echo "<button type='button' class='btn btn-primary'><i class='fa fa-link'></i> Asociacion</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $modelESDataPersonal->path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESDataPersonal->Id));
	        					echo "<i class='fa fa-spinner fa-spin'></i> Analizando...";
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td");
	        					echo "<button type='button' class='btn btn-primary' disabled='disabled'>Importar</button>";
	        				echo CHtml::closeTag("td");
	        				
	        			echo CHtml::closeTag("tr");
        			}	
        		?>	           
          </tbody>
        </table>
        
        <h3>Desconocidos</h3>
        <table class="table table-bordered tablaIndividual">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Editar</th>
              <th>Ruta</th>
              <td>Estado</td>
              <th> <button type="button" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody id="unknownTable">           
          </tbody>
        </table>
      </div>
<script>

</script> 
   