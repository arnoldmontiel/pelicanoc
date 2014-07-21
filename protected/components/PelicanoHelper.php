<?php
require_once(dirname(__FILE__) . "/../stubs/Pelicano.php");
require_once(dirname(__FILE__) . "/../stubs/wsSettings.php");
class PelicanoHelper
{
	static public function saveNetworkConfiguration($commandParams)
	{
// 		ADDRESS  =$1
// 		METHOD   =$2
// 		NETMASK  =$3
// 		NETWORK  =$4
// 		BROADCAST=$5
// 		GATEWAY  =$6
		if(!isset($commandParams['address']))	$commandParams['address']="";
		if(!isset($commandParams['method'])) 	$commandParams['method']="dhcp";
		if(!isset($commandParams['netmask']))	$commandParams['netmask']="";
		if(!isset($commandParams['network']))	$commandParams['network']="";
		if(!isset($commandParams['broadcast']))	$commandParams['broadcast']="";
		if(!isset($commandParams['gateway']))	$commandParams['gateway']="";
		if(!isset($commandParams['dns-nameservers']))	$commandParams['dns-nameservers']="";		
				
		if($commandParams['method']=="dhcp")//dhcp
		{
			$params = '"" "'.
					$commandParams['method'].'" "" "" "" "" ""';
			
		}
		else
		{
			$params = '"'.$commandParams['address'].'" "'.
				$commandParams['method'].'" "'
				.$commandParams['netmask'].'" "'
				.$commandParams['network'].'" "'
				.$commandParams['broadcast'].'" "'
				.$commandParams['gateway'].'" "'
				.$commandParams['dns-nameservers'].'"';		
		}
		exec('sudo '.dirname(__FILE__).'/../commands/shell/networkEditor.sh '.$params,$output,$return);
		
	}
	static public function getNetworkConfiguration()
	{
		exec(dirname(__FILE__).'/../commands/shell/networkGetConfiguration.sh',$output,$return);
		$result = array();
		if($return==0)
		{
			if(isset($output)&&is_array($output))
			{
				foreach ($output as $item)
				{
					//example of a line
					///files/etc/network/interfaces/iface[2]/address = 192.168.0.105
					$line = explode('=', $item);
					if(isset($line[0])&&strpos($line[0], "address")!==false)
					{
						$result['address']=trim($line[1]);						
					}
					elseif(isset($line[0])&&strpos($line[0], "method")!==false)
					{
						$result['method']=trim($line[1]);						
					}
					elseif(isset($line[0])&&strpos($line[0], "netmask")!==false)
					{
						$result['netmask']=trim($line[1]);
					}
					elseif(isset($line[0])&&strpos($line[0], "broadcast")!==false)
					{
						$result['broadcast']=trim($line[1]);
					}
					elseif(isset($line[0])&&strpos($line[0], "gateway")!==false)
					{
						$result['gateway']=trim($line[1]);
					}
					elseif(isset($line[0])&&strpos($line[0], "dns-nameservers")!==false)
					{
						$result['dns-nameservers']=trim($line[1]);
						$DNSs = explode(" ", $result['dns-nameservers']);
						if(is_array($DNSs))
						{
							foreach($DNSs as $dns)
							{								
								if(!isset($result['dns1']))
								{
									$result['dns1']=$dns;									
								}
								if(!isset($result['dns2']))
								{
									$result['dns2']=$dns;
									break;									
								}
							}							
						}
					}					
					//siempre al final y con el espacio "network "	
					elseif(isset($line[0])&&strpos($line[0], "network ")!==false)
					{
						$result['network']=trim($line[1]);
					}
				}								
			}						
		}		
		if(isset($result['method'])&&$result['method']=="dhcp")
		{
			if(!isset($result['network']))	$result['network']="";
			if(!isset($result['gateway']))	$result['gateway']="";
			if(!isset($result['broadcast']))	$result['broadcast']="";
			if(!isset($result['netmask']))	$result['netmask']="";
			if(!isset($result['address']))	$result['address']="";
			if(!isset($result['dns1']))	$result['dns1']="";
			if(!isset($result['dns2']))	$result['dns2']="";			
		}			
		return $result;
	}
	static public function pauseSabnzbd()
	{
		$settings = Setting::getInstance();
		$url = $settings->sabnzb_api_url."mode=pause&apikey=".$settings->sabnzb_api_key;
		$response = @file_get_contents($url);
	}
	static public function resumeSabnzbd()
	{
		$settings = Setting::getInstance();
		$url = $settings->sabnzb_api_url."mode=resume&apikey=".$settings->sabnzb_api_key;
		$response = @file_get_contents($url);
	}	
	/**
	 * Graba el estado nuevo del sistema, si no cambia nada, no se hace el update
	 * @param integer $status 1-error_players, 2-error_NAS, 3-error_NAS_space
	 * @param integer $value 1 o 0
	 * @return true si algo cambia y se logra grabar.
	 *  
	 */
	static public function saveSystemStatus($status,$value)
	{
		//$error_player, 2-error_NAS, 3-error_NAS_space
		$systemStatus = SystemStatus::model()->findByPk(1);
		if(!isset($systemStatus))
		{
			$systemStatus = new SystemStatus;
			$systemStatus->Id=1;
			$systemStatus->save();
		}
		$result = false;
		switch ($status) {
			case 1:
				if($systemStatus->error_players!=$value)
				{
					$settings = Setting::getInstance();
					$hasError= 0;
					foreach ($settings->players as $player)
					{
						if($player->has_error)
						{
							$hasError = 1;
							break;
						}
						
					}
					$systemStatus->error_players=$hasError;
					$errorLog = new ErrorLog();
					$errorLog->error_type = $status;
					$errorLog->has_error = $hasError;
					$errorLog->save();
					$result = $systemStatus->save();
				}					
			break;
			case 2:
				if($systemStatus->error_NAS!=$value)
				{
					$systemStatus->error_NAS=$value;
					$result = $systemStatus->save();
					$errorLog = new ErrorLog();
					$errorLog->error_type = $status;
					$errorLog->has_error = $value;
					$errorLog->save();
					if($value==false)//no hay error
					{
						self::resumeSabnzbd();
					}
					else
					{
						self::pauseSabnzbd();						
					}
				}					
				break;
			case 3:
				if($systemStatus->error_NAS_space!=$value)
				{
					$systemStatus->error_NAS_space=$value;
					$result = $systemStatus->save();
					$errorLog = new ErrorLog();
					$errorLog->error_type = $status;
					$errorLog->has_error = $value;
					$errorLog->save();
					if($value==false)//no hay error
					{
						self::resumeSabnzbd();
					}
					else
					{
						self::pauseSabnzbd();
					}						
				}					
				break;				
			default:
				$result=false;
			break;
		}
		return $result;		
	}
	static public function getLeftFilter($flr, $page = '')
	{
		$filters = "";
		
		$criteria = new CDbCriteria();
		$criteria->select = 'distinct '. $flr;
		$criteria->order = $flr.' DESC';
		
		if($page == 'marketplace')
			$movies = Marketplace::model()->findAll($criteria);
		else
			$movies = Movies::model()->findAll($criteria);
		
		if($flr == 'year')
		{
			foreach($movies as $item)
			{
				if(isset($item->year) && !empty($item->year))
					$filters .= '<a href="#" class="pushMenuCheck" data-filter="flr-'.$item->year.'">'.$item->year.'</a>';
			}			
		}
		else 
		{
			$genres = array();
			foreach($movies as $item)
			{
				$movieGenres = explode(', ',$item->genre);
				foreach($movieGenres as $value)
				{
					if(!empty($value) && ! in_array($value,$genres))
						$genres[] = $value;
				}				
			}
			asort($genres);
			foreach($genres as $value)
			{
				$aux = preg_replace('/\W/', '-',strtolower($value));
				$filters .= '<a href="#" class="pushMenuCheck" data-filter="flr-'.$aux.'">'.$value.'</a>';
			}
		}
		
		
		return $filters;
	}
	
	static public function getFilters($model)
	{
		$year = "";
		$title = "";
		$genre = "";
		$new = "";
		
		if(isset($model->genre))
		{
			$genres = explode(', ', $model->genre);
			foreach($genres as $item)
			{
				$aux = preg_replace('/\W/', '-',strtolower($item));
				$genre = $genre . ' flr-'.$aux;
			}
		}
		
		if(isset($model->title))
		{
			$title = preg_replace('/\W/', '-',strtolower($model->title));
			$title = 'flr-'.$title;
		}		
		
		if(isset($model->year))
			$year = 'flr-'.$model->year;

		if(isset($model->is_new))
			$new = ($model->is_new == 1)?'flr-isnew':'';
		
		return $genre . ' ' . $title . ' ' . $year . ' ' . $new;	
	}
	
	static public function getFiltersMarketplace($model)
	{
		$year = "";
		$title = "";
		$genre = "";
	
		if(isset($model->genre))
		{
			$genres = explode(', ', $model->genre);
			foreach($genres as $item)
			{
				$aux = preg_replace('/\W/', '-',strtolower($item));
				$genre = $genre . ' flr-'.$aux;
			}
		}
	
		if(isset($model->title))
		{
			$title = preg_replace('/\W/', '-',strtolower($model->title));
			$title = 'flr-'.$title;
		}
	
		if(isset($model->year))
			$year = 'flr-'.$model->year;
	
	
		return $genre . ' ' . $title . ' ' . $year;
	}
	
	static public function getImageName($name, $posFix = "")
	{
		$pos = strpos($name, "?");
		$fileName=$name;
		if(($pos !== false))
		{
			$fileName=explode('?', $name);
			$fileName = $fileName[0];
		}
		$imagePath = "images/";
		$defaultImage = 'no_image'.$posFix.'.jpg';
		$imageName = $imagePath.$defaultImage;
		if(file_exists($imagePath.$fileName) && !empty($name))
			$imageName = $imagePath.$name;
		
		return $imageName;
	}
	
	static public function onDeleteCheckES($model, $sourceType)
	{
		if($sourceType == 3)
		{
			if(!empty($model->path_original))
			{
				$criteria = new CDbCriteria();
				$criteria->join = 'INNER JOIN current_external_storage ces on (t.Id_current_external_storage = ces.Id)';
				$criteria->addCondition('ces.is_in = 1');
				$criteria->addCondition('ces.soft_scan_ready = 1');
				$criteria->addCondition('ces.hard_scan_ready = 1');
				
				$setting = Setting::getInstance();
				
				$modelESDatas = ExternalStorageData::model()->findAll($criteria);
				foreach($modelESDatas as $modelESData)
				{
					$path = $setting->path_shared_pelicano_root.$setting->path_shared_copied;
					$path .= $modelESData->path;					
					if(!empty($modelESData->file))
						$path .= '/'.$modelESData->file;
					
					if($path == $model->path_original )
					{
						$modelESData->copy = 0;
						$modelESData->already_exists = 0;
						$modelESData->status = 7;
						$modelESData->save();
					}
				}
			}
		}
	}
	
	static public function getDirectorySize($path, $formatBytes = true)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			//This is a server using Windows
			if($formatBytes)
				$output = self::format_bytes(self::getWinDirSize($path));
			else
				$output = self::getWinDirSize($path);
		} else {
			//This is a server not using Windows
			if($formatBytes)
				$output = self::format_bytes(self::getNixDirSize($path));
			else
				$output = self::getNixDirSize($path);
		}
		return $output;
	}
	
	static public function eraseResource($path)
	{
		
		$setting = Setting::getInstance();
		$path = $setting->path_shared . $path;

		if(!file_exists($path))
			return true;
		
		if(!is_dir($path))
			$path = (dirname($path) != $setting->path_shared)?dirname($path):$path;
		
 		return self::deleteTree($path);		
	}
	
	
	static public function deleteTree($path)
	{
		if (is_dir($path) === true)
		{
			$files = array_diff(scandir($path), array('.', '..'));
	
			foreach ($files as $file)
			{
				self::deleteTree(realpath($path) . '/' . $file);
			}
			
			try {
				return @rmdir($path);
			} catch (Exception $e) {
				Log::logger("Error en rmdir:" . $e->getMessage());
			}
			
		}
	
		else if (is_file($path) === true)
		{
			try {
				return unlink($path);
			} catch (Exception $e) {
				Log::logger("Error en unlink:" . $e->getMessage());
			}
		}
	
		return false;
	}
	
	static public function isProcessAlive($processName)
	{
		exec('ps aux | grep ' . $processName, $output);
		foreach($output as $item)
		{
			if(strpos($item, 'yiic') !== false && strpos($item, $processName) !== false)
				return true;
		}
		return false;
	}
	
	static public function getNixDirSize($path) {
		$size = 0;
		
		$output = exec('du -sk ' . escapeshellarg($path));
		
		$size = trim(str_replace($path, '', $output)) * 1024;

		return $size;
	}
	
	static public function getNixStorageUsed($path) {
		$size = 0;
		$used = 0;
		$output = exec('df ' . escapeshellarg($path));
		
		if(!empty($output))
		{
			$output = preg_replace('!\s+!', ' ', $output);
			$result = explode(' ', $output);
			
			if(isset($result[1]))
				$size = $result[1];
			
			if(isset($result[2]))
				$used = $result[2];
		}
		
		return array('size'=>$size, 'used'=>$used, 'output'=>$output);
	}
	
	static public function getWinDirSize($path) 
	{
		$size = 0;
		$setting = Setting::getInstance();
		$path = $setting->path_shared . $path;
		
		$obj = new COM ( 'scripting.filesystemobject' );
		
		if ( is_object ( $obj ) )
		{
			if(is_file($path))
				$path = dirname($path);
			try {
				$ref = $obj->getfolder( $path );
				$size = $ref->size;				
			} catch (Exception $e) {
				//error opening folder.
			}
			
			$obj = null;
		}		
		return $size;
	}
	
	static public function format_bytes($a_bytes) {
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MB';
		} elseif ($a_bytes < 1099511627776) {
			return round($a_bytes / 1073741824, 2) . ' GB';
		} elseif ($a_bytes < 1125899906842624) {
			return round($a_bytes / 1099511627776, 2) .' TB';
		}
	}
	
	static public function setAnimationClass($text)
	{
		$class = "";
		$size = strlen($text);
		switch($size)
		{
			case ($size > 22 && $size <= 26):
				$class = "slide-text26";
				break;
		
			case ($size > 26 && $size <= 30):
				$class = "slide-text30";
				break;
		
			case ($size > 30 && $size <= 35):
				$class = "slide-text35";
				break;
		
			case ($size > 35 && $size <= 40):
				$class = "slide-text40";
				break;
				
			case ($size > 40):
				$class = "slide-text41";
				break;
			default:
				$class = "";
				break;
		}
		return $class;
	}
	
	static public function sendAnydvdVersionDownloaded($version)
	{
		$settings = Setting::getInstance();
		$settingsWS = new wsSettings();		
		$settingsWS->setAnydvdVersionDownloaded($settings->Id_device,$version);		
	}
	
	static public function sendAnydvdVersionInstalled($version)
	{
		$settings = Setting::getInstance();
		$settingsWS = new wsSettings();
		$settingsWS->setAnydvdVersionInstalled($settings->Id_device,$version);
	}
	
	static public function sendExternalIPAddressToServer()
	{
		PelicanoHelper::getExternalIPAddress();//this olso update the database with the ip
				
		$settings = Setting::getInstance();
		$settingsWS = new wsSettings();
		$clientsettings = new ClientSettingsRequest();
		$clientsettings->Id_device = $settings->Id_device;
		$clientsettings->ip_v4 = $settings->ip_v4;
		$clientsettings->port_v4 = $settings->port_v4;
		$clientsettings->ip_v6 = $settings->ip_v6;
		$clientsettings->port_v6 = $settings->port_v6;
		$clientsettings->ClientError = array();
		
		$errorLogs = ErrorLog::model()->findAllByAttributes(array('was_sent'=>0));
		foreach($errorLogs as $log)
		{
			$clientError = new ClientError();
			$clientError->error_type = $log->error_type;
			$clientError->has_error = $log->has_error;
			$clientError->date = $log->date;
			$clientsettings->ClientError[] = $clientError;
		}
		
		if($settingsWS->setClientSettings($clientsettings))
		{
			foreach($errorLogs as $log)
			{
				$log->was_sent = 1;
				$log->save();
			}
		}
		
	}
	
	static public function sendClientSettings()
	{
		PelicanoHelper::getExternalIPAddress();//this olso update the database with the ip
	
		$settings = Setting::getInstance();
		$settingsWS = new wsSettings();
		$clientsettings = new ClientSettingsRequest();
		$clientsettings->Id_device = $settings->Id_device;
		$clientsettings->ip_v4 = $settings->ip_v4;
		$clientsettings->port_v4 = $settings->port_v4;
		$clientsettings->ip_v6 = $settings->ip_v6;
		$clientsettings->port_v6 = $settings->port_v6;
		$clientsettings->version = $settings->version;
		
		$clientsettings->is_nas_alive = 0;
		if(self::isAccessibleNasFolder())
		{
			$storageUsed = self::getNixStorageUsed($settings->path_shared);		
			$clientsettings->disc_used_space = $storageUsed['used'];
			$clientsettings->disc_total_space = $storageUsed['size'];
			$clientsettings->is_nas_alive = 1;
			if(($clientsettings->disc_used_space/$clientsettings->disc_total_space*100)>$settings->disc_min_size_warning)
				self::saveSystemStatus(3,1);
			else
				self::saveSystemStatus(3,0);
		}
		
		$errorLogs = ErrorLog::model()->findAllByAttributes(array('was_sent'=>0));
		$clientsettings->ClientError = array();
		foreach($errorLogs as $log)
		{
			$clientError = new ClientError();
			$clientError->error_type = $log->error_type;
			$clientError->has_error = $log->has_error;
			$clientError->date = $log->date;
			$clientsettings->ClientError[] = $clientError;
		}
		
		
		if($settingsWS->setClientSettings($clientsettings))
		{
			foreach($errorLogs as $log)
			{
				$log->was_sent = 1;
				$log->save();
			}
		}
	
	}
	
	/**
	 * Verifica si el Player responde para ver si esta vivo
	 * @param integer $idPlayer
	 * @return boolean
	 */
	static public function isPlayerAlive($idPlayer)
	{
		$isAlive = false;
		
		$modelPlayer = Player::model()->findByPk($idPlayer);
		if(isset($modelPlayer))
		{	
			if(isset($modelPlayer->type)&&$modelPlayer->type==1)
			{
				$isAlive = OppoHelper::isPlayerAlive($modelPlayer);
			}
			else 
			{
				$modelDune = DuneHelper::getStateByPlayer($modelPlayer);
				
				if(isset($modelDune))
					$isAlive = true;								
			}
		}	
	
		return $isAlive;
	}
	static public function canStart($sourceType,$idResource)
	{		
		if(!self::isAccessibleNasFolder())	return 0;
		$setting = Setting::getInstance();
		switch ($sourceType)
		{
			case 1:
				$nzbModel = Nzb::model()->findByPk($idResource);
				$folderPath = explode('.',$nzbModel->file_name);
				if(@file_exists($setting->path_shared.'/'.$folderPath[0].'/'.$nzbModel->path)!==false)	return 1;
				break;
			case 2:
				$nzbRippedMovie = RippedMovie::model()->findByPk($idResource);
				if(@file_exists($setting->path_shared.'/'.$nzbRippedMovie->path)!==false)	return 1;
				break;
			case 3:
				$localFolder = LocalFolder::model()->findByPk($idResource);
				if(@file_exists($setting->path_shared.'/'.$localFolder->path)!==false)	return 1;
				break;
			case 4:
				//no se puede validar
				break;
		}
		return 0;		
	}
	
	/**
	 * Verifica si el NAS responde para ver si esta vivo
	 * @return boolean
	 */
	static public function isNASAlive()
	{
		$isAlive = false;
		$modelSetting = Setting::getInstance();
		
		$hostFileServer = trim($modelSetting->host_file_server, '/\\'); //saco todos los slash
		$output = exec('fping ' . escapeshellarg($hostFileServer));
		$output = trim($output);
		
		if(!empty($output))
		{
			if(strpos($output,'alive') !== false)
				$isAlive = true;
		}		
		
		//echo $output."<br>";
		return $isAlive;
	}
	
	/**
	 * Se fija si la carpeta compartida del NAS tiene acceso
	 * @return boolean
	 */
	static public function isAccessibleNasFolder()
	{
		$isAccessible = false;
		if(self::isNASAlive())
		{
			$modelSetting = Setting::getInstance();
			
			$output = exec('df ' . escapeshellarg($modelSetting->path_shared));
			$output = trim($output);
			
			$mountDir = $modelSetting->host_file_server.$modelSetting->host_file_server_path; 
			$mountDir = preg_replace('#/+#','/',$mountDir); //saco slash consecutivos 
			$mountDir = rtrim($mountDir, '/\\'); //saco ultimo slash
			if(!empty($output))
			{
				if(strpos($output,$mountDir) !== false)
					$isAccessible = true;
			}
		}
		self::saveSystemStatus(2,$isAccessible?0:1);
		
		//echo $output. "<br>";
		return $isAccessible;
	}
	
	static public function getExternalIPAddress()
	{
		$setting = Setting::getInstance();
		//$ip = $_SERVER['SERVER_ADDR'];
		$ip = @file_get_contents("http://checkip.dyndns.org/");
		$dyndns = explode(':', $ip);
		if(!empty($dyndns) && count($dyndns)>1)
		{
			$setting->ip_v4 = $dyndns[1];
			$setting->ip_v4 = trim($setting->ip_v4);
			$dyndns = explode(" ", $setting->ip_v4);
			$setting->ip_v4 = strip_tags($dyndns[0]);
			$setting->save();
		}
		if ($ip !== false)
		{
			return $ip;
		}
		return "";
	}
	
	static public function sendPendingNzbStates()
	{
		$setting= Setting::getInstance();
		$model = new Nzb;
		$dataProvider =$model->searchNoSent();
		$data = $dataProvider->data;
		$requests = array();
		
		foreach ($data as $item)
		{
			$request= new NzbStateRequest;
			$request->Id_device = $setting->Id_device;
			$request->Id_nzb =$item->Id;
			$request->Id_state =$item->Id_nzb_state;			
			//date_default_timezone_set('America/Argentina/Buenos_Aires');
			$request->change_state_date = strtotime($item->change_state_date);
			$requests[]=$request;
		}
		$pelicanoCliente = new Pelicano;
		$status = $pelicanoCliente->setNzbState($requests);
		if($status)
		{
			foreach ($data as $item)
			{
				$item->sent = 1;
				$item->save();
			}				
		}		
	}
	static public function UpdatePoints()
	{
		$setting= Setting::getInstance();
		$transaction = CustomerTransaction::model()->findBySql(
			'select * from customer_transaction where Id_customer =:Id_customer ORDER BY Id DESC LIMIT 1',
			array(':Id_customer'=>$setting->getId_customer()));
		$Id_transaction = 0;
		if(isset($transaction)){
			$Id_transaction = $transaction->Id;
		}
		try {
			$pelicanoCliente = new Pelicano;
			$transactions = $pelicanoCliente->getPoints($setting->getId_customer(), $Id_transaction);
			foreach($transactions as $item)
			{
				$transaction = new CustomerTransaction;
				$transaction->attributes = $item->toArray();
				$transaction->save();
			}
			
			$tot_credit = CustomerTransaction::model()->findBySql(
						'select *, sum(points) points from customer_transaction where Id_transaction_type = 2 AND Id_customer =:Id_customer',
			array(':Id_customer'=>$setting->getId_customer()));
			
			$tot_debit = CustomerTransaction::model()->findBySql(
								'select *, sum(points) points from customer_transaction where (Id_transaction_type = 1 ) AND Id_customer =:Id_customer',
			array(':Id_customer'=>$setting->getId_customer()));
						
			
			$customer = $setting->getCustomer();
			$customer->current_points = $tot_credit->points - $tot_debit->points ;
			$customer->save();				
		} catch (Exception $e) {
			//
		}
	}
	
	static public function validateDeviceId($idDevice)
	{	
		$wsSettings = new wsSettings();
		return $wsSettings->validateDeviceId($idDevice);
	}
	
	static public function getCustomerSettings()
	{
		$settings = Setting::getInstance();
		$wsSettings = new wsSettings();
		$response = $wsSettings->getCustomerSettings($settings->Id_device);
	
		if(isset($response))
		{
			$modelCustomer = Customer::model()->findByPk($response->Id_customer);
				
			if(!isset($modelCustomer))
				$modelCustomer = new Customer();
				
			$modelCustomer->Id = $response->Id_customer;
			$modelCustomer->name = $response->name;
			$modelCustomer->last_name = $response->last_name;
			$modelCustomer->address = $response->address;
			$modelCustomer->save();
	
			$settings->Id_customer = $response->Id_customer;
			$settings->Id_reseller = $response->Id_reseller;
			
			if(isset($response->Configuration))
			{
				$settings->setAttributesByArray($response->Configuration);
				
				$modelTmdb = Tmdb::model()->findByPk(1);
				if(!isset($modelTmdb)){
					$modelTmdb = new Tmdb();
					$modelTmdb->Id = 1;
				}
				
				$modelTmdb->api_key = $response->Configuration->tmdb_api_key; 
				$modelTmdb->lang = $response->Configuration->tmdb_lang;
				$modelTmdb->save();
				if(isset($response->Configuration->SabnzbdAccounts))
				{
					SabnzbdConfig::model()->deleteAll();
					foreach($response->Configuration->SabnzbdAccounts as $account)
					{
						$modelSabnzbdConfig = new SabnzbdConfig();
						$modelSabnzbdConfig->setAttributesByArray($account);
						$modelSabnzbdConfig->save();
					}	
				}
				
				if(isset($response->Configuration->Players))
				{
					foreach($response->Configuration->Players as $player)
					{
						$modelPlayer = Player::model()->findByPk($player->Id);
						if(!isset($modelPlayer))
							$modelPlayer = new Player();
						$modelPlayer->setAttributesByArray($player);
						$modelPlayer->Id_setting = 1;
						$modelPlayer->save();
					}
				}
				if(isset($response->Configuration->MarketCategories))
				{
					foreach($response->Configuration->MarketCategories as $category)
					{
						$modelMarketCategory = MarketCategory::model()->findByPk($category->Id);
						if(!isset($modelMarketCategory))
						{
							$modelMarketCategory = new MarketCategory();
						}
						$modelMarketCategory->setAttributesByArray($category);
						$modelMarketCategory->save();
					}
				}
				
			}
			
			$settings->save();
	
			foreach($response->Users as $user)
			{
				try {
	
					$modelDB = User::model()->findByPk($user->username);
					if(isset($modelDB))
					{
						if($user->deleted == 0)
						{
							$modelDB->username = $user->username;
							$modelDB->password = $user->password;
							$modelDB->email = $user->email;
							$modelDB->adult_section = $user->adult_section;
							$modelDB->birth_date = $user->birth_date;
							$modelDB->save();
						}
						else
						{
							$modelDB->delete();
						}
					}
					else
					{
						if($user->deleted == 0)
						{
							$model = new User();
							$model->username = $user->username;
							$model->password = $user->password;
							$model->email = $user->email;
							$model->Id_customer = $response->Id_customer;
							$model->adult_section = $user->adult_section;
							$model->birth_date = $user->birth_date;
							$model->save();
	
							$assDB = Assignments::model()->findByAttributes(array('userid'=>$user->username));
							if(!isset($assDB)){
								$ass = new Assignments();
								$ass->userid = $user->username;
								$ass->data = 's:0:"";';
								$ass->itemname = 'Customer';
								$ass->save();
							}
						}
					}
	
				} catch (Exception $e) {
				}
			}
				
			return $wsSettings->ackCustomerSettings($settings->Id_device);
		}
	
		return false;
	}
	
	static public function heartBeat()
	{
		$settings = Setting::getInstance();
		
		$old_path_shared = $settings->path_shared;
		$old_nas_ip = $settings->host_file_server;
		$old_nas_path = $settings->host_file_server_path;
		$old_nas_user = $settings->host_file_server_user;
		$old_nas_pwd = $settings->host_file_server_passwd;
		$oldSettings = $settings;
				
		RipperHelper::updateRipperSettings();
		RipperHelper::checkForAnyDvdUpdate();
		PelicanoHelper::sincronizeWithServer();
		PelicanoHelper::sendClientSettings();
		PelicanoHelper::getCustomerSettings();
		PelicanoHelper::updateNzbDataFromServer();
		
		$settings = Setting::model()->findByPk(1);
				
		if(
		$old_path_shared != $settings->path_shared ||
		$old_nas_ip != $settings->host_file_server ||
		$old_nas_path != $settings->host_file_server_path ||
		$old_nas_user != $settings->host_file_server_user ||
		$old_nas_pwd != $settings->host_file_server_passwd
		){
			PelicanoHelper::changeFstab();
			if(self::isAccessibleNasFolder())
			{
				$storageUsed = self::getNixStorageUsed($settings->path_shared);
				if(($storageUsed['used']/$storageUsed['size']*100)>$settings->disc_min_size_warning)
					self::saveSystemStatus(3,1);
				else
					self::saveSystemStatus(3,0);
			}
				
		}
		PelicanoHelper::changeSabnzbd($oldSettings);
		return true;
	}
	
	static public function setHeartBeat($Id_device_state, $description = "")
	{
		$settings = Setting::getInstance();
		
		$heartBeat = new HeartBeat();
		$heartBeat->Id_device = $settings->Id_device;
		$heartBeat->Id_device_state = $Id_device_state;
		$heartBeat->description = $description;
		$heartBeat->Id_device_type = 1;
		
		$wsMonitor = new WsMonitor();
		
		return $wsMonitor->setHeartBeat($heartBeat);
	}
	static public function updateNzbDataFromServer()
	{
		$_COMMAND_NAME = "downloadnzbfiles";
		
		if(!self::isProcessAlive($_COMMAND_NAME))
		{
			PelicanoHelper::sendPendingNzbStates();
			try
			{
				$requests = array();
				$setting = Setting::getInstance();
				$pelicanoCliente = new Pelicano;
				if($setting->is_movie_tester)
				{
					$NzbResponseArray = $pelicanoCliente->getTestNzbs($setting->getId_Device());
				}
				else
				{
					$NzbResponseArray = $pelicanoCliente->getNewNzbs($setting->getId_Device());
				}
				foreach ($NzbResponseArray as $item)
				{
					try {
						//grabo el nzb
						$modelNzb = Nzb::model()->findByPk($item->nzb->Id);
						if(!isset($modelNzb))
						{
							$modelNzb = new Nzb();
						}
						$modelNzb->setAttributesByArray($item->nzb);
							
						if(!isset($item->nzb->Id_nzb)) //solo si es Padre
						{
							if($item->nzb->deleted == 1 && $modelNzb->isNewRecord) 
							{
								continue;
							}
								
							$idSeason = null;
			
							//si es serie guardo la serie y la temporada
							if(isset($item->myMovie->myMovieSerieHeader))
							{
								//grabo serie
								$modelMyMovieSerieHeader = MyMovieSerieHeader::model()->findByPk($item->myMovie->myMovieSerieHeader->Id);
								if(!isset($modelMyMovieSerieHeader))
								{
									$modelMyMovieSerieHeader = new MyMovieSerieHeader();
								}
			
								$modelMyMovieSerieHeader->setAttributesByArray($item->myMovie->myMovieSerieHeader);
								$modelMyMovieSerieHeader->save();
			
			
								//grabo temporada
								$modelMyMovieSeason = MyMovieSeason::model()->findByAttributes(array(
										'Id_my_movie_serie_header'=>$item->myMovie->myMovieSerieHeader->Id,
										'season_number'=>$item->myMovie->myMovieSerieHeader->myMovieSeason->season_number,
								));
			
								if(!isset($modelMyMovieSeason))
								{
									$modelMyMovieSeason = new MyMovieSeason();
								}
			
								$modelMyMovieSeason->setAttributesByArray($item->myMovie->myMovieSerieHeader->myMovieSeason);
								$modelMyMovieSeason->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
								$modelMyMovieSeason->save();
								$idSeason = $modelMyMovieSeason->Id;
			
							}
								
							//grabo la info de la caja (my movie)
							$modelMyMovieNzb = MyMovieNzb::model()->findByPk($item->myMovie->Id);
							if(!isset($modelMyMovieNzb))
							{
								$modelMyMovieNzb = new MyMovieNzb();
							}
								
							$modelMyMovieNzb->setAttributesByArray($item->myMovie);
							$modelMyMovieNzb->save();
								
							//grabo el disco
							$idDisc = null;
							$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($item->myMovieDisc->Id);
							if(!isset($modelMyMovieDiscNzb))
							{
								$modelMyMovieDiscNzb = new MyMovieDiscNzb();
							}
							$modelMyMovieDiscNzb->setAttributesByArray($item->myMovieDisc);
							$modelMyMovieDiscNzb->save();
							$idDisc = $modelMyMovieDiscNzb->Id;
								
							//si es serie genero relacion con los episodios y el disco
							//y grabo el id de header en la tabla myMovie
							//en algun caso falló por entrar por acá!!!! no deberia¿?
							if(isset($idSeason) && isset($idDisc))
							{
			
								$modelMyMovieNzb = MyMovieNzb::model()->findByPk($item->myMovie->Id);
								$modelMyMovieNzb->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
								$modelMyMovieNzb->is_serie = 1;
								$modelMyMovieNzb->save();
			
								//grabo episodios
								$episodes = array();
								if(isset($item->myMovie->myMovieSerieHeader->myMovieSeason->Episode))
									$episodes = $item->myMovie->myMovieSerieHeader->myMovieSeason->Episode;
								foreach($episodes as $episode)
								{
									$modelMyMovieEpisode = MyMovieEpisode::model()->findByAttributes(array(
											'Id_my_movie_season'=>$idSeason,
											'episode_number'=>$episode->episode_number,
									));
										
									$idEpisode = null;
									if(!isset($modelMyMovieEpisode))
									{
										$modelMyMovieEpisode = new MyMovieEpisode();
									}
									$modelMyMovieEpisode->setAttributesByArray($episode);
									$modelMyMovieEpisode->Id_my_movie_season = $idSeason;
									$modelMyMovieEpisode->save();
									$idEpisode = $modelMyMovieEpisode->Id;
										
									if(isset($idEpisode))
									{
										$modelDiscEpisodeNzb = DiscEpisodeNzb::model()->findByAttributes(array(
												'Id_my_movie_episode'=>$idEpisode,
												'Id_my_movie_disc_nzb'=>$idDisc,
										));
			
										if(!isset($modelDiscEpisodeNzb))
										{
											$modelDiscEpisodeNzb = new DiscEpisodeNzb();
											$modelDiscEpisodeNzb->Id_my_movie_disc_nzb = $idDisc;
											$modelDiscEpisodeNzb->Id_my_movie_episode = $idEpisode;
											$modelDiscEpisodeNzb->save();
										}
									}
										
								}
							}
								
							//grabo especificaciones (audio y subtitulos)
							PelicanoHelper::saveSpecification($item);
						}
							
						$transaction = $modelNzb->dbConnection->beginTransaction();
						try {
							$modelNzb->Id_my_movie_disc_nzb = (!isset($item->nzb->Id_nzb))?$idDisc:null;
							//date_default_timezone_set('America/Argentina/Buenos_Aires');
							$modelNzb->date = date("Y-m-d H:i:s",time());
							$modelNzb->ready = 0;
			
							$modelNzb->change_state_date = new CDbExpression('NOW()');
							$modelNzb->Id_nzb_state = 1;
							$modelNzb->sent = 0;
								
							$modelNzb->save();
							
							MarketCategoryNzb::model()->deleteAllByAttributes(array('Id_nzb'=>$modelNzb->Id));
							if(isset($item->MarketCategories))
							{
								foreach($item->MarketCategories as $categoryId)
								{
									$modelMarketCategoryNzb = new MarketCategoryNzb();
									$modelMarketCategoryNzb->Id_market_category =$categoryId;
									$modelMarketCategoryNzb->Id_nzb =$modelNzb->Id;
									$modelMarketCategoryNzb->save();
								}
							}
								
			
							$transaction->commit();
								
						} catch (Exception $e) {
							$transaction->rollback();
						}
					} catch (Exception $e) {
					}
				}
			
				$countReady = Nzb::model()->countByAttributes(array('ready'=>0));
				$sys = strtoupper(PHP_OS);
			
				if($countReady>0&&!self::isProcessAlive($_COMMAND_NAME))
				{
					if(substr($sys,0,3) == "WIN")
					{
						$WshShell = new COM('WScript.Shell');
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/downloadNzbFiles', 0, false);
					}
					else
					{
						exec(dirname(__FILE__).'/../commands/shell/downloadNzbFiles >/dev/null&');
					}
				}
				
			}
			catch (Exception $e) {
			}
		}
	}
	public static function prepareNZBtoMovieTester()
	{
		$criteria = new CDbCriteria();		
		$criteria->addCondition('t.Id_nzb is not null');		
		$arrayNbz = Nzb::model()->findAll($criteria);
		foreach ($arrayNbz as $child)
		{
			//tomo el padre
			$nzbModel = $child->nzb;
			//seteo los valores de meta data al hijo y lo desrelaciono con el padre.
			$child->Id_my_movie_disc_nzb =$nzbModel->Id_my_movie_disc_nzb; 
			$child->Id_TMDB_data =$nzbModel->Id_TMDB_data; 
			$child->Id_nzb =new CDbExpression('NULL');
			$child->save();				
		}		
	}	
	public static function setSpeedlimit($speed)
	{
		$setting = Setting::getInstance();
		$url =  $setting->sabnzb_api_url."mode=config&name=speedlimit&value=".$speed."&apikey=".$setting->sabnzb_api_key;		
		$response = @file_get_contents($url);		
	}
	public static function cancelDownload($idNzb)
	{
		$nzb = Nzb::model()->findByPk($idNzb);
		if(isset($nzb)&&isset($nzb->sabnzbd_id)&&!$nzb->ready_to_play&&($nzb->downloading||$nzb->downloaded))
		{
			$setting = Setting::getInstance();
			try
			{
				$setting = Setting::getInstance();

				$url =  $setting->sabnzb_api_url."mode=queue&name=delete&del_files=1&value=".$nzb->sabnzbd_id."&apikey=".$setting->sabnzb_api_key;
				
				$response = @file_get_contents($url);
				$downloaded = $nzb->downloaded; 
				$nzb->downloading = 0;
				$nzb->downloaded = 0;
				$nzb->save();
				if($downloaded)
				{
					$filename = explode('.', $nzb->file_name);
					$path =$filename[0];
					self::eraseResource($path);						
				}
			}
			catch (Exception $e)
			{
			}
		}
	}
	public static function changeSabnzbd($oldSetting)
	{
		$setting = Setting::model()->findByPk(1);
		try
		{
// 			$url =  $setting->sabnzb_api_url."mode=config&name=set_apikey&apikey=EXISTINGAPIKEY";
// 			$jsonData = @file_get_contents($url);
			//complete_dir
			$url =  $setting->sabnzb_api_url."mode=get_config&output=json&section=misc&apikey=".$setting->sabnzb_api_key;
			$jsonData = @file_get_contents($url);
			$misc = json_decode($jsonData);
				
			if(!isset($misc->misc)||$misc->misc->complete_dir!=$setting->path_shared)
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=complete_dir&value=".$setting->path_shared."&apikey=".$setting->sabnzb_api_key;
				$jsonData = @file_get_contents($url);				
			}
			if(!isset($misc->misc)||$misc->misc->dirscan_dir!=dirname(__FILE__).'/../../'.$setting->path_ready)
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=dirscan_dir&value=".dirname(__FILE__).'/../../'.$setting->path_ready."&apikey=".$setting->sabnzb_api_key;
				$jsonData = @file_get_contents($url);				
			}
			if(!isset($misc->misc)||$misc->misc->script_dir!=dirname(__FILE__)."/../commands/shell/")
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=script_dir&value=".dirname(__FILE__).'/../commands/shell/&apikey='.$setting->sabnzb_api_key;
				$jsonData = @file_get_contents($url);
			}
			if(!isset($misc->misc)||$misc->misc->permissions!="755")
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=permissions&value=755&apikey=".$setting->sabnzb_api_key;			
				$jsonData = @file_get_contents($url);
			}
			if(!isset($misc->misc)||$misc->misc->password_file!=$setting->sabnzb_pwd_file_path)
			{					
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=password_file&value=".$setting->sabnzb_pwd_file_path."&apikey=".$setting->sabnzb_api_key;						
				$jsonData = @file_get_contents($url);
			}
			$url =  $setting->sabnzb_api_url."mode=get_config&output=json&section=categories&keyword=*&apikey=".$setting->sabnzb_api_key;
			$jsonData = @file_get_contents($url);
			$categorie = json_decode($jsonData);
			if(!isset($categorie->categories)||!is_array($categorie->categories)||empty($categorie->categories)||$categorie->categories[0]->pp!=3||$categorie->categories[0]->script!="updateStateMovies")
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=categories&keyword=*&script=updateStateMovies&priority=0&pp=3&apikey=".$setting->sabnzb_api_key;
				$jsonData = @file_get_contents($url);				
			}				
			if(!isset($misc->misc)||$misc->misc->pause_on_pwrar!="0")
			{
				$url =  $setting->sabnzb_api_url."mode=set_config&output=json&section=misc&keyword=pause_on_pwrar&value=0&apikey=".$setting->sabnzb_api_key;			
				$jsonData = @file_get_contents($url);
			}

			$sabnzbdConfigs = SabnzbdConfig::model()->findAll();
			
			$url =  $setting->sabnzb_api_url."mode=get_config&output=json&section=servers&apikey=".$setting->sabnzb_api_key;
			$jsonData = @file_get_contents($url);
			$serverResponse = json_decode($jsonData);
			$save = true;
			foreach ($sabnzbdConfigs as $sabnzbdConfig)
			{
				if(isset($serverResponse->config->servers) && is_array($serverResponse->config->servers))
				{
					foreach ($serverResponse->config->servers as $server)
					{
						if($server->name==$sabnzbdConfig->name&&
						$sabnzbdConfig->username==$server->username&&
						$sabnzbdConfig->enable==$server->enable&&
						$sabnzbdConfig->name==$server->name&&
						$sabnzbdConfig->fill_server==$server->fillserver&&
						$sabnzbdConfig->connections==$server->connections&&
						$sabnzbdConfig->ssl==$server->ssl&&
						$sabnzbdConfig->host==$server->host&&
						$sabnzbdConfig->timeout==$server->timeout&&
						$sabnzbdConfig->optional==$server->optional&&
						$sabnzbdConfig->port==$server->port&&
						$sabnzbdConfig->retention==$server->retention)
						{
							$save= false;
						}						
					}
				}
				if($save)
				{
					$url =
					$setting->sabnzb_api_url."mode=set_config&output=json&section=servers&keyword=".$sabnzbdConfig->server_name.
					"&username=".$sabnzbdConfig->username.
					"&enable=".$sabnzbdConfig->enable.
					"&name=".$sabnzbdConfig->name.
					"&fillserver=".$sabnzbdConfig->fill_server.
					"&connections=".$sabnzbdConfig->connections.
					"&ssl=".$sabnzbdConfig->ssl.
					"&host=".$sabnzbdConfig->host.
					"&timeout=".$sabnzbdConfig->timeout.
					"&password=".$sabnzbdConfig->password.
					"&optional=".$sabnzbdConfig->optional.
					"&port=".$sabnzbdConfig->port.
					"&retention=".$sabnzbdConfig->retention.
					"&apikey=".$setting->sabnzb_api_key;
					$jsonData = @file_get_contents($url);						
				}
			}			
			
		}
		catch (Exception $e)
		{
		}		
	}
	public static function changeFstab()
	{
		$setting = Setting::getInstance();
		try
		{
			//$1 spect
			//$2 file
			//$3 username
			//$4 password
					
			$spect =  $setting->host_file_server.$setting->host_file_server_path;
			$spect = preg_replace('#/+#','/',$spect); //saco slash consecutivos					
			$spect ="/".$spect;
			if(strpos($spect,'//')!=0||strpos($spect,'//')===false)
			{
				$spect ="/".$spect;
			}
			$file =  $setting->path_shared;
			$file = preg_replace('#/+#','/',$file); //saco slash consecutivos					
			$username =  $setting->host_file_server_user;
			$password =  $setting->host_file_server_passwd;
			$params = $spect.' '.$file.' '.$username.' '.$password;
			$mjPasswd = $setting->michael_jackson;			
			exec('sudo umount '.$file,$output,$return);
			exec('sudo '.dirname(__FILE__).'/../commands/shell/fstabEditor.sh '.$params,$output,$return);
			exec('sudo mount -a',$output,$return);
		}
		catch (Exception $e)
		{
		}
	}
	
	public static function startDownload($idNzb)
	{
		$nzb = Nzb::model()->findByPk($idNzb);
		if(isset($nzb)&&!$nzb->downloading)
		{
			$setting = Setting::getInstance();
			try
			{
				$fileName = explode('.',$nzb->file_name);
				$fileName = $fileName[0];
				//antes de iniciar la descarga elemino (si es que existen) las carpetas que pudieron haber quedado de antiguas descargas. 
				self::eraseResource($fileName);
				
				$from = dirname(__FILE__)."/../../".$setting->path_pending."/";
				$to =  dirname(__FILE__)."/../../".$setting->path_ready."/";
				$params = $from.' '.$to.' '.$fileName.' '.$setting->sabnzb_pwd_file_path;
				exec('sudo '.dirname(__FILE__).'/../commands/shell/startDownload.sh '.$params,$output,$return);
				$nzb->has_error = 0;
				$nzb->downloaded = 0;
				$nzb->downloading = 1;
				$nzb->sabnzbd_id = new CDbExpression('NULL');
				$nzb->Id_nzb_state = 2;
				$nzb->change_state_date = new CDbExpression('NOW()');
				$nzb->sent = 0;
				$nzb->save();						
			}
			catch (Exception $e)
			{
			}
		}
	}	
	public static function downloadFirst($idNzb)
	{
		$nzb = Nzb::model()->findByPk($idNzb);
		if(isset($nzb->sabnzbd_id))
		{
			$setting = Setting::getInstance();
			$url =  $setting->sabnzb_api_url."mode=switch&value=".$nzb->sabnzbd_id."&value2=0&apikey=".$setting->sabnzb_api_key;
			@file_get_contents($url);				
		}
	}
	public static function restartDownload($idNzb)
	{
		$nzb = Nzb::model()->findByPk($idNzb);
		if(isset($nzb))
		{
			$setting = Setting::getInstance();
			try
			{
				//si fue descargado y no tuvo error, no reintento
				if( $nzb->downloading == 0 && $nzb->downloaded==1 && $nzb->has_error == 0)	return;
				
				$fileName = explode('.',$nzb->file_name);
				$fileName = $fileName[0];
				//antes de iniciar la descarga elemino (si es que existen) las carpetas que pudieron haber quedado de antiguas descargas.
				self::eraseResource($fileName);
	
				$from = dirname(__FILE__)."/../../".$setting->path_pending."/";
				$to =  dirname(__FILE__)."/../../".$setting->path_ready."/";
				$params = $from.' '.$to.' '.$fileName.' '.$setting->sabnzb_pwd_file_path;
				exec('sudo '.dirname(__FILE__).'/../commands/shell/startDownload.sh '.$params,$output,$return);
				$nzb->has_error = 0;
				$nzb->downloaded = 0;
				$nzb->downloading = 1;
				$nzb->ready_to_play = 0;
				$nzb->sabnzbd_id = new CDbExpression('NULL');
				$nzb->Id_nzb_state = 2;
				$nzb->change_state_date = new CDbExpression('NOW()');
				$nzb->sent = 0;
				$nzb->save();
			}
			catch (Exception $e)
			{
			}
		}
	}
	
	public static function saveSpecification($item)
	{
		//grabo los audiotrack del nzb
		if(isset($item->myMovie->AudioTrack))
		{
			foreach($item->myMovie->AudioTrack as $audio)
			{
				$modelAudio = AudioTrack::model()->findByAttributes(array(
																		'language'=>$audio->language,
																		'type'=>$audio->type,
																		'chanel'=>$audio->chanel,
				));
				if(!isset($modelAudio))
				{
					$modelAudio = new AudioTrack();
					$modelAudio->language = $audio->language;
					$modelAudio->type = $audio->type;
					$modelAudio->chanel = $audio->chanel;
					$modelAudio->save();
				}
					
				$myMovieNzbAudioTrack = MyMovieNzbAudioTrack::model()->findByAttributes(array(
																					'Id_my_movie_nzb'=>$item->myMovie->Id,
																					'Id_audio_track'=>$modelAudio->Id,
				));
				if(!isset($myMovieNzbAudioTrack))
				{
					$myMovieNzbAudioTrack = new MyMovieNzbAudioTrack();
					$myMovieNzbAudioTrack->Id_audio_track = $modelAudio->Id;
					$myMovieNzbAudioTrack->Id_my_movie_nzb = $item->myMovie->Id;
					$myMovieNzbAudioTrack->save();
				}
					
			}
		}
			
		//grabo los subtitulos del nzb
		if(isset($item->myMovie->Subtitle))
		{
			foreach($item->myMovie->Subtitle as $sub)
			{
				$modelSub = Subtitle::model()->findByAttributes(array(
																	'language'=>$sub->language,																		
				));
				if(!isset($modelSub))
				{
					$modelSub = new Subtitle();
					$modelSub->language = $sub->language;
					$modelSub->save();
				}
					
				$myMovieNzbSubtitle = MyMovieNzbSubtitle::model()->findByAttributes(array(
																'Id_my_movie_nzb'=>$item->myMovie->Id,
																'Id_subtitle'=>$modelSub->Id,
				));
				if(!isset($myMovieNzbSubtitle))
				{
					$myMovieNzbSubtitle = new MyMovieNzbSubtitle();
					$myMovieNzbSubtitle->Id_subtitle = $modelSub->Id;
					$myMovieNzbSubtitle->Id_my_movie_nzb = $item->myMovie->Id;
					$myMovieNzbSubtitle->save();
				}
					
			}
		}
	
		//grabo las personas del nzb
		if(isset($item->myMovie->Person))
		{
			foreach($item->myMovie->Person as $person)
			{
				$modelPerson = Person::model()->findByAttributes(array(
														'name'=>$person->name,
														'type'=>$person->type,
														'role'=>$person->role,
				));
				if(!isset($modelPerson))
				{
					$modelPerson = new Person();
					$modelPerson->name = $person->name;
					$modelPerson->type = $person->type;
					$modelPerson->role = $person->role;
					$modelPerson->photo_original = $person->photo_original;
					$modelPerson->save();
				}
					
				$myMovieNzbPerson = MyMovieNzbPerson::model()->findByAttributes(array(
																		'Id_my_movie_nzb'=>$item->myMovie->Id,
																		'Id_person'=>$modelPerson->Id,
				));
				if(!isset($myMovieNzbPerson))
				{
					$myMovieNzbPerson = new MyMovieNzbPerson();
					$myMovieNzbPerson->Id_person = $modelPerson->Id;
					$myMovieNzbPerson->Id_my_movie_nzb = $item->myMovie->Id;
					$myMovieNzbPerson->save();
				}
					
			}
		}
	}
	static public function getSerie($modelMyMovieDisc)
	{
		if(isset($modelMyMovieDisc->myMovie->myMovieSerieHeader))
		{
			$modelSerieHeader = new MyMovieSerieHeaderSOAP();
			$modelSerieHeader->setAttributes($modelMyMovieDisc->myMovie->myMovieSerieHeader);
				
			$discEpisodes = DiscEpisode::model()->findAllByAttributes(array('Id_my_movie_disc'=>$modelMyMovieDisc->Id));
			$setSeason = true;
			foreach($discEpisodes as $item)
			{
				if($setSeason)
				{
					$modelSeason = MyMovieSeason::model()->findByPk($item->myMovieEpisode->Id_my_movie_season);
					$modelSerieHeader->myMovieSeason->setAttributes($modelSeason);
					$setSeason = false;
				}
	
				$episodeSOAP = new MyMovieEpisodeSOAP();
				$episodeSOAP->setAttributes($item->myMovieEpisode);
				$modelSerieHeader->myMovieSeason->Episode[] = $episodeSOAP;
			}
				
			return $modelSerieHeader;
		}
	
		return null;
	}
	
	public static function sincronizeWithServer()
	{
		$requests = array();
		$pelicanoCliente = new Pelicano;
	
		$setting = Setting::getInstance();
		$idDevice = $setting->getId_Device();
	
		if(isset($idDevice))
		{
			$rippedMovies = RippedMovie::model()->findAllByAttributes(array('was_sent'=>0));
			foreach($rippedMovies as $item)
			{
				$request= new RippedRequest;
	
				$request->Id_device = $idDevice;
				$request->ripped_date = $item->creation_date;
				$request->myMovie->setAttributes($item->myMovieDisc->myMovie);
	
				$request->myMovie->myMovieSerieHeader = PelicanoHelper::getSerie($item->myMovieDisc);
	
				//set audio track
				$relAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relAudioTracks as $relAudioTrack)
				{
					$audioTrackSOAP = new MyMovieAudioTrackSOAP();
					$audioTrackSOAP->setAttributes($relAudioTrack->audioTrack);
					$request->myMovie->AudioTrack[] = $audioTrackSOAP;
				}
	
				//set subtitle
				$relSubtitles = MyMovieSubtitle::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relSubtitles as $relSubtitle)
				{
					$subtitleSOAP = new MyMovieSubtitleSOAP();
					$subtitleSOAP->setAttributes($relSubtitle->subtitle);
					$request->myMovie->Subtitle[] = $subtitleSOAP;
				}
	
				//set person
				$relPersons = MyMoviePerson::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relPersons as $relPerson)
				{
					$personSOAP = new MyMoviePersonSOAP();
					$personSOAP->setAttributes($relPerson->person);
					$request->myMovie->Person[] = $personSOAP;
				}
	
				$request->myMovieDisc->setAttributes($item->myMovieDisc);
	
				$requests[]=$request;
			}
				
	
			if( count($requests) > 0 && $pelicanoCliente->setRipped($requests))
			{
				$RippedResponseArray = $pelicanoCliente->getRipped($idDevice);
				foreach($RippedResponseArray as $item)
				{
					$model = RippedMovie::model()->findByAttributes(array('Id_my_movie_disc'=>$item->Id_my_movie_disc));
					if(isset($model))
					{
						$model->was_sent = 1;
						$model->save();
					}
						
				}
			}
		}
	}
	
}