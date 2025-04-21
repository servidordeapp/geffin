<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;

class UpdateClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('clients.index');
    }
}
