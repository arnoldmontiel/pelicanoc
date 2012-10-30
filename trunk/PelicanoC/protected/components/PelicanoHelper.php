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
		$ip = @file_get_contents("http://ip-addr.es/");
		$setting->ip_v4 = $ip;
		$setting->save();
		if ($ip !== false)
		{
			return $ip;
		}
		return "";
	}
	
	static public function sendPendingNzbStates()
	{
		$nzbMovieState = new NzbMovieState;
		$nzbMovieState->sent = 0;
		$dataProvider =$nzbMovieState->searchReady();
		$data = $dataProvider->data;
		$requests = array();
		
		foreach ($data as $item)
		{
			$request= new MovieStateRequest;
			$request->Id_device = $item->Id_device;
			$request->Id_nzb =$item->Id_nzb;
			$request->Id_state =$item->Id_movie_state;
			$request->date = strtotime($item->date);
			$requests[]=$request;
		}
		$pelicanoCliente = new Pelicano;
		$status = $pelicanoCliente->setMovieState($requests);
		if($status)
		{
			foreach ($data as $item)
			{
				$item->sent = 1;
				$item->save();
			}				
		}		
	}
	static public function sendPendingImdbdataTvStates()
	{
		$state = new ImdbdataTvMovieState;
		$state->sent = 0;
		$dataProvider =$state->search();
		$data = $dataProvider->data;
		$requests = array();
		foreach ($data as $item)
		{
			//we send the new state to the server
			$request= new SerieStateRequest;
			$request->id_customer = $item->Id_customer;
			$request->id_serie_nzb =null;
			$request->id_state =$item->Id_movie_state;
			$request->date = strtotime($item->date);
			$request->id_imdbdata_tv =$item->Id_imdbdata_tv;
			$requests[]=$request;
		}
		$pelicanoCliente = new Pelicano;
		$status = $pelicanoCliente->setSerieState($requests);
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
		
}