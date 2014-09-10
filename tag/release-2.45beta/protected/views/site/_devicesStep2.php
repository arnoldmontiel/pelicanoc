
<?php 
	$disabled = '';
	if($hardScanReady == 0)
		$disabled = "disabled='disabled'";
?>
<?php if($hardScanReady == 0):?>
<div id="scaningLabel"><h2><?php // echo $label;?> <i class="fa fa-spinner fa-spin"></i> Analizando...</h2></div>
<div id="NoScaningLabel" style="display:none"><h2><?php // echo $label;?> </h2></div>
<?php else:?>
<div id="scaningLabel" style="display:none"><h2><?php // echo $label;?> <i class="fa fa-spinner fa-spin"></i> Analizando...</h2></div>
<div id="NoScaningLabel"><h2><?php // echo $label;?> </h2></div>
<?php endif;?> 
<div class="devicesHeader clearfix"><div class="dropdown deviceDropdown pull-left">
          <a class="deviceDropdownName" id="drop" role="button" data-toggle="dropdown" href="#"><?php echo $label;?> <i class="fa fa-caret-down"></i></a>
           <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop">
				<?php
					$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));
			    	if(count($modelCurrentESs)>0)
					{
						foreach($modelCurrentESs as $modelCurrentES)
						{
							$nameES = $modelCurrentES->label;
							if($idCurrentES != $modelCurrentES->Id)
								echo "<li id=".$modelCurrentES->Id." ><a onclick='changeDevice(".$modelCurrentES->Id.")'>".$nameES."</a></li>";
						}
					}
				?>        		
		 </ul>
        </div>
<ul class="nav nav-tabs pull-right">
  <li class="active"><a href="#tpeliculas" data-toggle="tab">Pel&iacute;culas <span class="badge"><?php echo count($modelESDatas); ?></span></a></li>
  <li><a href="#tvpersonales" data-toggle="tab">Videos Personales <span class="badge"><?php echo count($modelESDataPersonals); ?></span></a></li>
  <li><a href="#tdesconocidos" data-toggle="tab">Desconocidos <span class="badge">0</span></a></li>
</ul>        </div>
<div class="tab-content">
  <div class="tab-pane active" id="tpeliculas">

    <div class="table-responsive">
    	<h3 class="tableTitle">Pel&iacute;culas <span class="pull-right">Finalizadas 3 de 10</span><span class="pull-right">  &bull; </span><span class="pull-right">Importando 10 de 30</span></h3>
	        <table class="table tablaIndividual" id="tablaDevicesPeliculas" width="100%">
	          <thead>
	            <tr>
	              <th width="5%" style="text-align:center;">#</th>
	              <th width="55%" style="text-align:left;">Nombre</th>
	              <th width="20%" style="text-align:left;">Estado</th>
	              <th width="20%" style="text-align:right;"> <button type="button" id="copy-all-known" onclick="copyAll('knownTable')" <?php echo $disabled;?> class="btn btn-primary"><i class='fa fa-download'></i> Importar Todas</button></th>
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
        				
        					echo CHtml::openTag('td align="center"');
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td");
	        					echo "<div id='idTdName_".$modelESData->Id."' class='tablePeliTitle'>".$name."</div>";
	        					echo "<div class='small' style='padding-top:5px;'>".$modelESData->file."</div>";
	        					echo "<button type='button' id='idBtnAsoc_".$modelESData->Id."' onclick='changeAsoc(".$modelESData->Id.")' class='btn btn-default' " .ReadFolderHelper::getTdAsocEnabled($modelESData)."><i class='fa fa-pencil'></i> Editar Informaci&oacute;n</button>";
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESData->Id));
	        					echo ReadFolderHelper::getTdStatus($modelESData);	        				
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag('td align="right"',array('id'=>'idTdButton_'.$modelESData->Id));
	        					echo ReadFolderHelper::getTdButton($modelESData);
	        				echo CHtml::closeTag("td");
	        				
	        			echo CHtml::closeTag("tr");
        			}	
        		?>	           
	          </tbody>
	        </table>
	        </div><!-- cierre table-responsive  -->
	        </div><!-- cierre panel Tab  -->
  <div class="tab-pane" id="tvpersonales">
      <div class="table-responsive">
    	<h3 class="tableTitle">Videos Personales <span class="pull-right">Finalizados 3 de 10</span><span class="pull-right">  &bull; </span><span class="pull-right">Importando 10 de 30</span></h3>
              <table class="table tablaIndividual">
          <thead>
            <tr>
              <th width="5%" style="text-align:center;">#</th>
              <th width="30%" style="text-align:left;">Nombre</th>
              <th width="35%" style="text-align:left;">Archivo</th>
              <th width="20%" style="text-align:left;">Estado</th>
              <th width="10%" style="text-align:right;"> <button type="button" id="copy-all-personal" onclick="copyAll('personalTable')" <?php echo $disabled;?> class="btn btn-primary"><i class='fa fa-download'></i> Importar Todos</button></th>
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
        				
        					echo CHtml::openTag('td align="center"');
        						echo $index;
        					echo CHtml::closeTag("td");
        					
	        				echo CHtml::openTag("td");
	        					echo "<div id='idTdName_".$modelESDataPersonal->Id."' class='tablePeliTitle'>".$name."</div>";
	        					echo "<button type='button' id='idBtnAsoc_".$modelESDataPersonal->Id."' ".ReadFolderHelper::getTdAsocEnabled($modelESDataPersonal)." onclick='changeName(".$modelESDataPersonal->Id.")' class='btn btn-default open-change-name' data-toggle='modal'><i class='fa fa-pencil'></i> Editar Nombre</button>";
	        				echo CHtml::closeTag("td");
	        				
	        					
	        				echo CHtml::openTag('td class="tdPath"');
	        					echo $modelESData->file;
	        				echo CHtml::closeTag("td");
	        				
	        				echo CHtml::openTag("td",array('id'=>'idTdStatus_'.$modelESDataPersonal->Id));
	        					echo ReadFolderHelper::getTdStatus($modelESDataPersonal);
	        				echo CHtml::closeTag("td");

	        				echo CHtml::openTag('td align="right"',array('id'=>'idTdButton_'.$modelESDataPersonal->Id));
	        					echo ReadFolderHelper::getTdButton($modelESDataPersonal);
	        				echo CHtml::closeTag("td");
	        				
	        			echo CHtml::closeTag("tr");
        			}	
        		?>	           
          </tbody>
        </table>
	        </div><!-- cierre table-responsive  -->
        </div><!-- cierre panel Tab  -->
  <div class="tab-pane" id="tdesconocidos">
      <div class="table-responsive">
    	<h3 class="tableTitle">Desconocidos <span class="pull-right">No hay videos desconocidos.</span></h3>
              <table class="table tablaIndividual">
          <thead>
            <tr>
              <th width="5%" style="text-align:center;">#</th>
              <th width="30%" style="text-align:left;">Nombre</th>
              <th width="35%" style="text-align:left;">Archivo</th>
              <th width="20%" style="text-align:left;">Estado</th>
              <th width="10%" style="text-align:right;"> <button type="button" id="copy-all-unknown" onclick="copyAll('unknownTable')" <?php echo $disabled;?> class="btn btn-primary"><i class='fa fa-download'></i> Importar Todos</button></th>
            </tr>
          </thead>
          <tbody id="unknownTable">           
          </tbody>
        </table>
	        </div><!-- cierre table-responsive  -->
        </div><!-- cierre panel Tab  -->
</div><!-- cierre grupo Tabs  -->
        

<script>

</script> 
   