<?php

namespace App\Utils;

use App\Contracts\Comun\DocumentInterface;
use App\Exceptions\InvalidDocumentException;

class Cpf implements DocumentInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $value,
    ) {
        if (empty($value)) {
            throw new InvalidDocumentException('CPF não pode estar vazio');
        }

        $this->validate();
    }

    public function validate(): void
    {
        $cpf = preg_replace('/\D/', '', $this->value);

        if (strlen($cpf) !== 11) {
            throw new InvalidDocumentException('O CPF precisa conter 11 dígitos');
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }
        $firstDigit = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }
        $secondDigit = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);

        if ($firstDigit !== intval($cpf[9]) || $secondDigit !== intval($cpf[10])) {
            throw new InvalidDocumentException('CPF inválido');
        }
    }

    public function get(): string
    {
        return $this->value;
    }
}
