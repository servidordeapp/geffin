<?php

namespace App\Services\Asaas\Cliente;

use App\Services\Asaas\Cliente\Concerns\ListAsaasCustomersParameters;
use App\Services\Asaas\Core\Cliente;
use App\Traits\CanMakeRequest;

class ListAsaasCustomers extends Cliente
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
