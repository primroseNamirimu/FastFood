<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAuditDeletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_audit_delete', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('order_id');
            $table->integer('food_id');
            $table->string('order_for');
            $table->string('reason',500);
            $table->date('order_created_at');
            $table->string('deleted_by');
            $table->string('deleted_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_audit_deletes');
    }
}
