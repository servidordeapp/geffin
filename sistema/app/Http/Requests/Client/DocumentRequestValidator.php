<?php

namespace App\Http\Requests\Client;

use App\Services\PaymentGateway\Utils\Cnpj;
use App\Services\PaymentGateway\Utils\Cpf;
use Illuminate\Validation\ValidationException;

class DocumentRequestValidator
{
    public static function execute(string $document_type, string $document)
    {
        if ($document_type == 'CPF') {
            try {
                new Cpf($document);
            } catch (\Throwable $th) {
                throw ValidationException::withMessages([
                    $th->getMessage()
                ]);
            }
        }

        if ($document_type == 'CNPJ') {
            try {
                new Cnpj($document);
            } catch (\Throwable $th) {
                throw ValidationException::withMessages([
                    $th->getMessage()
                ]);
            }
        }
    }
}
