<?php 
$hideOppo = false;
if($sourceType == 3)
{
	$localFolder = LocalFolder::model()->findByPk($idResource);
	if(isset($localFolder))
	{
		$hideOppo = ($localFolder->Id_file_type != 3)?true:false;
	}
}
else if($sourceType == 1)
{
	$nzbModel = Nzb::model()->findByPk($idResource);
	if(isset($nzbModel))
	{
		$hideOppo = (isset($nzbModel->mkv_file_name))?false:true;
	}
}
?>

<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">En que lugar desea reproducir?</h4>
				</div>
				<div class="modal-body">
					<div class="reproTableContainer">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Player</th>
									<th>Estado</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php 		
							$setting = Setting::getInstance();
							$players = $setting->players;
							$originalTitle='<i class="fa fa-spinner fa-spin"></i>  Verificando Estado';
							foreach ($players as $player)
							{
								if($player->type == 1 && $hideOppo)
									continue;
								
								echo CHtml::hiddenField("player",$player->Id,array('id'=>'player'));
							?>
								<tr>
									<td><?php echo $player->description?></td>
									
									<td id="td_status_selector_<?php echo $player->Id?>"><?php echo $originalTitle;?></td>
									<td id="td_btn_<?php echo $player->Id?>" class="align-right">
										<button id="btn_play_<?php echo $player->Id?>" style="visibility: hidden;" type="button" onclick="play('<?php echo $id?>', <?php echo $player->Id?>,<?php echo $sourceType?>,<?php echo $idResource?>)"
											class="btn btn-primary btn-play-by-player">
											<i class="fa fa-play-circle fa-fw"></i> Reproducir
										</button>
									</td>
								</tr>		
							<?php 
							}
							?>													
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-lg"
						data-dismiss="modal">Cancelar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
<script>

function play(id, idPlayer,sourceType,idResource)
{
	$("#btn_play_"+idPlayer).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Iniciando ...');
	$(".btn-play-by-player").attr("disabled", "disabled");
	$.post("<?php echo SiteController::createUrl('AjaxCanStart'); ?>",
			{
				idResource:idResource,
			    sourceType:sourceType
			}
			).success(
				function(data){
					if(data == "1")
					{
						var params = {
						    	id:id,
						    	idPlayer:idPlayer,
						    	sourceType:sourceType,
						    	idResource:idResource
							};
							window.location = "<?php echo SiteController::createUrl('site/startByPlayer'); ?>&"+$.param( params );
					}else
					{
						$("#myModalElegirPlayer").modal("hide");
						$("#myModalAlerta").modal("show");						
					}
				
			});
}
function fillStatus()
{
	$.each( $('[name="player"]'), function( key, value ) {
		$.post("<?php echo SiteController::createUrl('AjaxGetPlayerStatus'); ?>",
				{
					idPlayer:$(this).val()
				}
				).success(
					function(data){
						 obj = jQuery.parseJSON(data);
						 if(obj.powerOff == "1")
						 {
							  $("#td_status_selector_"+obj.idPlayer).html('<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.');
							  $("#td_status_selector_"+obj.idPlayer).attr('colspan','2');
							  $("#td_btn_"+obj.idPlayer).remove();							  
						 }
						 else if(obj.playing == "1")
						 {
							  $("#td_status_selector_"+obj.idPlayer).html('<span class="label label-danger">Reproduciendo</span> <br/> <i class="fa fa-caret-right"></i> '+obj.title);						 
							  $("#btn_play_"+obj.idPlayer).show();
							  $("#btn_play_"+obj.idPlayer).css('visibility','visible');
						 }
						 else
						 {
							  $("#td_status_selector_"+obj.idPlayer).html('<span class="label label-success">Libre</span>');
							  $("#btn_play_"+obj.idPlayer).show();
							  $("#btn_play_"+obj.idPlayer).css('visibility','visible');							  
						 }
					
				});
			})
}
fillStatus();
							
</script>
