<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'manager' => 'required|max:50',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10240',
            'email' => 'required|email|unique:members',
            'phone' => 'required|min:10|max:20',
            'address' => 'required',
        ];
    }
}
