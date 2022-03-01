<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food_order extends Model
{
    use HasFactory;
    protected $table = 'food_order';

    protected $fillable = [
        'food_id',
        'order_id',
        'order_made_by',
    ];
}
