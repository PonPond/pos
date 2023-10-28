<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $fillable = [
        'order_id',
        'product_id ',
        'quantity	',
        'price',
        'user_auth',

    ];
    use HasFactory;
}
