<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Services\PaymentGateway\Asaas\Core\AsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\ListAsaasCustomersParameters;
use App\Traits\CanMakeRequest;

class ListAsaasCustomers extends AsaasCustomer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(array $params): array
    {
        $customerParameters = new ListAsaasCustomersParameters(...$params);
        $this->url = "$this->url?" . $customerParameters->toQueryString();
        $httpResponse = $this->makeRequest(httpMethod: 'GET');
        $httpResponse['data'] = array_map(
            function (array $customer) {
                return new AsaasCustomerOutput($customer);
            },
            $httpResponse['data']
        );
        return $httpResponse;
    }
}
