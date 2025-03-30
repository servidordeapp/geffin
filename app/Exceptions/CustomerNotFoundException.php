<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CustomerNotFoundException extends Exception
{
    protected $message = 'Cliente não encontrado';

    protected $code = Response::HTTP_NOT_FOUND;

    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message ?? $this->message, $code ?? $this->code);
    }
}
