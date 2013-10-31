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
			echo CHtml::openTag('tr',array('class'=>'bookmark-row'));
			echo CHtml::closeTag('tr');
			foreach($modelESDataDBs as $item)
			{
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
						echo "<button idrecord='".$item->Id."' class='btn btn-primary btn-medium '>Descargar</button>";
					echo CHtml::closeTag('td');
				echo CHtml::closeTag('tr');
			}
			?>
		</tbody>
	</table>         
	<button id="btn-download-all" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Descargar Todo</button>
	<script>
		$('#btn-download-all').click(function(){
			var id = $('#hidden-unit').val();
			$.post("<?php echo SiteController::createUrl('AjaxDownloadAllES'); ?>",
			{
				id:id
			}
			).success(
			function(data){
			});
			markRead();
			return false;
		});	
	</script>
<?php else: ?>
<p>La unidad se esta escaneando...</p>
<?php endif; ?>
</div>