<?php

namespace App\Services\Asaas\Cliente;

use App\Services\Asaas\Cliente\Concerns\AsaasCustomer;
use App\Services\Asaas\Core\Cliente;
use App\Traits\CanMakeRequestWithBody;

class CreateAsaasCustomer extends Cliente
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
