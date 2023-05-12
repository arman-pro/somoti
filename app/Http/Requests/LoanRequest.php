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
        return $this->user()->canany(['loan-create', 'loan-update']);
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
            'loantype_id' => 'loan type',
            'amount' => 'loan amount',
            'interest' => 'loan interest',
            'ref_user_id' => 'ref user name',
            'ref_member_id' => 'ref member name',
            'guarantor_father' => 'guarantor father name',
            'guarantor_relation' => 'guarantor relation',
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
            'date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'member_id' => ['required', 'numeric'],
            'mobile' => ['required'],
            'account' => ['required'],
            'loantype_id' => ['required', 'numeric'],
            'amount' => ['required', 'integer'],
            'interest' => ['required', 'integer'],
            'total_amount_payable' => ['required', 'integer'],
            'installment_number' => ['required', 'integer'],
            'insurence_amount' => ['required', 'integer'],
            'loan_fee' => ['required', 'integer'],
            'loan_start_date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'loan_end_date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'ref_user_id' => ['required', 'numeric'],
            'ref_member_id' => ['required', 'numeric'],
            'guarantor_name' => ['nullable', 'string'],
            'guarantor_father' => ['nullable', 'string'],
            'guarantor_relation' => ['nullable', 'string'],
            'guarantor_phone' => ['nullable', 'string'],
            'bank_account_number' => ['nullable', 'string'],
            'check_number' => ['nullable', 'string'],
            'file_upload' => ['nullable', "mimes:jpg,png,pdf", "max:1000"],
            'security_docs' => ['nullable', "mimes:jpg,png,pdf", "max:1000"],
        ];
    }
}
