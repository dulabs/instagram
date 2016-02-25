<?php

namespace Dulabs\Instagram\API;

use Dulabs\Instagram\Instagram;

/**
 * Tag Endpoints
 * https://www.instagram.com/developer/endpoints/tags.
 */
class Tag
{
    public function getInstance()
    {
        static $instance;
        $instance = ($instance === null) ? new self() : $instance;

        return $instance;
    }

    /**
     * Get information about a tag object.
     *
     * @param string $name
     *
     * @return object
     */
    public function get($name)
    {
        $endpoint = "tags/{$name}";

        return $this->_call($endpoint);
    }

    /**
     * Get a list of recently tagged media.
     *
     * @param string $name
     * @param array  $params
     *
     * @return object
     */
    public function media($name, $params = null)
    {
        $endpoint = "tags/{$name}/media/recent";

        return $this->_call($endpoint, $params);
    }

    /**
     * Search for tags by name.
     *
     * @param array $params
     *
     * @return object
     */
    public function search($params)
    {
        $endpoint = 'tags/search';

        return $this->_call($endpoint, $params);
    }
}
