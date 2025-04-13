<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Customer\Actions;

use App\Services\PaymentGateway\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Providers\Asaas\Core\Customer;
use App\Services\PaymentGateway\Providers\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Services\PaymentGateway\Traits\CanMakeRequest;
use Error;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

final class RestoreAsaasCustomer extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id): AsaasCustomerOutput
    {
        $this->url = "$this->url/$id/restore";

        try {
            return new AsaasCustomerOutput($this->makeRequest(httpMethod: 'POST'));
        } catch (RequestException $requestException) {
            if ($requestException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new CustomerNotFoundException;
            }
            throw new Error(
                'Erro ao restaurar o cliente: '.$requestException->getMessage(),
                $requestException->getCode()
            );
        }
    }
}
