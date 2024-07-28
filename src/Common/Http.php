<?php

namespace Cmercado93\SuitecrmApiClient\Common;

use Cmercado93\SuitecrmApiClient\Common\Curl;

class Http
{
    protected $host;
    protected $uri;
    protected $curl;

    public function __construct($url)
    {
        $this->validateUrl($url);
        $this->parseUrl($url);
    }

    /**
     * @param string $method
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function sendData($method, array $data = array())
    {
        $post = array(
            'method' => $method,
            'input_type' => 'JSON',
            'response_type' => 'JSON',
            'rest_data' => json_encode($data),
        );

        $result = $this->getCurl()->post($this->uri, array(
            'body' => $post,
        ));

        if ($result['code'] != 200) {
            throw new \Exception('Connection to server failed (código ' . $result['code'] . ')');
        }

        return json_decode($result['response'], true);
    }

    /**
     * @return Curl
     */
    protected function getCurl()
    {
        if ($this->curl === null) {
            $this->curl = new Curl($this->host);
        }

        return $this->curl;
    }

    /**
     * @param string $url
     */
    protected function parseUrl($url)
    {
        $baseUrl = parse_url($url);

        $this->host = $baseUrl['scheme'] . '://' . $baseUrl['host'] . (isset($baseUrl['port']) ? ':' . $baseUrl['port'] : '');

        $this->uri = trim($baseUrl['path'], '/');
    }

    /**
     * @param string $url
     * @throws \Exception
     */
    protected function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('The URL is not valid');
        }
    }
}
