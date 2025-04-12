<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Actions;

use App\Services\PaymentGateway\Providers\Asaas\Core\Subscription;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionInput;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionOutput;
use App\Services\PaymentGateway\Traits\CanMakeRequestWithBody;

class CreateAsaasSubscription extends Subscription
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(array $data): AsaasSubscriptionOutput
    {
        $subscription = new AsaasSubscriptionInput($data);
        $httpResponse = $this->makeRequest($subscription, httpMethod: 'POST');

        return new AsaasSubscriptionOutput($httpResponse);
    }
}
