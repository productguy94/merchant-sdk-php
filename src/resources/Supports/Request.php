<?php

namespace Bitsika\Resources\Supports;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class Request 
{

    /**
     * Request Headers
     * 
     * @var array
     */
    protected $headers;

    /**
     * Request Response
     * 
     * @var object
     */
    protected $response;

    public function __construct()
    {
        $this->client   = new Client();
    }

    /**
     * Make GET request using the client set in the construct
     * 
     * @param string $url    URL to make GET request to 
     * 
     * @return Request
     */
    public function get($url)
    {
        $this->response = $this->client->request('Get', $url, [
            'headers' => $this->headers,
        ]);

        return $this;
    }

    /**
     * Make Post request using the client set in the construct
     * 
     * @param string $url    URL to make GET request to 
     * @param array $params  Form options 
     * 
     * @return Request
     */
    public function post($url, array $params)
    {
        $this->response = $this->client->request('POST', $url, [
            'form_params' => $params,
            'headers' => $this->headers,
        ]);
    
        return $this;
    }

    /**
     * Set headers for request
     * 
     * @param array $params  Request Headers 
     * 
     * @return void
     */
    public function setHeader(array $headers)
    {
        $this->headers = array_merge([
            'Accept'     => 'application/json',
        ], $headers);
    }

    /**
     * Convert request response to array 
     * 
     * @return array
     */
    public function toArray() : array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * Convert request response to string 
     * 
     * @return array
     */
    public function toString() : string
    {
        return $this->response->getBody()->getContents();
    }

}