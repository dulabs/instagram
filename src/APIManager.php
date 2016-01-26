<?php
namespace Instagram;

class APIManager
{

    /**
     * The API base URL.
     */
    const API_URL = 'https://api.instagram.com/v1/';

    /**
     * The user access token.
     *
     * @var string
     */
    static $_accesstoken;

    static $accesstoken;
    /**
     * Whether a signed header should be used.
     *
     * @var bool
     */
    static $_signedheader = false;

    /**
     * Available actions.
     *
     * @var string[]
     */
    private $_actions = array('follow', 'unfollow', 'block', 'unblock', 'approve', 'deny');

    /**
     * Rate limit.
     *
     * @var int
     */
    static $_xRateLimitRemaining;

    /**
     * The Instagram API Secret
     *
     * @var string
     */
    static $_apisecret;

    /**
     * The call operator.
     *
     * @param string $function API resource path
     * @param bool $auth Whether the function requires an access token
     * @param array $params Additional request parameters
     * @param string $method Request type GET|POST
     *
     * @return mixed
     *
     * @throws \MetzWeb\Instagram\InstagramException
     */
    public static function _call($endpoint, $params = null, $method = 'GET')
    {

            // if the call needs an authenticated user
        if (!isset(static::$_accesstoken)) {
            throw new InstagramException("Error: _call() | $function - This method requires an authenticated users access token.");
        }

        $authMethod = '?access_token=' . static::getAccessToken();


        $paramString = null;

        if (isset($params) && is_array($params)) {
            $paramString = '&' . http_build_query($params);
        }

        $apiCall = static::API_URL . $endpoint . $authMethod . (('GET' === $method) ? $paramString : null);

        // we want JSON
        $headerData = array('Accept: application/json');

        if (static::$_signedheader) {
            $apiCall .= (strstr($apiCall, '?') ? '&' : '?') . 'sig=' . static::_signHeader($function, $authMethod, $params);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCall);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, count($params));
                curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $jsonData = curl_exec($ch);
    
        // split header from JSON data
        // and assign each to a variable
        list($headerContent, $jsonData) = explode("\r\n\r\n", $jsonData, 2);

        // convert header content into an array
        $headers = static::processHeaders($headerContent);

        // get the 'X-Ratelimit-Remaining' header value
        static::$_xRateLimitRemaining = $headers['X-Ratelimit-Remaining'];

        if (!$jsonData) {
            throw new InstagramException('Error: _call() - cURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($jsonData);
    }

        /**
     * Sign header by using endpoint, parameters and the API secret.
     *
     * @param string
     * @param string
     * @param array
     *
     * @return string The signature
     */
    private static function _signHeader($endpoint, $authMethod, $params)
    {
        if (!is_array($params)) {
            $params = array();
        }
        if ($authMethod) {
            list($key, $value) = explode('=', substr($authMethod, 1), 2);
            $params[$key] = $value;
        }
        $baseString = '/' . $endpoint;
        ksort($params);
        foreach ($params as $key => $value) {
            $baseString .= '|' . $key . '=' . $value;
        }
        $signature = hash_hmac('sha256', $baseString, static::$_apisecret, false);

        return $signature;
    }

    /**
     * Read and process response header content.
     *
     * @param array
     *
     * @return array
     */
    private static function processHeaders($headerContent)
    {
        $headers = array();

        foreach (explode("\r\n", $headerContent) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
                continue;
            }

            list($key, $value) = explode(':', $line);
            $headers[$key] = $value;
        }

        return $headers;
    }

    /**
     * Access Token Setter.
     *
     * @param object|string $data
     *
     * @return void
     */
    public static function setAccessToken($data)
    {
        $token = is_object($data) ? $data->access_token : $data;

        static::$_accesstoken = $token;
    }

    /**
     * Access Token Getter.
     *
     * @return string
     */
    public static function getAccessToken()
    {
        return static::$_accesstoken;
    }

    /**
     * API Secret Setter.
     *
     * @param string $data
     *
     * @return void
     */
    public static function set_api_secret($data)
    {
        static::$_apisecret = $data;
    }

    /**
     * API Secret Getter.
     *
     * @return string
     */
    public static function get_api_secret()
    {
        return static::$_apisecret;
    }

        // we've writen this code where we need
    public static function load($classname) {
        $filename = __DIR__.str_replace("Instagram\API\\","/API/",$classname) .".php";
        if(file_exists($filename)){
            include_once($filename);
        }
    }
}