<?php

namespace App\Http\Controllers\Client\Charges;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListClientChargesController extends Controller
{
    public function __invoke(Request $request, Client $client)
    {
        $client->load('charges', 'charges.installments');

        return Inertia::render('Clients/Charges', [
            'client' => $client,
        ]);
    }
}
