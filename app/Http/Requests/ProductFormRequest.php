<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductFormRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_published' => 'required|string',
            'cost' => 'required|numeric|min:50',
            'break_even_price' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) 
                {
                    if ($value < $this->input('cost') + 30) {
                        $fail('The break even price must be at least 30 units higher than the cost.');
                    }
                },
            ],
            'lowest_selling_price' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) 
                {
                    if ($value < $this->input('break_even_price') + 20) {
                        $fail('The lowest selling price must be at least 20 units higher than the break even price.');
                    }
                },
            ],
        ];
    }
}
