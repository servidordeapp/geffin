<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription;

use App\Services\PaymentGateway\Providers\Asaas\Subscription\Actions\CreateAsaasSubscription;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionOutput;
use App\Services\PaymentGateway\Subscription\SubscriptionInterface;
use Exception;

class AsaasSubscription implements SubscriptionInterface
{
    public static function get(array $values): array
    {
        throw new Exception('Não implementado');
    }

    public static function find(string $id)
    {
        throw new Exception('Não implementado');
    }

    public static function first()
    {
        throw new Exception('Não implementado');
    }

    public static function getByCustomer(string $customer_id): array
    {
        throw new Exception('Não implementado');
    }

    public static function create(array $data): AsaasSubscriptionOutput
    {
        return (new CreateAsaasSubscription)->execute($data);
    }

    public static function update(string $id, array $data)
    {
        throw new Exception('Não implementado');
    }

    public static function billings(string $id)
    {
        throw new Exception('Não implementado');
    }

    public static function delete(string $id): bool
    {
        throw new Exception('Não implementado');
    }

    public static function restore(string $id)
    {
        throw new Exception('Não implementado');
    }
}
