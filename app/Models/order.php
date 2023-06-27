<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'made_by',
        'isChanged'

    ];

//defining the inverse relationship that will allow user model to
//acces the order model

public function user(){
    return $this->belongsTo(user::class);
}
 /**
  * defining the many to mamy relation order hs with food model
  */

public function foods(){
    return $this->belongsToMany(food::class);
}
}
