<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use PhpParser\Node\Stmt\Foreach_;
use Yajra\DataTables\DataTables;


class AdminReportController extends Controller
{
    public function currentMonth(){
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.lastname','users.firstname')
        ->groupBy('order_id','orders.created_at','users.lastname','users.firstname')
        ->whereMonth('food_order.created_at',date('m'))->get();

         return view('reports.adminReport',["query"=>$query]);



    }

    /**
     * @throws Exception
     */
    public function index(Request $request){

         if( $request->ajax()){
                     $is_admin = Auth::user()->is_admin;
                     $user_id = Auth::user()->id;


             if (!empty($_GET['endDate']) && !empty($_GET['startDate'])) {
                $end =   $_GET['endDate'];
                $start   = $_GET['startDate'];
                if($is_admin == 1){
                    $query = DB::table('food_order')
                        ->join('food','food.id','=','food_order.food_id')
                        ->join('orders','orders.id','=','food_order.order_id')
                        ->join('users','users.id','=','orders.user_id')
                        ->select('food_order.order_id', 'orders.made_by',DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'orders.isChanged','users.firstname','users.lastname','food.name')
                        ->groupBy('order_id')
                        ->groupBy('food.name')
                        ->whereBetween('food_order.created_at',[$end,$start]);

                } else {
                    $query = DB::table('food_order')
                        ->join('food','food.id','=','food_order.food_id')
                        ->join('orders','orders.id','=','food_order.order_id')
                        ->join('users','users.id','=','orders.user_id')
                        ->select('food_order.order_id', 'orders.made_by',DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'orders.isChanged','users.firstname','users.lastname','food.name')
                        ->groupBy('order_id')
                        ->groupBy('food.name')
                        ->whereBetween('food_order.created_at',[$end,$start])
                    ->where('users.id','=',$user_id);


                }
                 return datatables($query)->make(true);


             }

        }
         return Exception::class;
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

