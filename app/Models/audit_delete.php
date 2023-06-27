<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audit_delete extends Model
{
    use HasFactory;
    protected $table = 'audit_delete';

    protected $fillable = [
        'order_id',
        'food_id',
        'deleted_by',
        'order_for',
        'order_created_at',
        'deleted_on',
        'reason'
    ];
}
