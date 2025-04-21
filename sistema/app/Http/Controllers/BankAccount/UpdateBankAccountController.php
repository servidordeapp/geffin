<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\UpdateBankAccountRequest;
use App\Models\BankAccount;

class UpdateBankAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->validated());

        return redirect()->route('dados-bancarios.index');
    }
}
