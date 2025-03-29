<?php

namespace App\Exceptions;

use Exception;

class CustomerNotFoundException extends Exception
{
    protected $message = 'Cliente não encontrado';
}
