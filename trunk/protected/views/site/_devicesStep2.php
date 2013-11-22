<?php 
	$disabled = '';
	if($hardScanReady == 0)
		$disabled = 'disabled="disabled"';
?>
<?php if($hardScanReady == 0):?>
<div id="scaningLabel"><h2><?php echo $label;?> <i class="fa fa-spinner fa-spin"></i> Analizando...</h2></div>
<?php else:?>
<div id="NoScaningLabel" style="display:none"><h2><?php echo $label;?> </h2></div>
<?php endif;?>
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
	              <th> <button type="button" id="copy-all-known" onclick="copyAll('knownTable')" <?php echo $disabled;?> class="btn btn-default">Importar Todo</button></th>
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
	        					echo "<button type='button' onclick='changeAsoc(".$modelESData->Id.")' class='btn btn-primary' .$disabled.'><i class='fa fa-link'></i> Asociacion</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESData->Id));
	        					echo ReadFolderHelper::getTdStatus($modelESData);	        				
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td",array('id'=>'idTdButton_'.$modelESData->Id));
	        					echo ReadFolderHelper::getTdButton($modelESData);
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
              <th> <button type="button" id="copy-all-personal" onclick="copyAll('personalTable')" <?php echo $disabled;?> class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody id="personalTable">
           <?php
        			$index = 0;
        			foreach($modelESDataPersonals as $modelESDataPersonal)
        			{
        				$index++;       
        				$name = $modelESDataPersonal->title;
        				if(!empty($modelESDataPersonal->year))
        					$name .= ' ('.$modelESDataPersonal->year.')';
        				
        				$path = $modelESDataPersonal->path;
        				if(!empty($modelESDataPersonal->file))
        					$path .= '/'.$modelESDataPersonal->file;
        				
        				echo CHtml::openTag("tr",array('id'=>'idTr_'.$modelESDataPersonal->Id, 'iddata'=>$modelESDataPersonal->Id));
        				
        					echo CHtml::openTag("td");
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td",array('id'=>'idTdName_'.$modelESDataPersonal->Id));
		        				echo $name;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdAsoc_'.$modelESDataPersonal->Id));
	        					echo "<button type='button' ".$disabled." onclick='changeName(".$modelESDataPersonal->Id.")' class='btn btn-primary open-change-name' data-toggle='modal'><i class='fa fa-pencil'></i> Nombre</button>";
	        				echo CHtml::closeTag("td");
	        					
	        				echo CHtml::openTag("td");
	        					echo $path;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESDataPersonal->Id));
	        					echo ReadFolderHelper::getTdStatus($modelESDataPersonal);
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag("td",array('id'=>'idTdButton_'.$modelESDataPersonal->Id));
	        					echo ReadFolderHelper::getTdButton($modelESDataPersonal);
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
              <th> <button type="button" id="copy-all-unknown" onclick="copyAll('unknownTable')" <?php echo $disabled;?> class="btn btn-default">Importar Todo</button></th>
            </tr>
          </thead>
          <tbody id="unknownTable">           
          </tbody>
        </table>
      </div>
<script>

</script> 
   