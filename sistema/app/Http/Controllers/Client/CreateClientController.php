<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Clients/FormClient', [
            'initialData' => [],
            'isEditing' => false,
        ]);;
    }
}
