<?php

/**
 *
 * @property string $drive_letter
 * @property string $temp_folder_ripping
 * @property string $final_folder_ripping
 */
class SettingsRipperResponse 
{
	/**
	* @var string drive_letter
	* @soap
	*/
	public $drive_letter;
	
	/**
	* @var string temp_folder_ripping
	* @soap
	*/
	public $temp_folder_ripping;
	
	/**
	* @var string final_folder_ripping
	* @soap
	*/
	public $final_folder_ripping;
	/**
	* @var time time_from_reboot
	* @soap
	*/
	public $time_from_reboot;
	/**
	* @var time time_to_reboot
	* @soap
	*/
	public $time_to_reboot;
	/**
	* @var string mymovies_username
	* @soap
	*/
	public $mymovies_username;	
	/**
	* @var string mymovies_password
	* @soap
	*/
	public $mymovies_password;
	
	/**
	* @var string id_device
	* @soap
	*/
	public $id_device;
}