<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FoodOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_order', function (Blueprint $table) {
            $table->id();
            $table->string('order_made_by');
            $table->string('Changed_by');
            $table->foreignId('food_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('order_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
         $table->foreign('order_made_by')->references('made_by')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_order');
    }
}
