<?php

namespace Cmercado93\SuitecrmApiClient;

use Cmercado93\SuitecrmApiClient\Common\Http;

class Config
{
    protected $http;
    protected $auth;
    protected $url;
    protected $username;
    protected $password;

    /**
     * @param string $url
     * @param string $username
     * @param string $password
     */
    protected function __construct($url, $username, $password)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param string $url
     * @param string $username
     * @param string $password
     * @return Config
     */
    public static function make($url, $username, $password)
    {
        return new static($url, $username, $password);
    }

    /**
     * @return Http
     */
    public function getHttp()
    {
        if (!$this->http) {
            $this->http = new Http($this->url);
        }

        return $this->http;
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        if (!$this->auth) {
            $this->auth = new Auth($this->getHttp(), $this->username, $this->password);
        }

        return $this->auth;
    }
}
