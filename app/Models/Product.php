<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'brand_id',
        'admin_created',
        'admin_updated'
    ];

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function thumbs()
    {
        return $this->hasMany(Thumb::class);
    }

    public function getThumb()
    {
        try {
            return $url = $this->thumbs->first()->url;
        } catch (\Throwable $th) {
            return '/img/noImg.png';
        }
    }
}
