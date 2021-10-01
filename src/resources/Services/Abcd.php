<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class Abcd
{
    /**
     * Http client
     * 
     * @var HttpClientInterface
     */
    protected $http;
    
    protected $response;
    /**
     * Create instance of Bitsika
     * 
     * @param string $secretKey    Merchant Secret Key 
     * 
     * @return void
     */
    public function __construct(HttpClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * Generate wallet
     * 
     * @param array $params    filters
     * 
     * @return array
     */
    public function generate(string $accountName) : array
    {
        $url = "abcd/generate";

        $params['account_name'] = $accountName;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Check wallet
     * 
     * @param array $params    filters
     * 
     * @return array
     */
    public function check(string $accountName) : array
    {
        $url = "abcd/check";

        $params['account_name'] = $accountName;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

}