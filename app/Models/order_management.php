<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_management extends Model
{
    use HasFactory;
    protected $table = 'order_audit_delete';

    protected $fillable = [
        'order_for',
        'deletion_time',
        'order_creation_date',
        'deleted_by',
        'order_id',
       
    ];
}
