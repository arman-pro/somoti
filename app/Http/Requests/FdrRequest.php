<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FdrRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['fdr-create', 'fdr-update']);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'member_id' => 'member',
            'fdrtype_id' => 'fdr type',
        ];
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
            "fdrtype_id" => ['required', 'numeric'],
            "account" => ['required'],
            "fdr_amount" => ['required', 'integer'],
            "return_interest" => ['required', 'integer'],
            "start_date" => ['required', 'date_format:'.filterDateFormat().''],
            "expire_date" => ['required', 'date_format:'.filterDateFormat().''],
            "refer_member" => ['required', 'numeric'],
            "refer_user" => ['required', 'numeric'],
            "comment" => ['nullable'],
        ];
    }
}
