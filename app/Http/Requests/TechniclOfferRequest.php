<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechniclOfferRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'get_over' => ['string', 'max:50'],
            'get_over' => ['required'],
            'cs_order_number' => ['numeric', 'max:9223372036854775807'],
            'received_date' => ['required'],
            'received_from' => ['nullable', 'string', 'max:50'],
            'customer_number' => ['nullable', 'string', 'max:10'],
            'technical_place' => ['nullable', 'string', 'max:10'],
            'technical_place_address' => ['required', 'string', 'max:100'],
            'technical_postcode' => ['nullable', 'string', 'max:4'],
            'status' => ['required', 'string', 'max:50'],
            // 'offer_type' => ['nullable', 'string', 'max:10'],
            'ktb_number' => ['digits_between:0,10'],
            'quote_number' => ['digits_between:0,10'],
            // 'conversation_status' => ['string', 'max:100'],
            'order_number' => ['digits_between:0,10'],
            'offer_amount' => ['nullable', 'numeric', 'min:0.00', 'max:99999999999.99'],
            'order_amount' => ['nullable', 'numeric', 'min:0.00', 'max:99999999999.99'],
            'invice_amount' => ['nullable', 'numeric', 'min:0.00', 'max:99999999999.99'],
            'notes' => ['nullable', 'string'],

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
            'order_amount' => 'This filed take decimal and 13 degits maximum',
            'invice_amount' => 'This filed take decimal and 13 degits maximum',
            'cs_order_number.max' => 'This filed exceeds the limit',
        ];
    }
}
