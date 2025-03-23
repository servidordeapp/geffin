<?php

namespace App\Interfaces;

interface PaymentProviderEncoderInterface
{
    public function __toString(): string;
}
