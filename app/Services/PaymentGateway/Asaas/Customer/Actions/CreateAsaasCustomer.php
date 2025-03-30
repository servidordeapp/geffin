<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Actions;

use App\Exceptions\InvalidDocumentException;
use App\Services\PaymentGateway\Asaas\Core\Customer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerInput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequestWithBody;
use Error;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

final class CreateAsaasCustomer extends Customer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of executearray
     *
     * @throws \App\Exceptions\InvalidDocumentException
     */
    public function execute(array $data): AsaasCustomerOutput
    {
        $customer = new AsaasCustomerInput($data);

        try {
            $httpResponse = $this->makeRequest($customer, httpMethod: 'POST');

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
            throw new Error(
                'Erro ao criar o cliente: '.$requestException->getMessage(),
                $requestException->getCode()
            );
        }
    }
}
