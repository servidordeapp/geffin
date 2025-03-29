<?php

namespace App\Contracts\Common;

interface DocumentInterface
{
    public function validate(): void;

    public function get(): string;
}
