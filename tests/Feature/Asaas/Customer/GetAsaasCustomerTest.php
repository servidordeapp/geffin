<?php

use App\Services\PaymentGateway\Customer\CustomerOutput;
use App\Services\PaymentGateway\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Providers\Asaas\Customer\AsaasCustomer;

it('returns a Customer of the type of CustomerOutput', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $newCustomer = AsaasCustomer::find($customer->getId());

    // Assert
    expect($newCustomer)->toBeInstanceOf(CustomerOutput::class);
});

it('can get a custormer by id', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $newCustomer = AsaasCustomer::find($customer->getId());

    // Assert
    expect($newCustomer)->toBeInstanceOf(CustomerOutput::class);
});

it('can not get a customer that not exists', function () {
    // Assert
    expect(fn () => AsaasCustomer::find('invalid-id'))->toThrow(CustomerNotFoundException::class);
});
