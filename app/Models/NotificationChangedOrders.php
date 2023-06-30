<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationChangedOrders extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function up()
    {
        Schema::create('NotificationChangedOrders', function (Blueprint $table) {
            $table->id();
            $table->string('changedOrder');
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
}
