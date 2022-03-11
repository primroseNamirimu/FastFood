<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chartController extends Controller
{
    public function lineGraph(){
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d/%m/%Y") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
        ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')
       ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();
      
        
        return view('adminBlades.adminHome', ["query" => $query]);
    }
}
