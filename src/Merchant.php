<?php 

namespace Bitsika;

use Bitsika\Resources\Services\Abcd;
use Bitsika\Resources\Services\Bank;
use Bitsika\Resources\Supports\Http;
use Bitsika\Resources\Services\Bitcoin;
use Bitsika\Resources\Services\Invoice;
use Bitsika\Resources\Services\OverView;
use Bitsika\Resources\Services\Transaction;
use Bitsika\Resources\Services\VirtualCard;
use Bitsika\Resources\Config\MerchantConfig;

class Merchant
{
    /**
     * Merchant Secret Key 
     * 
     * @var string
     */
    protected $secretKey;
    
    /**
     * Http client
     * 
     * @var Http
     */
    protected $http;
    

    /**
     * Create instance of Bitsika
     * 
     * @param string $secretKey    Merchant Secret Key 
     * 
     * @return void
     */
    public function __construct(string $secretKey)
    {
        if (! is_string($secretKey) || ! (substr($secretKey, 0, 8) === 'bsk_sec_')) {
            throw new \InvalidArgumentException("Invalid secret key passed. {$secretKey}");
        }

        $this->http = new Http(MerchantConfig::API_BASE_URL);

        $this->http->withToken($secretKey)
            ->withHeader(['x-service-name' => MerchantConfig::SERVICE_NAME]);
    }

    /**
     * Get merchant detail
     * 
     * @return array
     */
    public function detail(): array
    {
        $url = "detail";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Get merchant statistics
     * 
     * @return array
     */
    public function statistics(): array
    {
        $url = "statistics";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Get an instance of the invoice service
     * 
     * @return Invoice
     */
    public function invoices(): Invoice
    {
        return new Invoice($this->http);
    }

    /**
     * Get an instance of the transaction service
     * 
     * @return Transaction
     */
    public function transaction(): Transaction
    {
        return new Transaction($this->http);
    }

    /**
     * Get an instance of the virtual-card service
     * 
     * @return VirtualCard
     */
    public function virtualCard(): VirtualCard
    {
        return new VirtualCard($this->http);
    }

    /**
     * Get an instance of the bitcoin service
     * 
     * @return Bitcoin
     */
    public function bitcoin(): Bitcoin
    {
        return new Bitcoin($this->http);
    }

    /**
     * Get an instance of the Abcd service
     * 
     * @return Abcd
     */
    public function abcd(): Abcd
    {
        return new Abcd($this->http);
    }

    /**
     * Get an instance of the Bank service
     * 
     * @return Bank
     */
    public function banks(): Bank
    {
        return new Bank($this->http);
    }

}