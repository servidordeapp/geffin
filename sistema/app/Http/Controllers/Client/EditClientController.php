<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Inertia\Inertia;

class EditClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Client $client)
    {
        return Inertia::render('Clients/FormClient', [
            'initialData' => Client::with('addresses')->find($client->id),
            'isEditing' => true,
        ]);
    }
}
