<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['loanType-create', 'loanType-update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'string'],
            'code'          => ['required', 'unique:loantypes,code,'. optional($this->loanType)->id],
            'day_repay'     => ['required'],
            'interest_rate' => ['required'],
            'active_status' => ['nullable'],
        ];
    }
}
