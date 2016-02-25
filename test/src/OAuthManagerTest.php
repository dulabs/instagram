<?php

namespace Dulabs\Instagram\Test;

require_once __DIR__.'/../../vendor/autoload.php';

use Dulabs\Instagram\OAuthManager as OAuth;

class OAuthManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testConnectUrl()
    {
        $config['api_key'] = '';
        $config['api_secret'] = '';
        $config['callback_url'] = 'http://localhost/instagram/demo/callback.php';
        $config['response_type'] = OAuth::RESPONSE_TYPE_CODE;

        $oauth = new OAuth();
        $oauth->setConfig($config);
        $login = $oauth->login(['basic', 'public_content', 'follower_list']);

        $this->dispatch($login);
        $this->assertContains('instagram.com', $login, '', true);
    }
}
