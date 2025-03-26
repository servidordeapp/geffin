<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Contracts\Customer\CustomerInterface;
use App\Contracts\Customer\CustomerOutput;
use App\Services\PaymentGateway\Asaas\Customer\Actions\CreateAsaasCustomer;
use Exception;

class AsaasCustomer implements CustomerInterface
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
        $creatable = new CreateAsaasCustomer($data);
        return $creatable->execute();
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
