<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">Reproduciendo</h4>
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
							foreach ($players as $player)
							{
							?>
								<tr>
									<td><?php echo $player->description?></td>
									<?php
										$originalTitle="Libre";
										$libre = true;
										try {
											if(DuneHelper::isPlayingByPlayer($player))
											{
												$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
												if(isset($modelCurrentPlaying))
												{
													$libre=false;
													$originalTitle="Reproduciendo: ";
													if(isset($modelCurrentPlaying->Id_nzb))
													{
														$originalTitle .= $modelCurrentPlaying->nzb->myMovieDiscNzb->myMovieNzb->original_title;
													}
													else if(isset($modelCurrentPlaying->Id_ripped_movie))
													{
														$originalTitle .= $modelCurrentPlaying->rippedMovie->myMovieDisc->myMovie->original_title;
													}
													else if(isset($modelCurrentPlaying->Id_local_folder))
													{
														$originalTitle .= $modelCurrentPlaying->localFolder->myMovieDisc->myMovie->original_title;
													}
													else if(isset($modelCurrentPlaying->Id_current_disc))
													{
														$originalTitle .= $modelCurrentPlaying->currentDisc->myMovieDisc->myMovie->original_title;
													}
												}
											}
											
										} catch (Exception $e) {
											$originalTitle="Apagado";
										}
									?>
									<td><?php echo $originalTitle;?></td>
									<td class="align-right">
									
									<button <?php if($libre) echo 'disabled="disabled"';?> id="btn-dune-control" type="button" onclick="control(<?php echo $player->Id; ?>)"
											class="btn btn-primary btn-play-by-player">
											<i class="fa fa-keyboard-o fa-fw"></i> Control Remoto	
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
						data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		
<script>
function control(idPlayer)
{
    	$.post("<?php echo SiteController::createUrl('AjaxGetPlaybackByPlayer'); ?>",{idPlayer:idPlayer}
    	).success(
    		function(data){
        		if(data != null)
        		{        			
        			var obj = jQuery.parseJSON(data);
        			if(obj.id != 0)
        			{
        				var param = '&id=' + obj.id + '&type=' + obj.type + '&id_resource=' + obj.id_resource;
        				window.location = <?php echo '"'. SiteController::createUrl('OpenDuneControl') . '"'; ?> + param;    	
        				return false;
        			}
        		}
    		},"json");
		return false;
}
function play(id, idPlayer,sourceType,idResource)
{
	$(".btn-play-by-player").attr("disabled", "disabled");
	var params = {
    	id:id,
    	idPlayer:idPlayer,
    	sourceType:sourceType,
    	idResource:idResource
	};
	//window.location = "<?php echo SiteController::createUrl('site/startByPlayer'); ?>&"+$.param( params );	
}
							
</script>