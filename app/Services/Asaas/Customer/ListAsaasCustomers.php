<?php

namespace App\Services\Asaas\Customer;

use App\Services\Asaas\Customer\Concerns\ListAsaasCustomersParameters;
use App\Services\Asaas\Core\Customer;
use App\Traits\CanMakeRequest;

class ListAsaasCustomers extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(array $params): array
    {
        $customerParameters = new ListAsaasCustomersParameters(...$params);
        $this->url = "$this->url?" . $customerParameters->toQueryString();
        return $this->makeRequest(httpMethod: 'GET');
    }
}
