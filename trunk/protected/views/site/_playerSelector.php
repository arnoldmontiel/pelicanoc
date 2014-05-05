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
							foreach ($players as $player)
							{
							?>
								<tr>
									<td><?php echo $player->description?></td>
									<?php
										$originalTitle='<span class="label label-success">Libre</span>';
										$isAlive = false;										
										try {
											if(PelicanoHelper::isPlayerAlive($player->Id))
											{
												$isAlive = true;
												if(DuneHelper::isPlayingByPlayer($player))
												{
													$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
													if(isset($modelCurrentPlaying))
													{
														$originalTitle='<span class="label label-danger">Reproduciendo</span> <br/> <i class="fa fa-caret-right"></i> ';
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
											}
											else
											{												
												$originalTitle='<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.';
											}												
										} catch (Exception $e) {
											$originalTitle='<span class="label label-default">Apagado</span> <i class="fa fa-warning"></i> El player esta apagado o fuera de servicio, un informe fue enviado para analizar el problema.';
										}
									?>
									<td><?php echo $originalTitle;?></td>
									<td class="align-right">
									<?php if($isAlive):?>
										<button id="btn-play-player" type="button" onclick="play('<?php echo $id?>', <?php echo $player->Id?>,<?php echo $sourceType?>,<?php echo $idResource?>)"
											class="btn btn-primary btn-play-by-player">
											<i class="fa fa-play-circle fa-fw"></i> Reproducir
										</button>
										<?php else:?>
											&nbsp;
										<?php endif?>
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
	$(".btn-play-by-player").attr("disabled", "disabled");
	$.post("<?php echo SiteController::createUrl('AjaxArnold'); ?>",
			{
				idResource:idResource,
			    sourceType:sourceType
			}
			).success(
				function(data){
					alert(data)
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
							
</script>