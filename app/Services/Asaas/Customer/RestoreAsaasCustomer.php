<?php

namespace App\Services\Asaas\Customer;

use App\Services\Asaas\Core\Customer;
use App\Traits\CanMakeRequest;

class RestoreAsaasCustomer extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(string $id): array
    {
        $this->url = "$this->url/$id/restore";
        return $this->makeRequest(httpMethod: 'POST');
    }
}
