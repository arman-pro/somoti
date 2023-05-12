<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['savings-create', 'savings-update']);
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
            "voucher_no" => ['nullable', 'unique:savings,voucher_no,'.optional($this->saving)->id],
            "amount" => ['required', 'numeric'],
            "member_id" => ['required', 'numeric'],
            "comment" => ['nullable'],
        ];
    }
}
