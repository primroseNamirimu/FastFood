<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER delete_audit BEFORE DELETE ON `order` FOR EACH ROW
        BEGIN
        INSERT INTO order_audit_delete SET order_for = OLD.users.lastname
        
        ,
        deleted_by = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.food_order.order_made_by`)
        ->groupBy(`food_order.order_made_by`)->get()'),
        order_contents = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.food.name`)
        ->groupBy(`food.name`)->get()'),
        order_creation_date = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.orders.created_at`)
        ->groupBy(`orders.created_at`)->get()'),
        deletion_time = NOW();
        END
        ");
       
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `delete_audit`');
    }
}
