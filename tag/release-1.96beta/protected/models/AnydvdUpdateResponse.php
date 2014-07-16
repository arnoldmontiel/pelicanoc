<?php

class AnydvdUpdateResponse 
{
	/**
	* @var string version
	* @soap
	*/
	public $version;
	
	/**
	* @var string url
	* @soap
	*/
	public $url;
	
	/**
	* @var string Id_customer
	* @soap
	*/
	public $file_name;
	/**
	 * 0 - nothing
	 * 1 - download
	 * 2 - install
	* @var int action
	* @soap
	*/
	public $action;
	
}