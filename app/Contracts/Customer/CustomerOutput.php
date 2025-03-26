<?php

namespace App\Contracts\Customer;

interface CustomerOutput
{
    public function __toArray(): array;

    public function __toString(): string;
}
