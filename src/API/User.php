<?php

namespace Dulabs\Instagram\API;

use Dulabs\Instagram\Instagram;

/**
 * User Endpoints
 * https://www.instagram.com/developer/endpoints/users.
 */
class User extends Instagram
{
    public function getInstance()
    {
        static $instance;
        $instance = ($instance === null) ? new self() : $instance;

        return $instance;
    }

    /**
     * Get information about the owner of the access_token.
     *
     * @return object
     */
    public function self()
    {
        $endpoint = 'users/self/';

        return $this->_call($endpoint);
    }

    /**
     * Get the most recent media published by 
     * the owner of the access_token.
     *
     * @param array $params
     *
     * @return object
     */
    public function self_media($params = null)
    {
        $endpoint = 'users/self/media/recent/';

        return $this->_call($endpoint, $params);
    }

    /**
     * Get the list of recent media liked 
     * by the owner of the access_token. 
     *
     * @param array $params
     *
     * @return object
     */
    public function self_liked($params = null)
    {
        $endpoint = 'users/self/media/liked/';

        return $this->_call($endpoint, $params);
    }

    /**
     * Get information about a user.
     *
     * @param string $uid
     *
     * @return object
     */
    public function user($uid)
    {
        $endpoint = "users/{$uid}/";

        return $this->_call($endpoint);
    }

    /**
     * Get the most recent media published by a user.
     *
     * @param string $uid
     * @param array  $params
     *
     * @return object
     */
    public function user_media($uid, $params)
    {
        $endpoint = "users/{$uid}/media/recent/";

        return $this->_call($endpoint);
    }

    /**
     * Get a list of users matching the query.
     *
     * @param array $params
     *
     * @return object
     */
    public function search($params)
    {
        $endpoint = 'users/search';

        return $this->_call($endpoint, $params);
    }
}
