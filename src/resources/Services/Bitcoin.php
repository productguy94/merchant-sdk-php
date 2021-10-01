<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class Bitcoin
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
     * @param int $userId
     * 
     * @return array
     */
    public function generate(int $userId) : array
    {
        $url = "bitcoin/generate";

        $params['user_id'] = $userId;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Check wallet
     * 
     * @param int $userId
     * 
     * @return array
     */
    public function check(int $userId) : array
    {
        $url = "bitcoin/check";

        $params['user_id'] = $userId;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

}