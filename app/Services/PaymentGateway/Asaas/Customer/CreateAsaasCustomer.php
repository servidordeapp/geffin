<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Services\PaymentGateway\Asaas\Core\AsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerInput;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequestWithBody;

class CreateAsaasCustomer extends AsaasCustomer
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(array $data): AsaasCustomerOutput
    {
        $customer = new AsaasCustomerInput(...$data);
        $httpResponse = $this->makeRequest($customer, httpMethod: 'POST');
        return new AsaasCustomerOutput(httpResponse: $httpResponse);
    }
}
