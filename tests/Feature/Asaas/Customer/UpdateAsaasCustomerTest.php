<?php

use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

describe('update customer', function () {
    it('can update a customer', function () {
        // Arrange
        $customer = AsaasCustomer::first();

        // Act
        $customerUpdated = AsaasCustomer::update($customer->getId(), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'cpfCnpj' => '53119967068',
        ]);

        // Assert
        expect($customerUpdated)
            ->name->toBe('John Doe')
            ->email->toBe('john.doe@example.com')
            ->cpfCnpj->toBe('53119967068');
    });

    it('can not update a customer that not exists', function () {
        // Assert
        expect(fn () => AsaasCustomer::update('invalid-id', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'cpfCnpj' => '53119967068',
        ]))->toThrow(CustomerNotFoundException::class);
    });
});
