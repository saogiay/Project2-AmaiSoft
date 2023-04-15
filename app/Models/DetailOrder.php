<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailProduct;

class DetailOrder extends Model
{
    use HasFactory;
    protected $table = 'detail_order';
    protected $fillable =[
        'order_id',
        'detail_product_id',
        'price',
        'quantity'
    ];

    public function details(){
        return $this->belongsTo(DetailProduct::class,'detail_product_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'detail_product_id');
    }
}
