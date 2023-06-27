<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangedOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'original_food_id',
        'new_food_id',
        'changed_by',
        'order_for',
        'created_at',
        'changed_on',
        'reason'
    ];
}
