<div style="overflow:auto;height:200px">
<?php if($ready): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>T&iacute;tulo</th>
				<th>A&ntilde;o</th>			
				<th>Carpeta</th>							
				<th></th>
			</tr>
		</thead>
		<tbody id="bookmark-table">
			<?php
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				$setting = Setting::getInstance();
				echo CHtml::openTag('tr',array('class'=>'bookmark-row'));
				echo CHtml::closeTag('tr');
				foreach($modelESDataDBs as $item)
				{
					$localFolderPath = str_replace($modelCurrentES->path,'',$item->path);
					$localFolderPath = $setting->path_shared_pelicano_root. $setting->path_shared_copied. $localFolderPath;
					if(!empty($item->file))
						$localFolderPath = $localFolderPath.'/'.$item->file;
					
					$modelLocalFolder = LocalFolder::model()->findByAttributes(array('path'=>$localFolderPath));
					
					echo CHtml::openTag('tr',array('class'=>'bookmark-row', 'id'=>'id_'.$item->Id));
						echo CHtml::openTag('td');
							echo $item->title;
						echo CHtml::closeTag('td');
						echo CHtml::openTag('td');
							echo $item->year;
						echo CHtml::closeTag('td');
						echo CHtml::openTag('td');
							echo $item->path;
						echo CHtml::closeTag('td');								
						echo CHtml::openTag('td');
							if(isset($modelLocalFolder))
								echo "<button idrecord='".$item->Id."' class='btn btn-primary btn-medium '>Sobreescribir</button>";
							else
								echo "<button idrecord='".$item->Id."' class='btn btn-primary btn-medium '>Descargar</button>";
						echo CHtml::closeTag('td');
					echo CHtml::closeTag('tr');
				}
			}
			?>
		</tbody>
	</table>         
	<button id="btn-download-all" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Descargar Todo</button>
	<script>
		$('#btn-download-all').click(function(){
			var id = $('#hidden-unit').val();
			var target = $(this);
			$.post("<?php echo SiteController::createUrl('AjaxDownloadAllES'); ?>",
			{
				id:id
			}
			).success(
			function(data){
				$('.btn-download-handler').text("Descargando...");
				$('.btn-download-handler').attr("disabled", "disabled");
				target.attr("disabled", "disabled");
			});			
			return false;
		});	
	</script>
<?php else: ?>
<p>La unidad se esta escaneando...</p>
<?php endif; ?>
</div>