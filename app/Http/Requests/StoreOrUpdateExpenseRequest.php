<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateExpenseRequest extends FormRequest
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
            'description' => 'required|max:191',
            'date' => 'required|date|before_or_equal:today',
            'value' => 'required|numeric|min:0'
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'The description is required.',
            'description.max' => 'The description may not be greater than 191 characters.',

            'date.required' => 'The date is required.',
            'date.date' => 'The date is not a valid date.',
            'date.before_or_equal' => 'The date may not be in the future.',

            'value.required' => 'The value is required.',
            'value.numeric' => 'The value must be a number.',
            'value.min' => 'The value must not be negative.'
        ];
    }
}
