<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Facades;

use App\Contracts\Customer\CustomerInterface;
use App\Contracts\Customer\CustomerOutput;
use Exception;

class AsaasCustomerFacade implements CustomerInterface
{
    public function get(): array
    {
        throw new Exception("Nao implementado");
    }

    public function search(array $values): array
    {
        throw new Exception("Nao implementado");
    }

    public function find(string $id): CustomerOutput
    {
        throw new Exception("Nao implementado");
    }

    public function create(array $data): CustomerOutput
    {
        throw new Exception("Nao implementado");
    }

    public function update(string $id, array $data): CustomerOutput
    {
        throw new Exception("Nao implementado");
    }

    public function deleteCustomer(string $id): bool
    {
        throw new Exception("Nao implementado");
    }

    public function restoreCustomer(string $id): CustomerOutput
    {
        throw new Exception("Nao implementado");
    }
}
