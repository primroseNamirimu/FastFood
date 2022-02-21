<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use PhpParser\Node\Stmt\Foreach_;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class AdminReportController extends Controller
{
    public function currentMonth(){
       
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.lastname','food.name','users.firstname')
        ->groupBy('order_id','orders.created_at','users.lastname','users.firstname','food.name')
       ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();
        
         return view('reports.adminReport',["query"=>$query]);
        
      
        
    } 

    public function currentMonth_user(){
        $id = Auth::user()->id;
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.id','food.name','users.lastname','users.firstname')
        ->groupBy('order_id','orders.created_at','users.lastname','users.firstname','users.id','food.name')
        ->where('users.id',$id)
        ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();

         return view('reports.userReport',["query"=>$query]);
        
      
        
    } 

    public function index(Request $request){
       
         if( $request->ajax()){
                     
                     
             if (!empty($_GET['endDate']) && !empty($_GET['startDate'])) {
                $end =   $_GET['endDate'];
                $start   = $_GET['startDate'];   	
                           
                $query = DB::table('food_order')
                ->join('food','food.id','=','food_order.food_id')
                ->join('orders','orders.id','=','food_order.order_id')
                ->join('users','users.id','=','orders.user_id')
                ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.firstname')
                ->groupBy('order_id')
                ->whereBetween('food_order.created_at',[$end,$start]);
               

                return datatables($query)->make(true);
                    }
           
        }   
        }

public function foodItems(Request $request){
   // $userID = Auth::user()->id;
    
    if ( $request->ajax()){
            

       if (!empty($_GET['orderID'])){

        $orderID = $_GET['orderID'];
        $firstname = $_GET['firstname'];

            $query = DB::table('food_order')
            ->join('food','food.id','=','food_order.food_id')
            ->join('orders','orders.id','=','food_order.order_id')
            ->join('users','users.id','=','orders.user_id')                
            ->select('food.name')
            ->where('order_id',$orderID)
            ->where('users.firstname',$firstname)->get();
        return response()->json($query, 200);
        
               //return view('auth.login');
        // dd($query);
      
         } 
         else {
                echo("empty order");
         }
   } 

    
        }
       
}

