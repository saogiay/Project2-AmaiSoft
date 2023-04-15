<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='orders';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'payment',
        'status',
        'voucher_id',
        'user_id',
    ];

    public function orderDetails()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
