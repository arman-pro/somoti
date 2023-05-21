<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SharePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['sharePurchase-create', 'sharePurchase-update']);
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
            "vouchar_no" => ['nullable', 'unique:sharepurchases,vouchar_no,'.optional($this->share_purchase)->id],
            "amount" => ['required', 'numeric'],
            "member_id" => ['required', 'numeric'],
            "comment" => ['nullable'],
        ];
    }
}
