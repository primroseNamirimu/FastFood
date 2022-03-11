<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER delete_log BEFORE DELETE ON `orders` FOR EACH ROW
        BEGIN
        INSERT INTO order_audit_delete SET order_for = OLD.user_id,
      
        order_creation_date = OLD.created_at,
        order_id = OLD.id,

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
        DB::unprepared('DROP TRIGGER `delete_log`');
    }
}
