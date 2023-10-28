<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'name',
        'priceP',
        'priceS',
        'qty',
        'category_id',
    ];

    public function propro()
    {
        return $this->hasMany(Categories::class, 'id', 'category_id');
    }

}
