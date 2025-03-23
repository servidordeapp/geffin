<?php

namespace App\Services\Asaas\Customer;

use App\Services\Asaas\Customer\Concerns\AsaasCustomer;
use App\Services\Asaas\Core\Customer;
use App\Traits\CanMakeRequestWithBody;

class UpdateAsaasCustomer extends Customer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(string $id, array $data): array
    {
        $customer = new AsaasCustomer(...$data);
        $this->url = "$this->url/$id";
        return $this->makeRequest($customer, httpMethod: 'PUT');
    }
}
