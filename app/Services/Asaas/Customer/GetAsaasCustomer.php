<?php

namespace App\Services\Asaas\Customer;

use App\Services\Asaas\Core\Customer;
use App\Traits\CanMakeRequest;

class GetAsaasCustomer extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(string $id): array
    {
        $this->url = "$this->url/$id";
        return $this->makeRequest(httpMethod: 'GET');
    }
}
