<?php

namespace App\Http\Requests\Client;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = (new Client)->rules();

        $rules['document'][] = 'unique:clients,document,'.$this->id;
        $rules['email'][] = 'unique:clients,email,'.$this->id;

        return $rules;
    }

    public function prepareForValidation()
    {
        DocumentRequestValidator::execute($this->document_type, $this->document);
    }
}
