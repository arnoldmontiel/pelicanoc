<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">Reproducciones</h4>
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
							$originalTitle='<i class="fa fa-spinner fa-spin"></i> Revisando Estado';
							foreach ($players as $player)
							{
								echo CHtml::hiddenField("player",$player->Id,array('id'=>'player'));
								
							?>
								<tr>
									<td colsppan="2"><?php echo $player->description?></td>
									
									<td id="td_status_<?php echo $player->Id?>"><?php echo $originalTitle;?></td>
									<td este="borrar" class="align-right">
										&nbsp;
										<button id="btn_dune_control_<?php echo $player->Id?>" style="display: none;" type="button" onclick="control('<?php echo $player->Id?>')" class="btn btn-primary btn-play-by-player">
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
        				var param = '&id=' + obj.id + '&type=' + obj.type + '&id_resource=' + obj.id_resource+'&id_player=' + idPlayer;
        				window.location = <?php echo '"'. SiteController::createUrl('OpenDuneControl') . '"'; ?> + param;    	
        				return false;
        			}
        		}
    		},"json");
		return false;
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
							  $("#td_status_"+obj.idPlayer).html('<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.');
						 }
						 else if(obj.playing == "1")
						 {
							  $("#td_status_"+obj.idPlayer).html('<span class="label label-danger">Reproduciendo</span> <br/> <i class="fa fa-caret-right"></i>'+obj.title);						 
							  $("#btn_dune_control_"+obj.idPlayer).show();
						 }
						 else
						 {
							  $("#td_status_"+obj.idPlayer).html('<span class="label label-success">Libre</span>');
						 }
					
				});
			})
}
fillStatus();

</script>

<?php
return;
										$originalTitle='<span class="label label-success">Libre</span>';
										$libre = true;
										try {
											if(PelicanoHelper::isPlayerAlive($player->Id))
											{
												if(DuneHelper::isPlayingByPlayer($player))
												{
													$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
													if(isset($modelCurrentPlaying))
													{
														$libre=false;
														$originalTitle='<span class="label label-danger">Reproduciendo</span> <br/> <i class="fa fa-caret-right"></i> ';
														if(isset($modelCurrentPlaying->Id_nzb))
														{
															if(isset($modelCurrentPlaying->nzb->Id_nzb))
																$originalTitle .= $modelCurrentPlaying->nzb->nzb->myMovieDiscNzb->myMovieNzb->original_title;
															else
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
											}
											else 
											{
												$originalTitle='<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.';
											}
										} catch (Exception $e) {
											$originalTitle='<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.';
										}
									?>