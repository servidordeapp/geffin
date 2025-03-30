<?php

use App\Contracts\Customer\CustomerOutput;
use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

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
