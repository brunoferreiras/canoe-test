<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start_year' => 'required|string|max:4',
            'manager_id' => 'required|integer|exists:fund_managers,id',
        ];
    }
}
