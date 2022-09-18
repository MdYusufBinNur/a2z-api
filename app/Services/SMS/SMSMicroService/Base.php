<?php

namespace App\Services\SMS\SMSMicroService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlHandler;

abstract class Base
{
    /**
     * @var Client
     */
    public static $httpClient;

    /**
     * Base constructor.
     */
    public function setClient()
    {
        self::$httpClient = new Client([
            'handler' => new CurlHandler([
                'handle_factory' => new CurlFactory(0)
            ]),
            'verify' => true,
            'headers' => [
                'X-Authorization' => config('app.ms_sms_api_token'),
                'Content-Type'  => 'application/json',
                'Accept'  => 'application/json'
            ]
        ]);
    }

    /**
     * send http request to SMS Microservice API
     *
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return mixed
     * @throws
     */
    public function requestToAPI(string $method, $uri, array $data = [])
    {
        $url = config('app.ms_sms_api') . $uri . '';
        try {
            self::setClient();
            $response = self::$httpClient->request($method, $url, ['json' => $data]);
            $result = json_decode($response->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }

    }
}
