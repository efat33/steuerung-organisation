<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuccessRateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'technisch_von' => ['required'],
            'technisch_zu' => ['required'],
            'wartung_von' => ['required'],
            'wartung_zu' => ['required'],
        ];
    }
}
