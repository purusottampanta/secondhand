<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name'    => 'required|max:255',
            // 'last_name'     => 'required|max:255',
            'slug'          => ['unique:users,slug'],
            'email'         => 'required|email|max:255|unique:users',
            // 'country'       => 'required',
            'password'      => 'required|min:6|confirmed',
            'street'        => 'required|max:255',
            'area_location' => 'required|max:255',
            'city'          => 'required|max:255'
        ];
    }
}
