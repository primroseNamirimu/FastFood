<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_status extends Model
{
    use HasFactory;
    protected $table = 'order_status';

    protected $fillable = [
        'food_id',
        'order_id'];
}
