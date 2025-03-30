<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Contracts\Customer\CustomerInterface;
use App\Contracts\Customer\CustomerOutput;
use App\Services\PaymentGateway\Asaas\Customer\Actions\CreateAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Actions\DeleteAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Actions\GetAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Actions\ListAsaasCustomers;
use App\Services\PaymentGateway\Asaas\Customer\Actions\RestoreAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Actions\UpdateAsaasCustomer;

final class AsaasCustomer implements CustomerInterface
{
    public static function get(array $values): array
    {
        return (new ListAsaasCustomers)->execute($values);
    }

    public static function find(string $id): CustomerOutput
    {
        return (new GetAsaasCustomer)->execute($id);
    }

    public static function first(): CustomerOutput
    {
        $response = self::get(['limit' => 1]);

        return $response['data'][0];
    }

    public static function create(array $data): CustomerOutput
    {
        return (new CreateAsaasCustomer($data))->execute();
    }

    public static function update(string $id, array $data): CustomerOutput
    {
        return (new UpdateAsaasCustomer)->execute($id, $data);
    }

    public static function delete(string $id): bool
    {
        return (new DeleteAsaasCustomer)->execute($id);
    }

    public static function restore(string $id): CustomerOutput
    {
        return (new RestoreAsaasCustomer)->execute($id);
    }
}
