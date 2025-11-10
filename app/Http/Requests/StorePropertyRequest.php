<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organisation'       => 'required|string|max:255',
            'property_type'      => 'required|string|max:50',
            'parent_property_id' => 'nullable|integer|exists:properties,id',
            'uprn'               => 'required|string|max:255',
            'address'            => 'required|string|max:255',
            'town'               => 'nullable|string|max:255',
            'postcode'           => 'required|string|max:20',
            'live'               => 'boolean',
        ];
    }
}
