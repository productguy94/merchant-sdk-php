<?php 

namespace Bitsika;

use Bitsika\Resources\Supports\Request;
use Bitsika\Resources\Config\MerchantConfig;

class MerchantOld
{

    /**
     * Bitsika Auth API URL
     * 
     * @var string
     */
    protected $authApiUrl;
    
    /**
     * Bitsika Merchant API URL
     * 
     * @var string
     */
    protected $merchantApiUrl;

    /**
     * Merchant Secret Key 
     * 
     * @var string
     */
    protected $secretKey;

    /**
     * Instance of Request
     * 
     * @var object
     */
    protected $request;

    /**
     * Endpoint status code
     * 
     * @var string
     */
    protected $statusCode;

    /**
     * Set headers for request
     * 
     * @var string
     */
    protected $headers;


    /**
     * Create instance of Bitsika
     * 
     * @param string $secretKey    Merchant Secret Key 
     * 
     * @return void
     */
    public function __construct(string $secretKey)
    {
        $this->request = new Request();
        $this->secretKey = $secretKey;

        $this->merchantApiUrl = MerchantConfig::API_BASE_URL . "/merchant/v1/";
        $this->setHeader();
    }

    /**
     * Generate Bitsika authentication 
     * 
     * @param int $tierId    Merchant Tier Id 
     * 
     * @return object
     */
    public function generateHash(array $params) : array
    {
        $url = "{$this->authApiUrl}/auth/generate";

        $response = $this->request->post($url, $params);

        return $response->toArray();
    }

    /**
     * Create invoice for merchant
     * 
     * @param array $params    Parameters required to create an invoice
     * 
     * @return object
     */
    public function createInvoice(array $params) : array
    {
        $url = "{$this->merchantApiUrl}/invoices/create";

        $response = $this->request->post($url, $params);

        return $response->toArray();
    }

    /**
     * View merchant invoice
     * 
     * @param array $invoiceId    Invoice id
     * 
     * @return object
     */
    public function viewInvoice(string $invoiceId) : array
    {
        $url = "{$this->merchantApiUrl}/invoices/{$invoiceId}";
        
        $response    = $this->request->get($url);

        return $response->toArray();
    }

    /**
     * View all the invoices owned by a merchant
     * 
     * @return object
     */
    public function getAllInvoice($nextPageUrl = "") : array
    {
        $url = "{$this->merchantApiUrl}/invoices";

        if (!empty($nextPageUrl)) {
            $url = $nextPageUrl;
        }

        $response    = $this->request->get($url);

        return $response->toArray();
    }

    // /**
    //  * Set base url for Merchant and Auth
    //  * 
    //  * @return object
    //  */
    // private function setBaseUrl()
    // {
    //     $this->merchantApiUrl   = MerchantConfig::API_BASE_URL . "/merchant";
    // }

    /**
     * Set headers
     * 
     * @return object
     */
    private function setHeader()
    {
        $this->request->setHeader([
            'secretKey' => $this->secretKey
        ]); 
    }
}