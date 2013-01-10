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
}