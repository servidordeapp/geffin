<?php

namespace App\Utils;

use App\Exceptions\InvalidCpfException;

class Cpf
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $value,
    ) {
        if (empty($value)) {
            throw new InvalidCpfException('CPF não pode estar vazio');
        }

        $this->validate();
    }

    private function validate(): void
    {
        $cpf = preg_replace('/\D/', '', $this->value);

        if (strlen($cpf) !== 11) {
            throw new InvalidCpfException('O CPF precisa conter 11 dígitos');
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
            throw new InvalidCpfException('CPF inválido');
        }
    }
}
