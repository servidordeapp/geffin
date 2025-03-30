<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Actions;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\InvalidDocumentException;
use App\Services\PaymentGateway\Asaas\Core\Customer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerInput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequestWithBody;
use Error;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

final class UpdateAsaasCustomer extends Customer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id, array $data): AsaasCustomerOutput
    {
        try {
            $customer = new AsaasCustomerInput($data);
            $this->url = "$this->url/$id";
            $httpResponse = $this->makeRequest($customer, httpMethod: 'PUT');

            return new AsaasCustomerOutput(httpResponse: $httpResponse);
        } catch (RequestException $requestException) {
            if ($requestException->getCode() === Response::HTTP_BAD_REQUEST) {
                $data = json_decode(
                    $requestException->getResponse()->getBody()->getContents(),
                    true
                );
                throw new InvalidDocumentException(
                    $data['errors'][0]['description'],
                    $requestException->getCode()
                );
            }

            if ($requestException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new CustomerNotFoundException;
            }

            throw new Error(
                'Erro ao atualizar o cliente: '.$requestException->getMessage(),
                $requestException->getCode()
            );
        }

    }
}
