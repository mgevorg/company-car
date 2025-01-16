<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'car_id' => 'required|exists:cars,id',
            'employee_id' => 'required|exists:employees,id',
            'comfort_category_id' => 'required|exists:comfort_categories,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ];
    }
}
