<?php

use App\Exceptions\InvalidDocumentException;
use App\Services\PaymentGateway\Providers\Asaas\Customer\AsaasCustomer;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\AsaasSubscription;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionInput;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionOutput;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum;
use App\Services\PaymentGateway\Utils\Trial;

// it('can not create a subscription without a customer', function () {
//     // Arrange

//     // Act
//     expect(fn() => AsaasCustomer::create($customerData))
//         ->toThrow(InvalidDocumentException::class);
// });

it('creates a subscription to a customer in payment gateway', function () {
    // Arrange
    $customer = AsaasCustomer::first();
    $subscription = [
        'customer' => $customer->getId(),
        'billingType' => AsaasBilingTypesEnum::PIX,
        'value' => '100.00',
        'nextDueDate' => new Trial(),
        'cycle' => AsaasBillingCycleEnum::MONTHLY,
        'description' => 'Assinatura de teste',
        'externalReference' => 'assinatura-123',
    ];

    // Act
    $subscription = AsaasSubscription::create($subscription);

    dd($subscription->toArray());

    // Assert
    expect($subscription)
        ->toBeInstanceOf(AsaasSubscriptionOutput::class);
});

// it('throws exception when creating customer with missing data', function () {
//     // Arrange
//     $invalidCustomerData = [
//         'name' => 'John Doe',
//         // email faltando
//     ];

//     // Act & Assert
//     expect(fn() => AsaasCustomer::create($invalidCustomerData))
//         ->toThrow(InvalidArgumentException::class);
// });

// it('generates a customer string id when creating new customer', function () {
//     // Arrange
//     $customerData = [
//         'name' => 'John Doe',
//         'email' => 'john.doe@example.com',
//         'cpfCnpj' => '53119967068',
//     ];

//     // Act
//     $customer = AsaasCustomer::create($customerData);

//     // Assert
//     expect($customer)->id->toBeString();
// });
