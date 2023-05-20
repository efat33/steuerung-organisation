<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceOfferRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'get_over' => ['required'],
            'cs_order_number' => ['nullable', 'numeric', 'max:9223372036854775807'],
            'received_date' => ['required'],
            'received_from' => ['nullable', 'string', 'max:50'],
            'customer_number' => ['nullable', 'string', 'max:10'],
            'technical_place' => ['nullable', 'string', 'max:10'],
            'technical_place_address' => ['required', 'string', 'max:100'],
            'technical_postcode' => ['nullable', 'string', 'max:4'],
            'status' => ['required', 'string', 'max:50'],
            'ktb_number' => ['digits_between:0,10'],
            'quote_number' => ['digits_between:0,10'],
            'offer_amount' => ['nullable', 'numeric', 'min:0.00', 'max:99999999999.99'],
            'maintenance_contact' => ['nullable', 'numeric', 'max:9223372036854775807'],
            'sum_per_year' => ['nullable', 'numeric', 'min:0.00', 'max:99999999999.99'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'offer_amount' => 'This filed take decimal and 13 degits maximum',
            'sum_per_year' => 'This filed take decimal and 13 degits maximum',
            'cs_order_number.max' => 'This filed exceeds the limit',
            'maintenance_contact.max' => 'This filed exceeds the limit',
        ];
    }
}
