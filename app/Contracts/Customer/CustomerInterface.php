<?php

namespace App\Contracts\Customer;

interface CustomerInterface
{
    public static function get(array $values): array;

    public static function find(string $id): CustomerOutput;

    public static function first(): CustomerOutput;

    public static function create(array $data): CustomerOutput;

    public static function update(string $id, array $data): CustomerOutput;

    public static function delete(string $id): bool;

    public static function restore(string $id): CustomerOutput;
}
