<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterAvailableCarsRequest extends FormRequest
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
            'employee_id' => 'integer|exists:employees,id',
            'start_time' => 'date|after:now',
            'end_time' => 'date|after:start_time',
            'model_id' => 'nullable|integer|exists:cars,id',
            'comfort_category_id' => 'nullable|exists:comfort_categories,id',
        ];
    }
}
