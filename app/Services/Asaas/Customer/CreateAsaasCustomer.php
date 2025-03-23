<?php

namespace App\Services\Asaas\Customer;

use App\Services\Asaas\Customer\Concerns\AsaasCustomer;
use App\Services\Asaas\Core\Customer;
use App\Traits\CanMakeRequestWithBody;

class CreateAsaasCustomer extends Customer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(array $data): array
    {
        $customer = new AsaasCustomer(...$data);
        return $this->makeRequest($customer, httpMethod: 'POST');
    }
}
