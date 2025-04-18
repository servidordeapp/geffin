<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\CreateBankAccountRequest;
use App\Models\BankAccount;

class CreateBankAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->validated());
        return redirect()->route("dados-bancarios.index");
    }
}
