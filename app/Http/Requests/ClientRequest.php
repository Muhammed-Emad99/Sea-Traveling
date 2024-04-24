<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        $id = $this->route()->parameters['client'] ?? null;

        switch ($method) {
            case 'POST':
                return [
                    'name' => 'required|max:255|unique:clients,name',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:255|unique:clients,name,' . $id,
                ];
            default:
                return [];
        }

    }
}
