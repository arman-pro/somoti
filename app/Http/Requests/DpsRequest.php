<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['dps-create', 'dps-update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "date" => ['required', 'date_format:'.filterDateFormat().''],
            "member_id" => ['required', 'numeric'],
            "dpstype_id" => ['required', 'numeric'],
            "account" => ['required'],
            "amount_per_installment" => ['required', 'integer'],
            "number_of_installment" => ['required', 'integer'],
            "start_date" => ['required', 'date_format:'.filterDateFormat().''],
            "expire_date" => ['required', 'date_format:'.filterDateFormat().''],
            "fine_missing_dps" => ['required', 'integer'],
            "profit" => ['required', 'integer'],
            "total_amount" => ['required', 'integer'],
            "comment" => ['nullable'],
        ];
    }
}
