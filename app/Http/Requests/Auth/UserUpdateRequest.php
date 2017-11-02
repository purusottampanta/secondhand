<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            // 'country'       => 'required',
            'mobile_phone'  => 'required',
            'street'        => 'required|max:255',
            'area_location' => 'required|max:255',
            'city'          => 'required|max:255'
        ];
    }
}
