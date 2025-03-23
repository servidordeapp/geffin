<?php

namespace App\Services\Asaas\Cliente;

use App\Services\Asaas\Cliente\Concerns\AsaasCustomer;
use App\Services\Asaas\Core\Cliente;
use App\Traits\CanMakeRequestWithBody;

class UpdateAsaasCustomer extends Cliente
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
