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
									<th>Reproduciendo</th>
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
									<td>Spiderman</td>
									<td class="align-right"><button type="button"
											class="btn btn-primary">
											<i class="fa fa-play-circle fa-fw"></i> Reproducir
										</button></td>
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
