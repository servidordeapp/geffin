<?php

namespace App\Services\PaymentGateway\Customer;

interface CustomerOutput
{
    public function __toArray(): array;

    public function __toString(): string;

    public function getId(): string;
}
