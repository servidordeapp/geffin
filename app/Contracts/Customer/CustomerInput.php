<?php

namespace App\Contracts\Customer;

interface CustomerInput
{
    public function validate(): void;

    public function getId(): ?string;
}
