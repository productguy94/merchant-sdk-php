<?php 

namespace Bitsika\Resources\Services;

use InvalidArgumentException;
use Bitsika\Resources\Contracts\HttpClientInterface;

class Bank
{
    /**
     * Http client
     * 
     * @var HttpClientInterface
     */
    protected $http;
    
    /**
     * Http response
     * 
     * @var array
     */
    protected $response;

    /**
     * @return void
     */
    public function __construct(HttpClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * Get Nigeria banks
     * 
     * @return array
     */
    public function nigeria() : array
    {
        $url = "banks/nigeria";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Get Ghana banks
     * 
     * @return array
     */
    public function ghana() : array
    {
        $url = "banks/ghana";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Create virtual bank account
     * 
     * @return array
     */
    public function create(array $params) : array
    {
        $url = "bank/create";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Verify Account Number
     * 
     * @return array
     */
    public function verifyAccount(string $country, array $params) : array
    {
        if (! in_array($country, ['nigeria', 'ghana'])) {
            Throw new InvalidArgumentException("Invalid country passed `{$country}`");
        }

        $url = "verify-account/{$country}";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

}