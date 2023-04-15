<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->id;
        return [
            'name' => 'required|string|max:200|unique:products,name,'.$id,
            'price' => 'required|integer|min:0|max:100000000000',
            'description'=> 'required|string',
            'brand_id' => 'required|integer|min:0|max:100000000000',
            'category_id' => 'required|integer|min:0|max:100000000000'
        ];
    }
}
