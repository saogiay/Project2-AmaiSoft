<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailProduct;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable =[
        'user_id',
        'detail_product_id',
        'quantity'
    ];
    public function details(){
        return $this->belongsTo(DetailProduct::class,'detail_product_id');
    }
}
