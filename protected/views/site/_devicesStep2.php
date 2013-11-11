
<div id="scaningLabel"><h2>USB 1 (Kingston) <i class="fa fa-spinner fa-spin"></i> Analizando...</h2></div>
<div id="NoScaningLabel" style="display:none"><h2>USB 1 (Kingston) </h2></div>
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
	              <th> <button type="button" onclick="copyAll('knownTable')" disabled="disabled" class="btn btn-default">Importar Todo</button></th>
	            </tr>
	          </thead>
	          <tbody id="knownTable">
				<?php
        			$index = 0;
        			foreach($modelESDatas as $modelESData)
        			{
        				$index++;
        				$name = $modelESData->title;
        				if(!empty($modelESData->year))
        					$name .= ' ('.$modelESData->year.')';
        				
        				$path = $modelESData->path;
        				if(!empty($modelESData->file))
        					$path .= '/'.$modelESData->file;
        				
        				echo CHtml::openTag("tr",array('id'=>'idTr_'.$modelESData->Id, 'iddata'=>$modelESData->Id, 'unknown'=>0));
        				
        					echo CHtml::openTag("td");
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td",array('id'=>'idTdName_'.$modelESData->Id));
	        					echo $name;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdAsoc_'.$modelESData->Id));
	        					echo "<button type='button' onclick='changeAsoc(".$modelESData->Id.")' class='btn btn-primary' disabled='disabled'><i class='fa fa-link'></i> Asociacion</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESData->Id));
	        					echo "<i class='fa fa-spinner fa-spin'></i> Analizando...";
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td",array('id'=>'idTdButton_'.$modelESData->Id));
	        					echo "<button type='button' class='btn btn-primary' disabled='disabled'>Analizando...</button>";
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
              <th> <button type="button" onclick="copyAll('personalTable')" disabled="disabled" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody id="personalTable">
           <?php
        			$index = 0;
        			foreach($modelESDataPersonals as $modelESDataPersonal)
        			{
        				$index++;        				
        				echo CHtml::openTag("tr",array('id'=>'idTr_'.$modelESDataPersonal->Id, 'iddata'=>$modelESDataPersonal->Id));
        				
        					echo CHtml::openTag("td");
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td",array('id'=>'idTdName_'.$modelESDataPersonal->Id));
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
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdAsoc_'.$modelESDataPersonal->Id));
	        					echo "<button type='button' disabled='disabled' onclick='changeName(".$modelESDataPersonal->Id.")' class='btn btn-primary open-change-name' data-toggle='modal'><i class='fa fa-pencil'></i> Nombre</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $modelESDataPersonal->path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESDataPersonal->Id));
	        					echo "<i class='fa fa-spinner fa-spin'></i> Analizando...";
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td",array('id'=>'idTdButton_'.$modelESDataPersonal->Id));
	        					echo "<button type='button' class='btn btn-primary' disabled='disabled'>Analizando...</button>";
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
              <th> <button type="button" onclick="copyAll('unknownTable')" disabled="disabled" class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody id="unknownTable">           
          </tbody>
        </table>
      </div>
<script>

</script> 
   