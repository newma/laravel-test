<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'organisation'       => 'sometimes|string|max:255',
            'property_type'      => 'sometimes|string|max:50',
            'parent_property_id' => 'nullable|integer|exists:properties,id',
            'uprn'               => 'sometimes|string|max:255',
            'address'            => 'sometimes|string|max:255',
            'town'               => 'nullable|string|max:255',
            'postcode'           => 'sometimes|string|max:20',
            'live'               => 'boolean',

        ];
    }
}
