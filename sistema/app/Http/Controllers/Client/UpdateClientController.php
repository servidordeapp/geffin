<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Address;
use App\Models\Client;

class UpdateClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->only('first_name', 'last_name', 'document_type', 'document', 'email', 'phone'));

        $this->updateAddresses($request->addresses, $client);

        return redirect()->route('clients.index');
    }

    private function updateAddresses(array $addresses, Client $client)
    {
        $addressIds = $client->addresses->pluck('id')->toArray();

        $addressesToDelete = array_diff(
            $addressIds,
            collect($addresses)->pluck('id')->toArray()
        );

        $client->addresses()->whereIn('id', $addressesToDelete)->forceDelete();

        foreach ($addresses as $address) {
            if (in_array($address['id'], $addressIds)) {
                Address::find($address['id'])->update($address);
            } else {
                $client->addresses()->create($address);
            }
        }
    }
}
