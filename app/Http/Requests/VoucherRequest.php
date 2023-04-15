<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
    {   $id = $this->id;
        return [
            'name' => 'required|max:255|unique:vouchers,name,' .$id ,
            'code' => 'required|max:255|unique:vouchers,code,' .$id ,
            'discount' => 'required|numeric|max:100|min:0',
            'start_day' => 'required',
            'exp' =>'nullable|after:start_day'
        ];
    }
    public function attributes()
    {
        return [
            'code' => 'Mã giảm giá',
            'discount' => 'Mức giảm',
            'start_day' => 'Ngày áp dụng',
            'exp' => 'Hạn sử dụng'
        ];
    }
}
