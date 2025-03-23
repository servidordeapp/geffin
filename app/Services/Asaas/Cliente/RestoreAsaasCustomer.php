<?php

namespace App\Services\Asaas\Cliente;

use App\Services\Asaas\Core\Cliente;
use App\Traits\CanMakeRequest;

class RestoreAsaasCustomer extends Cliente
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
