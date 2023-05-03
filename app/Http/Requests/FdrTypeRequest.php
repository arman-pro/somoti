<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FdrTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['fdrType-create', 'fdrType-update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string"],
            "code" => ["required", "max:5", "unique:fdrtypes,code," . optional($this->fdrType)->id],
            "duration" => ["required"],
            "interest_rate" => ["required"],
        ];
    }
}
