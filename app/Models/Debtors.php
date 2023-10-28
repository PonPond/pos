<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address ',
        'phone	',
        'status',
        'email ',
        'total_debts',
        'total_payments',

    ];
}
