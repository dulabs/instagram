<?php
namespace Instagram;

class OAuthManager
{
    /**
     * The API OAuth URL.
     */
    const API_OAUTH_URL = 'https://api.instagram.com/oauth/authorize';

    /**
     * The OAuth token URL.
     */
    const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';

    /**
     * The OAuth Params
     * @var array
     */
   	 static $params;

   	 const RESPONSE_TYPE_CODE = 'code';

   	 const RESPONSE_TYPE_TOKEN = 'token';


    /**
     * Whether a signed header should be used.
     *
     * @var bool
     */
    private static $_signedheader = false;

    /**
     * Available scopes.
     *
     * @var string[]
     */
    private static $_scopes = array('basic','public_content','follower_list','likes','comments','relationships');



	public static function setConfig($config)
	{
		self::set_api_key($config['api_key']);
		self::set_api_secret($config['api_secret']);
		self::set_callback_url($config['callback_url']);
		self::set_response_type($config['response_type']);

		return new static;
	}

	public static function set_api_key($api_key)
	{
		static::$params['client_id'] = $api_key;

		return new static;
	}

	public static function set_api_secret($api_secret)
	{
		static::$params['client_secret'] = $api_secret;

		return new static;
	}

	public static function set_callback_url($url)
	{
		static::$params['redirect_uri'] = $url;

		return new static;
	}

	public static function set_response_type($type)
	{
		static::$params['response_type'] = $type;

		return new static;
	}

	public static function set_code($code)
	{
		static::$params['code'] = $code;

		return new static;
	}

	public static function login($scopes = array('basic'))
	{
		$str_query = http_build_query(self::$params);
	    if (is_array($scopes) && count(array_intersect($scopes, self::$_scopes)) === count($scopes)) {
            return self::API_OAUTH_URL .'?'.$str_query.'&scope=' . implode('+',$scopes);
        }
	}

	public static function getAccessToken()
	{
		$response_type = static::$params['response_type'];
		if($response_type == static::RESPONSE_TYPE_TOKEN)
		{
			return $_GET['access_token'];
		}else{

			$code = $_GET['code'];
			static::$params['grant_type'] = 'authorization_code';
			static::$params['code'] = $code;
			$response = static::call(static::API_OAUTH_TOKEN_URL);
			
			if(empty($response)) return false;

			$result = json_decode($response);

			if(isset($result->access_token)){
				return $result->access_token;
			}

			if(isset($result->error_message))
			{
				return $result->error_message;
			}

			return false;
		}
	}

	public static function call($url)
	{
		$params = static::$params;
		$paramString = http_build_query($params);
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));       
	
        $result = curl_exec($ch);

        return $result;
	}
}