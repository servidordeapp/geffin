<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Services\PaymentGateway\Asaas\Core\AsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerInput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequestWithBody;

class UpdateAsaasCustomer extends AsaasCustomer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id, array $data): AsaasCustomerOutput
    {
        $customer = new AsaasCustomerInput(...$data);
        $this->url = "$this->url/$id";
        $httpResponse = $this->makeRequest($customer, httpMethod: 'PUT');
        return new AsaasCustomerOutput(httpResponse: $httpResponse);
    }
}
