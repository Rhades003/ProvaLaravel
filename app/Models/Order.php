<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_day',
        'product_id',
        'pickup_time',
        'address',
        'payment_type'
    ];
}
