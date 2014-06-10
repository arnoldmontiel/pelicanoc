<div class="container" id="screenConfig" >
    	 <div class="wrapper clearfix">
    	 <div class="row">
    	 <div class="col-md-2"></div>
    	 <div class="col-md-8 col-sm-12">
    	 <div  class="configForm">
		    <form role="form">
  					<div class="inlineForm">
  					<label class="inlineFormLabel">Sabnzbd</label>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Sabnzbd password path</label>
	    						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[sabnzb_pwd_file_path]" id="Device_sabnzb_pwd_file_path" type="text" maxlength="255">	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Sabnzbd path descarga</label>
	    						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[path_sabnzbd_download]" id="Device_path_sabnzbd_download" type="text" maxlength="255">	  					</div>
  					</div>
  					<div class="row">   
  						<div class="form-group col-sm-6 ">
	    					<label>Sabnzbd API URL</label>
	      						<input class="form-control" placeholder="Url" onkeyup="changeSaveLabel();" name="Device[sabnzb_api_url]" id="Device_sabnzb_api_url" type="text" maxlength="255">	  					</div> 
	  					<div class="form-group col-sm-6">
	  						    					<label>Sabnzbd API Key</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[sabnzb_api_key]" id="Device_sabnzb_api_key" type="text" maxlength="255">	  						
	  					</div>  	    
  					</div>			
  					</div>
  					<div class="inlineForm">
  					<label class="inlineFormLabel">Servidor Multimedia</label>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia IP</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_file_server]" id="Device_host_file_server" type="text" maxlength="255">	  					</div>
	  					<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Path Archivos</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_file_server_path]" id="Device_host_file_server_path" type="text" maxlength="255">	  					</div>
  					</div>  					
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Usuario</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_file_server_user]" id="Device_host_file_server_user" type="text" maxlength="255">	  					</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia Password</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_file_server_passwd]" id="Device_host_file_server_passwd" type="text" maxlength="255">	  					</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Nombre</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_file_server_name]" id="Device_host_file_server_name" type="text" maxlength="255">	  					</div>
	  					<div class="form-group col-sm-6 ">
	  				
	  					</div>	  					
  					</div>
  					</div>
  					  					<div class="inlineForm">
  					<label class="inlineFormLabel">Tmdb</label>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Tmdb API Key</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[tmdb_api_key]" id="Device_tmdb_api_key" type="text" maxlength="255">	  					</div>  					
	  					<div class="form-group col-sm-6">
	    					<label>Tmdb API Lang</label>
	      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[tmdb_lang]" id="Device_tmdb_lang" type="text" maxlength="45">	  					</div>
  					</div>
  					</div>
  					  					<div class="inlineForm">
	  					<label class="inlineFormLabel">Varios</label>
	  					<div class="row">
		  					<div class="form-group col-sm-6 ">
		    					<label>Path Compartidos</label>
		    						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[path_shared]" id="Device_path_shared" type="text" maxlength="255">		  					</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>Password MJ</label>
		      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[michael_jackson]" id="Device_michael_jackson" type="text" maxlength="512">		  					</div>
	  					</div>
	  						  					<div class="row">
		  					<div class="form-group col-sm-6 ">
		    					<label>Host</label>
		      						<input class="form-control" onkeyup="changeSaveLabel();" name="Device[host_name]" id="Device_host_name" type="text" maxlength="255">		  					</div>  		
		  					<div class="form-group col-sm-6 ">
		  						<label>Es Tester</label>
	      							<input id="ytDevice_is_movie_tester" type="hidden" value="0" name="Device[is_movie_tester]"><input class="form-control noShadow" onkeyup="changeSaveLabel();" name="Device[is_movie_tester]" id="Device_is_movie_tester" value="1" type="checkbox">	      					</div>			
	  					</div>
	  					  					</div>
  					<div class="form-group">
    					<div class="col-sm-12">    	
    						<button id="btn-save-config" onclick="submitGeneralConfig();" type="button" class="btn btn-default pull-right"><i class="fa fa-save"></i> <span id="save-description">Guardar</span>    						
    						</button>
    					</div>
    				</div>
			</form>
               </div> 
    	 
    	 </div>
    	 <div class="col-md-2"></div>
    	 </div>
    	 
    	 </div><!-- /wrapper -->
</div><!-- /container -->