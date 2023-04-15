<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:200|sometimes',
            'email' => 'sometimes|required|email|unique:users,email'.null,
            'phone' => 'required|starts_with:0|min:100000000|max:999999999|numeric|sometimes',
            'password' => 'sometimes|required|string|min:3|max:20',
            'city' => 'required|sometimes|string|max:50'
        ];
    }
}
