<?php
require_once(dirname(__FILE__) . "/../stubs/Pelicano.php");
require_once(dirname(__FILE__) . "/../stubs/wsSettings.php");
class PelicanoHelper
{
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
		
		$settingsWS->setClientSettings($clientsettings);
		
	}
	
	static public function getExternalIPAddress()
	{
		$setting = Setting::getInstance();
		//$ip = $_SERVER['SERVER_ADDR'];
		$ip = @file_get_contents("http://checkip.dyndns.org/");
		$dyndns = explode(':', $ip);
		if($dyndns)
		{
			$setting->ip_v4 = $dyndns[1];
			$setting->ip_v4 = trim($setting->ip_v4);
			$setting->ip_v4 = substr($setting->ip_v4, 0,13);
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
	public function updateNzbDataFromServer()
	{
	
		$_COMMAND_NAME = "downloadNzbFiles";
	
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
	
		if(isset($modelCommandStatus))
		{
			if(!$modelCommandStatus->busy)
			{
				//PelicanoHelper::sendPendingNzbStates();
				try
				{
						
					$modelCommandStatus->setBusy(true);
					$requests = array();
					$setting = Setting::getInstance();
					$pelicanoCliente = new Pelicano;
					$NzbResponseArray = $pelicanoCliente->getNewNzbs($setting->getId_Device());
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
							if($item->nzb->deleted)
							{
								if(!$modelNzb->isNewRecord)
								{
									if(!$modelNzb->downloading||!$modelNzb->downloaded)
									{
										$modelNzb->Id_nzb_state = 6;
										$modelNzb->sent = 0;
										$modelNzb->change_state_date = new CDbExpression('NOW()');
										$modelNzb->save();
	
										continue;
									}
								}
								else
								{
									$modelNzb->Id_nzb_state = 6;
									$modelNzb->sent = 0;
									$modelNzb->change_state_date = new CDbExpression('NOW()');
									$modelNzb->save();
										
									continue;
								}
	
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
							if(isset($idSeason) && isset($idDisc))
							{
									
								$modelMyMovieNzb = MyMovieNzb::model()->findByPk($item->myMovie->Id);
								$modelMyMovieNzb->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
								$modelMyMovieNzb->is_serie = 1;
								$modelMyMovieNzb->save();
									
								//grabo episodios
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
							$this->saveSpecification($item);
								
							$transaction = $modelNzb->dbConnection->beginTransaction();
							try {
								$modelNzb->Id_my_movie_disc_nzb = $idDisc;
								$modelNzb->date = date("Y-m-d H:i:s",time());
								$modelNzb->ready = 0;
	
								$modelNzb->change_state_date = new CDbExpression('NOW()');
								$modelNzb->Id_nzb_state = 1;
								$modelNzb->sent = 0;
									
								$modelNzb->save();
	
								$transaction->commit();
									
							} catch (Exception $e) {
								$transaction->rollback();
								$modelCommandStatus->setBusy(false);
							}
						} catch (Exception $e) {
							$modelCommandStatus->setBusy(false);
						}
					}
						
					$countReady = Nzb::model()->countByAttributes(array('ready'=>0));
					$sys = strtoupper(PHP_OS);
						
					if($countReady>0)
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
					else
					{
						$modelCommandStatus->setBusy(false);
					}
				}
				catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
	
			}
		}
	
	}
	
}