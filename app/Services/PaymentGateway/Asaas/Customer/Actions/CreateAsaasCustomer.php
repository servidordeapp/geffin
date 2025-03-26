<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Actions;

use App\Services\PaymentGateway\Asaas\Core\Customer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerInput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequestWithBody;
use Exception;
use GuzzleHttp\Exception\RequestException;

class CreateAsaasCustomer extends Customer
{
    use CanMakeRequestWithBody;

    private AsaasCustomerInput $customer;

    public function __construct(
        array $data,
    ) {
        parent::__construct();
        $this->customer = new AsaasCustomerInput($data);
    }

    /**
     * Summary of executearray
     *
     * @param  array  $data
     *
     * @throws \Exception
     */
    public function execute(): AsaasCustomerOutput
    {
        try {
            $httpResponse = $this->makeRequest($this->customer, httpMethod: 'POST');

            return new AsaasCustomerOutput(httpResponse: $httpResponse);
        } catch (RequestException $requestException) {
            $data = json_decode($requestException->getResponse()->getBody()->getContents(), true);
            throw new Exception($data['errors'][0]['description'], $requestException->getCode());
        }
    }
}
