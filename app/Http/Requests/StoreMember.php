<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMember extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:100',
                    'account' => 'required|max:25',
                    'password' => 'required|min:8',
                    'image' => 'mimes:jpeg,jpg,png,gif|required|max:10240',
                    'email' => 'required|email|unique:members',
                    'is_admin' => 'required',
                ];
                // no break
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name' => 'required|max:100',
                    'account' => 'required|max:25',
                    'password' => 'required|min:8',
                    'image' => 'mimes:jpeg,jpg,png,gif|required|max:10240',
                    'is_admin' => 'required',
                    'email' =>  [
                        'required',
                        Rule::unique('members')->ignore($this->member),
                    ]
                ];
                // no break
            }
            default: break;
        }
    }
}
