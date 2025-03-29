<?php

use App\Contracts\Customer\CustomerOutput;
use App\Exceptions\InvalidDocumentException;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

it('can not create a customer with an invalid CPF', function () {
    // Arrange
    $paymentGatewayCustomer = new AsaasCustomer;
    $customerData = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'cpfCnpj' => '12345678901',
    ];

    // Act
    expect(fn () => $paymentGatewayCustomer->create($customerData))
        ->toThrow(InvalidDocumentException::class);
});

it('creates a customer of type CustomerOutput when create a customer in payment gateway', function () {
    // Arrange
    $paymentGatewayCustomer = new AsaasCustomer;
    $customerData = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'cpfCnpj' => '53119967068',
    ];

    // Act
    $customer = $paymentGatewayCustomer->create($customerData);

    // Assert
    expect($customer)
        ->toBeInstanceOf(CustomerOutput::class);
});

it('throws exception when creating customer with missing data', function () {
    // Arrange
    $paymentGatewayCustomer = new AsaasCustomer;
    $invalidCustomerData = [
        'name' => 'John Doe',
        // email faltando
    ];

    // Act & Assert
    expect(fn () => $paymentGatewayCustomer->create($invalidCustomerData))
        ->toThrow(InvalidArgumentException::class);
});

it('generates a customer string id when creating new customer', function () {
    // Arrange
    $paymentGatewayCustomer = new AsaasCustomer;
    $customerData = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'cpfCnpj' => '53119967068',
    ];

    // Act
    $customer = $paymentGatewayCustomer->create($customerData);

    // Assert
    expect($customer)->id->toBeString();
});
