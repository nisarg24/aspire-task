<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
    public function rules()
    {
        return [
            "amount" => "required|numeric|gt:0",
            "term" => "required|numeric|gt:0",
            "is_month" => "required|min:0|max:1",
            "start_date" => "required|date|date_format:Y-m-d|after_or_equal:today"
        ];
    }
}
