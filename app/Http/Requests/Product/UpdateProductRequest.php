<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'product_name' => 'required|max:191',
            'condition' => 'required',
            'category' => 'required',
            'price' => 'required',
        ];

        if($this->home_delivery){
            $rules['delivery_charge'] = 'required';
        }

        return $rules;
    }

    // /**
    //  * Get the error messages for the defined validation rules.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return [
    //         'image.0.required' => 'First Image is required',
    //     ];
    // }


}
