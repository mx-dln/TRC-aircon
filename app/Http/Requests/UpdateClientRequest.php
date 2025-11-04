<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                Rule::unique('clients', 'email')->ignore($this->client)
            ],
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:500',
            'notes' => 'nullable|string',
            'status' => 'sometimes|string|in:active,inactive,pending',
        ];
    }
}
