<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->canany(['member-create','member-update']);
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
            'area_id' => 'area',
            'group_id' => 'group',
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
            'join_date' => ['required', 'date_format:'.filterDateFormat().''],
            'member_no' => ['nullable', 'max:6', 'unique:members,member_no,'.optional($this->member)->id],
            'account' => ['nullable', 'max:10', 'unique:members,account,'.optional($this->member)->id],
            'name' => ['required', 'string', 'max:50'],
            'mobile' => ['required', 'max:15'],
            'info.date_of_birth' => ['nullable', 'date_format:'.filterDateFormat().''],
            "branch_id" => ['required'],
            "area_id" => ['required'],
            "group_id" => ['required'],
            "memberProfile" => ['nullable','mimes:jpg,pdf,png', 'max:1000'],
            "nomineeProfile" => ['nullable', 'mimes:jpg,pdf,png', 'max:1000'],
            "member.nid" => ["nullable", "mimes:jpg,png,pdf", "max:1000"],
            "member.other_document" => ["nullable", "mimes:jpg,png,pdf", "max:1000"],
            "nominee_docs.nid" => ["nullable", "mimes:jpg,png,pdf", "max:1000"],
            "nominee_docs.other_document" => ["nullable", "mimes:jpg,png,pdf", "max:1000"],
        ];
    }
}
