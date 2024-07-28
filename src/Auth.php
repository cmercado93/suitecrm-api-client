<?php

namespace Cmercado93\SuitecrmApiClient;

use Cmercado93\SuitecrmApiClient\Common\Http;
use Exception;

class Auth
{
    protected $username;
    protected $password;
    protected $http;
    protected $token;

    /**
     * @param Http $http
     * @param string $username
     * @param string $password
     */
    public function __construct(Http $http, $username, $password)
    {
        $this->http = $http;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
    public function login()
    {
        $args = array(
            'user_auth' => array(
                'user_name' => $this->username,
                'password' => md5($this->password),
            ),
        );

        $result = $this->http->sendData('login', $args);

        if (isset($result['id'])) {
            $this->token = $result['id'];
        } else {
            throw new Exception('Authentication Error: ' . json_encode($result));
        }
    }

    /**
     * @throws Exception
     */
    public function logout()
    {
        $args = array(
            'session' => $this->getTokenId(),
        );

        $this->http->sendData('logout', $args);
        $this->token = null;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getTokenId()
    {
        if (is_null($this->token)) {
            $this->login();
        }

        return $this->token;
    }
}
