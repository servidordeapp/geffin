<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Actions;

use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Core\Customer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequest;
use Error;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

class GetAsaasCustomer extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id): AsaasCustomerOutput
    {
        $this->url = "$this->url/$id";

        try {
            $httpResponse = $this->makeRequest(httpMethod: 'GET');
            return new AsaasCustomerOutput(httpResponse: $httpResponse);
        } catch (RequestException $requestException) {
            if ($requestException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new CustomerNotFoundException();
            }
            throw new Error(
                message: 'Erro ao buscar o cliente: ' . $requestException->getMessage(),
                code: $requestException->getCode()
            );
        }
    }
}
