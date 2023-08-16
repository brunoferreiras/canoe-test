<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'start_year' => 'string|max:4',
            'manager_id' => 'integer|exists:fund_managers,id',
        ];
    }
}
