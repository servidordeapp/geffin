<?php

namespace App\Services\Asaas\Cliente;

use App\Services\Asaas\Core\Cliente;
use App\Traits\CanMakeRequest;

class DeleteAsaasCustomer extends Cliente
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(string $id): array
    {
        $this->url = "$this->url/$id";
        return $this->makeRequest(httpMethod: 'DELETE');
    }
}
