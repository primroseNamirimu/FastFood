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
            'password' => \Illuminate\Support\Facades\Hash::make('miriam@dsmagic.com'),
            'is_admin' => 0,
            'phone' => '0771257993',
            'is_disabled' => 0

        ]);


        User::create([
            'firstname' => 'Primrose',
            'lastname' => 'Namirimu',
            'username' => 'Primrose',
            'email' => 'primrose@dsmagic.com',
            'password' => \Illuminate\Support\Facades\Hash::make('primrose@dsmagic.com'),
            'is_admin' => 1,
            'phone' => '0781479007',
            'is_disabled' => 0

        ]);
        User::create([
            'firstname' => 's_admin_first',
            'lastname' => 's_admin_last',
            'username' => 's_admin',
            'email' => 's_admin_last@fastfood.com',
            'password' => \Illuminate\Support\Facades\Hash::make('s_admin_last@fastfood'),
            'is_admin' => 0,
            'phone' => '0771257993',
            'is_disabled' => 0

        ]);
//        User::create([
//            'firstname' => 'admin_first',
//            'lastname' => 'admin_last',
//            'username' => 'admin',
//            'email' => 'admin_last@fastfood.com',
//            'password' => \Illuminate\Support\Facades\Hash::make('admin_last@fastfood'),
//            'is_admin' => 1,
//            'phone' => '0771257993',
//            'is_disabled' => 0
//
//        ]);

        food::create([
            'name' => 'Beef & Beans',
            'price' => '7000',
        ]);
        food::create([
            'name' => 'Chicken',
            'price' => '7000',
        ]);

//        order::create([
//            'made_by' => 'Namirimu Primrose',
//            'isChanged' => 'NO',
//            'user_id' => 7,
//            'created_at' => '2023-07-06'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Namirimu Primrose',
//            'food_id' => 5,
//            'order_id' => 49,
//
//            'created_at' => '2023-07-06'
//
//        ]);
//        order::create([
//            'made_by' => 's_admin_last s_admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 10,
//            'created_at' => '2023-07-06'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 's_admin_last s_admin_first',
//            'food_id' => 6,
//            'order_id' => 44,
//
//            'created_at' => '2023-07-07'
//
//        ]);
//        order::create([
//            'made_by' => 'admin_last admin_first',
//            'isChanged' => 'NO',
//            'user_id' => 9 ,
//            'created_at' => '2023-07-07'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'admin_last admin_first',
//            'food_id' => 2,
//            'order_id' => 45,
//
//            'created_at' => '2023-07-07'
//
//        ]);
//        order::create([
//            'made_by' => 'Kemi Miriam',
//            'isChanged' => 'NO',
//            'user_id' => 7,
//            'created_at' => '2023-07-11'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Kemi Miriam',
//            'food_id' => 7,
//            'order_id' => 53,
//
//            'created_at' => '2023-07-11'
//
//        ]);
//        order::create([
//            'made_by' => 'Kemi Miriam',
//            'isChanged' => 'NO',
//            'user_id' => 7,
//            'created_at' => '2023-07-12'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Kemi Miriam',
//            'food_id' => 1,
//            'order_id' => 54,
//
//            'created_at' => '2023-07-12'
//
//        ]);
//        order::create([
//            'made_by' => 'Kemi Miriam',
//            'isChanged' => 'NO',
//            'user_id' => 7,
//            'created_at' => '2023-07-13'
//
//        ]);
//        food_order::create([
//            'order_made_by' => 'Kemi Miriam',
//            'food_id' => 1,
//            'order_id' => 55,
//
//            'created_at' => '2023-07-13'
//
//        ]);
//
    }
}
