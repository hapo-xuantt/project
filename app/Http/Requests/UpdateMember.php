<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMember extends FormRequest
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
            'name' => 'required|max:100',
            'account' => 'required|max:25',
            'password' => 'required|min:8',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10240',
            'email' => 'required|unique:users,email,$this->id,id',
        ];
    }
}
