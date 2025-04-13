<?php

namespace App\Services\PaymentGateway\Interfaces;

interface DocumentInterface
{
    public function validate(): void;

    public function get(): string;
}
