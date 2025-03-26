<?php

namespace App\Contracts\Customer;

interface CustomerInterface
{
    public function get(): array;
    public function search(array $values): array;
    public function find(string $id): CustomerOutput;
    public function create(array $data): CustomerOutput;
    public function update(string $id, array $data): CustomerOutput;
    public function deleteCustomer(string $id): bool;
    public function restoreCustomer(string $id): CustomerOutput;
}
