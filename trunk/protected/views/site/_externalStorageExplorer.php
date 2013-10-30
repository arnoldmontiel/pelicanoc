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
<?php else: ?>
<p>La unidad se esta escaneando...</p>
<?php endif; ?>
</div>