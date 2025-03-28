<?php

namespace App\Contracts\Comun;

interface DocumentInterface
{
    public function validate(): void;
    public function get(): string;
}
