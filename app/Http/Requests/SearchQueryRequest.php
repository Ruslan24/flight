<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'searchQuery.departureAirport' => "required|string|min:3|max:3",
            'searchQuery.arrivalAirport' => "required|string|min:3|max:3",
            'searchQuery.departureDate' => "required|string|date_format:Y-m-d",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'searchQuery.departureAirport.required' => 'Invalid request.',
            'searchQuery.arrivalAirport.required' => 'Invalid request.',
            'searchQuery.departureDate.required' => 'Invalid request.',
            'searchQuery.departureAirport.min' => 'Wrong departure airport',
            'searchQuery.departureAirport.max' => 'Wrong departure airport',
            'searchQuery.arrivalAirport.min' => 'Wrong destination airport',
            'searchQuery.arrivalAirport.max' => 'Wrong destination airport',
            'searchQuery.departureDate.date_format' => 'Flight date is incorrect',
        ];
    }
}
