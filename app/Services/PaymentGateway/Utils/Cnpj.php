<?php

namespace App\Services\PaymentGateway\Utils;

use App\Exceptions\InvalidDocumentException;
use App\Services\PaymentGateway\Interfaces\DocumentInterface;

class Cnpj implements DocumentInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $value,
    ) {
        if (empty($value)) {
            throw new InvalidDocumentException('CNPJ não pode estar vazio');
        }

        $this->validate();
    }

    public function validate(): void
    {
        $document = preg_replace('/\D/', '', $this->value);

        if (strlen($document) !== 14) {
            throw new InvalidDocumentException('O CNPJ precisa conter 14 dígitos');
        }
    }

    public function get(): string
    {
        return $this->value;
    }
}
