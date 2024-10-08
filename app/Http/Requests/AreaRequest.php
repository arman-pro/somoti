<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'branch_id' => 'branch',
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
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'unique:areas,name,'.optional($this->area)->id],
            'code' => ['required', 'string', 'unique:areas,code,'.optional($this->area)->id],
            'active_status' => ['nullable'],
        ];
    }
}
