<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name.*' => 'required|min:2',
            'last_name.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.*.required' => 'Trường First name không được để trống!',
            'first_name.*.min' => 'Trường First name có ít nhất 2 ký tự!',
            'last_name.*.required' => 'Trường Last name không được để trống!',
        ];
    }
}
