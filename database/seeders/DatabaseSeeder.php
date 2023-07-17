<?php

namespace Database\Seeders;

use App\Models\food;
use App\Models\food_order;
use App\Models\order;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Miriam',
            'lastname' => 'Kemi',
            'username' => 'Miriam',
            'email' => 'miriam@fastfood.com',
            'password' => \Illuminate\Support\Facades\Hash::make('miriam@fastfood'),
            'is_admin' => 0,
            'phone' => '0771257993',
            'is_disabled' => 0

        ]);

//        food::create([
//            'name' => 'Beef & Beans',
//            'price' => '7000',
//        ]);

//        order::create([
//            'made_by' => 'Namirimu Primrose',
//            'isChanged' => 'NO',
//            'user_id' => 4,
//            'created_at' => '2023-07-04'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Namirimu Primrose',
//            'food_id' => 5,
//            'order_id' => 28,
//
//            'created_at' => '2023-07-04'
//
//        ]);
//        order::create([
//            'made_by' => 's_admin_last s_admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 1,
//            'created_at' => '2023-07-04'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 's_admin_last s_admin_first',
//            'food_id' => 6,
//            'order_id' => 29,
//
//            'created_at' => '2023-07-04'
//
//        ]);
//        order::create([
//            'made_by' => 'admin_last admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 2 ,
//            'created_at' => '2023-07-04'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'admin_last admin_first',
//            'food_id' => 2,
//            'order_id' => 30,
//
//            'created_at' => '2023-07-04'
//
//        ]);
//        order::create([
//            'made_by' => 'Namirimu Primrose',
//            'isChanged' => 'NO',
//            'user_id' => 4,
//            'created_at' => '2023-07-05'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Namirimu Primrose',
//            'food_id' => 4,
//            'order_id' => 31,
//
//            'created_at' => '2023-07-05'
//
//        ]);
//        order::create([
//            'made_by' => 's_admin_last s_admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 1,
//            'created_at' => '2023-07-05'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 's_admin_last s_admin_first',
//            'food_id' => 6,
//            'order_id' => 32,
//
//            'created_at' => '2023-07-05'
//
//        ]);
//        order::create([
//            'made_by' => 'admin_last admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 2,
//            'created_at' => '2023-07-05'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'admin_last admin_first',
//            'food_id' => 5,
//            'order_id' => 33,
//
//            'created_at' => '2023-07-05'
//
//        ]);

    }
}
