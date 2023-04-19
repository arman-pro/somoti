<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            "area_id" => ['required'],
            "name" => ["required", "string", "unique:groups,name,". optional($this->group)->id],
            "code" => ["required", "numeric", "unique:groups,code,". optional($this->group)->id],
            "active_status" => ["nullable"],
        ];
    }
}
