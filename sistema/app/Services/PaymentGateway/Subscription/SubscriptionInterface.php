<?php

namespace App\Services\PaymentGateway\Subscription;

interface SubscriptionInterface
{
    public static function get(array $values): array;

    public static function find(string $id);

    public static function first();

    public static function getByCustomer(string $customer_id): array;

    public static function create(array $data);

    public static function update(string $id, array $data);

    public static function billings(string $id);

    public static function delete(string $id): bool;

    public static function restore(string $id);
}
