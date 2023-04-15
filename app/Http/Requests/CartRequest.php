<?php

namespace App\Http\Requests;

use App\Models\DetailProduct;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        $quantity = 10;
        if(isset($this->detail_product_id)){
            $detailProduct = DetailProduct::where('id', $this->detail_product_id)->get();
            $quantity = $detailProduct[0]->quantity;
        }
        return [
            'size_id' => 'required|sometimes|int|min:0',
            'detail_product_id' => 'required|sometimes|int|min:0',
            'payment' => 'required|sometimes|int|min:0|max:2',
            'city' => 'required|sometimes|string|max:50',
            'district' => 'required|sometimes|string|max:50',
            'ward' => 'required|sometimes|string|max:50',
            'number' => 'required|sometimes|string|max:50',
            'quantity' => 'sometimes|int|max:' . $quantity,

        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng chọn :attribute'
        ];
    }
    public function attributes()
    {
        return [
            'size_id' => 'kích cỡ sản phẩm',
            'detail_product_id' => 'màu sản phẩm'
        ];
    }
}
