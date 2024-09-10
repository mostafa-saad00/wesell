<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class CustomerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() || Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|regex:/^\d{11}$/',
            'address' => 'required|string|max:1000',
            'is_blocked' => 'required|string|in:active,blocked',
        ];
    }

    public function messages()
    {
        return [
            'is_blocked.in' => 'The status must be either active or blocked.',
        ];
    }
}
