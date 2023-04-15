<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'vouchers';
    protected $fillable = [
        'name',
        'code',
        'discount',
        'quantity',
        'start_day',
        'exp',
        'status',
        'allow_multi',
        'admin_created',
        'admin_updated',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('quantity', 'admin_created', 'admin_updated')
            ->withTimestamps();
    }

}
