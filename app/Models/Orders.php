<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $fillable = [
        'user_id',
        'debtors_id',
        'slip_id',
        'total_price',
        'type_sale	',
        'amount',
        'change',
        'type',
        'fix',
        'fix_cost'
    ];
    protected $casts = [
        'listall' => 'array',
        'listcount' => 'array',
        'listprice' => 'array',
    ];
    use HasFactory;

   

    public function testto()
    {

        return $this->hasMany(Debtors::class, 'id', 'debtors_id');

    }

    public function booktouser()
    {

        return $this->hasMany(Debtors::class, 'id', 'user_id');

    }
}
