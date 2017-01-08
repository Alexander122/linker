<?php

namespace core\Social;

class VkApi
{
	public static $url = 'https://api.vk.com/method/';
	
	public static function send($method, $params = [])
	{
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_POST => TRUE,				// this is a POST request
			CURLOPT_RETURNTRANSFER => TRUE, 	// return the response variable
			CURLOPT_SSL_VERIFYPEER => FALSE,	// do not check https certificates
			CURLOPT_SSL_VERIFYHOST => FALSE,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_URL => self::$url . $method,
		]);
		$result = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($result);
	}
}
