<?php

namespace Bitsika\Resources\Supports;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Bitsika\Resources\Contracts\HttpClientInterface;
use InvalidArgumentException;

class Http implements HttpClientInterface
{

    /**
     * Request Headers
     * 
     * @var array
     */
    protected $headers = [
        'Accept' => 'application/json',
    ];

    /**
     * Request Response
     * 
     * @var object
     */
    protected $response;

    /**
     * Base url
     * 
     * @var string
     */
    protected $baseUrl;

    /**
     * Handler
     * 
     * @var RequestHandler
     */
    protected $handler;

    /**
     * token
     * 
     * @var string
     */
    protected $bearerToken;


    public function __construct(string $baseUrl)
    {
        $this->handler = new RequestHandler();
        $this->baseUrl = $baseUrl;

        $this->handler->setHeader($this->headers)->setBaseUrl($baseUrl);
    }

    /**
     * Make GET request using the client set in the construct
     * 
     * @param string $url    URL to make GET request to 
     * 
     * @return Request
     */
    public function get($url, array $params = [])
    {
        $this->response = $this->handler->makeRequest(HttpMethod::GET, $url, $params);

        return new Response($this->response);
    }

    /**
     * Make Post request using the client set in the construct
     * 
     * @param string $url    URL to make POST request to 
     * @param array $params  Form options 
     * 
     * @return Request
     */
    public function post($url, array $params = [])
    {
        $this->response = $this->handler->asForm()->makeRequest(HttpMethod::POST, $url, $params);
    
        return new Response($this->response);
    }

    /**
     * Make Put request using the client set in the construct
     * 
     * @param string $url    URL to make Put request to 
     * @param array $params  Form options 
     * 
     * @return Request
     */
    public function put($url, array $params = [])
    {
        $this->response = $this->handler->asForm()->makeRequest(HttpMethod::PUT, $url, $params);
    
        return new Response($this->response);
    }

    /**
     * Make Patch request using the client set in the construct
     * 
     * @param string $url    URL to make patch request to 
     * @param array $params  Form options 
     * 
     * @return Request
     */
    public function patch($url, array $params = [])
    {
        $this->response = $this->handler->asForm()->makeRequest(HttpMethod::PATCH, $url, $params);
    
        return new Response($this->response);
    }

    /**
     * Make Delete request using the client set in the construct
     * 
     * @param string $url    URL to make delete request 
     * 
     * @return Request
     */
    public function delete($url)
    {
        $this->response = $this->handler->makeRequest(HttpMethod::DELETE, $url);
    
        return new Response($this->response);
    }

    public function withHeader(array $headers)
    {
        $this->handler->setHeader($this->headers, $headers);

        return $this;
    }

    public function withToken(string $token)
    {
        $this->bearerToken = $token;

        $this->handler->setHeader(['Authorization' => "Bearer {$token}"]);

        return $this;
    }
}