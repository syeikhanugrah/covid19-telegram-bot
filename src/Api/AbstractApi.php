<?php

namespace App\Api;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

abstract class AbstractApi
{
    private $httpClient;

    abstract public function baseUrl();

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    protected function sendRequest($method, $uri, $options = [])
    {
        return $this
            ->httpClient
            ->request($method, $this->baseUrl().$uri, $options)
            ->toArray(false);
    }

    protected function get($uri, $options = [])
    {
        return $this->sendRequest('GET', $uri, $options);
    }

    protected function post($uri, $options = [])
    {
        return $this->sendRequest('POST', $uri, $options);
    }
}