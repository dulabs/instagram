<?php
namespace Dulabs\Instagram;

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
   	 private $params;

   	 const RESPONSE_TYPE_CODE = 'code';

   	 const RESPONSE_TYPE_TOKEN = 'token';


    /**
     * Whether a signed header should be used.
     *
     * @var bool
     */
    private $_signedheader = false;

    /**
     * Available scopes.
     *
     * @var string[]
     */
    private $_scopes = array('basic','public_content','follower_list','likes','comments','relationships');



	public function setConfig($config)
	{
		$this->set_api_key($config['api_key']);
		$this->set_api_secret($config['api_secret']);
		$this->set_callback_url($config['callback_url']);
		$this->set_response_type($config['response_type']);

		return $this;
	}

	public function set_api_key($api_key)
	{
		$this->params['client_id'] = $api_key;

		return $this;
	}

	public function set_api_secret($api_secret)
	{
		$this->params['client_secret'] = $api_secret;

		return $this;
	}

	public function set_callback_url($url)
	{
		$this->params['redirect_uri'] = $url;

		return $this;
	}

	public function set_response_type($type)
	{
		$this->params['response_type'] = $type;

		return $this;
	}

	public function set_code($code)
	{
		$this->params['code'] = $code;

		return $this;
	}

	public function login($scopes = array('basic'))
	{
		$str_query = http_build_query($this->params);
	    if (is_array($scopes) && count(array_intersect($scopes, $this->_scopes)) === count($scopes)) {
            return self::API_OAUTH_URL .'?'.$str_query.'&scope=' . implode('+',$scopes);
        }
	}

	public function getAccessToken()
	{
		$response_type = $this->params['response_type'];
		if($response_type == self::RESPONSE_TYPE_TOKEN)
		{
			return $_GET['access_token'];
		}else{

			$code = $_GET['code'];
			$this->params['grant_type'] = 'authorization_code';
			$this->params['code'] = $code;
			$response = $this->call(self::API_OAUTH_TOKEN_URL);
			
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

	public function call($url)
	{
		$params = $this->params;
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