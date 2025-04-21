<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Client;

class CreateClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClientRequest $request)
    {
        $client = Client::create($request->validated());

        return redirect()->route('clients.index');
    }
}
