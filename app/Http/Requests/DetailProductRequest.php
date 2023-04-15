<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DetailProductRequest extends FormRequest
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
            'size_id' => [
                'required', 'integer', 'min:0','max:100000000000',
                Rule::unique('detail_products')->where(function ($query) {
                    return $query->where('color_id', $this->input('color_id'))->where('product_id', $this->product_id);
                })->ignore($this->id)
            ],
            'color_id' => 'required|integer|min:0|max:100000000000',
            'quantity' => 'required|integer|min:1|max:100000000000'
        ];
    }
}
