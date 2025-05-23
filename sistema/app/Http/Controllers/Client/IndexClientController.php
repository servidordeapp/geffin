<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);

        $clientes = Client::query()
            ->when($search, function ($query) use ($search) {
                $query->whereAny([
                    'first_name',
                    'last_name',
                    'email',
                ], 'like', "%$search%");
            })
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Clients/Index', [
            'clientsList' => $clientes,
            'search' => $search,
        ]);
    }
}
