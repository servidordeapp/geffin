<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Customer\Actions;

use App\Services\PaymentGateway\Providers\Asaas\Core\Customer;
use App\Services\PaymentGateway\Providers\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Services\PaymentGateway\Providers\Asaas\Customer\Concerns\ListAsaasCustomersParameters;
use App\Services\PaymentGateway\Traits\CanMakeRequest;
use Error;
use GuzzleHttp\Exception\RequestException;

final class ListAsaasCustomers extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(array $params): array
    {
        $customerParameters = new ListAsaasCustomersParameters(...$params);
        $this->url = "$this->url?".$customerParameters->toQueryString();

        try {
            $httpResponse = $this->makeRequest(httpMethod: 'GET');
            $httpResponse['data'] = array_map(
                fn (array $customer) => new AsaasCustomerOutput($customer),
                $httpResponse['data']
            );

            return $httpResponse;
        } catch (RequestException $requestException) {
            throw new Error(
                'Erro ao listar os clientes: '.$requestException->getMessage(),
                $requestException->getCode()
            );
        }
    }
}
