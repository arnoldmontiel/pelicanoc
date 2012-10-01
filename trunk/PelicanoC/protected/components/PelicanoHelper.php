<?php
require_once(dirname(__FILE__) . "/../stubs/Pelicano.php");
class PelicanoHelper
{
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
		$dataProvider =$nzbMovieState->search();
		$data = $dataProvider->data;
		$requests = array();
		$tv_requests = array();
		
		foreach ($data as $item)
		{
			if(isset($item->nzb->Id_imdbdata))
			{
				$request= new MovieStateRequest;
				$request->id_customer = $item->Id_customer;
				$request->id_movie =$item->Id_nzb;
				$request->id_state =$item->Id_movie_state;
				$request->date = strtotime($item->date);
				$requests[]=$request;
			}
			else if(isset($item->nzb->Id_imdbdata_tv))
			{
				$request= new SerieStateRequest;
				$request->id_customer = $item->Id_customer;
				$request->id_serie_nzb =$item->Id_nzb;
				$request->id_state =$item->Id_movie_state;
				$request->date = strtotime($item->date);
				$request->id_imdbdata_tv=null;
				$tv_requests[]=$request;
				
			}
		}
		$pelicanoCliente = new Pelicano;
		$status = $pelicanoCliente->setMovieState($requests);
		$status = $status && $pelicanoCliente->setSerieState($tv_requests);
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