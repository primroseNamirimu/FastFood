<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use PhpParser\Node\Stmt\Foreach_;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class adminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function currentMonth(){

        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id','users.email', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
        ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')
       ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();

         return view('reports.adminReport',["adminReport"=>$query]);

    }

    function userReport($id){

        $query = DB::table('food_order')
            ->join('food','food.id','=','food_order.food_id')
            ->join('orders','orders.id','=','food_order.order_id')
            ->join('users','users.id','=','orders.user_id')
            ->select('food_order.order_id','food_order.order_made_by', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d/%m/%Y") as created_at'),'users.id','food.name','users.lastname','users.firstname')
            ->groupBy('order_id','food_order.order_made_by','orders.created_at','users.lastname','users.firstname','users.id','food.name')
            ->where('users.id',$id)
            ->where('food.price','>','0')
            ->whereMonth('food_order.created_at',date('m'))->get();

        return view('reports.userReportAdmin',["query"=>$query]);
    }


    public function currentMonth_user(){
        $id = Auth::user()->id;
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id','food_order.order_made_by', DB::raw('SUM(food.price) as total'),'orders.created_at','users.id','food.name','users.lastname','users.firstname')
        ->groupBy('order_id','food_order.order_made_by','orders.created_at','users.lastname','users.firstname','users.id','food.name')
        ->where('users.id',$id)
        ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();

         return view('reports.userReport',["query"=>$query]);

    }

    public function index(Request $request){

        $user = Auth::user()->is_admin;
         if( $request->ajax()){
             if (!empty($_GET['endDate']) && !empty($_GET['startDate'])) {
                $end =   $_GET['endDate'];
                $start   = $_GET['startDate'];

                if($user){
                    $query3 = DB::table('food_order')
                        ->join('food','food.id','=','food_order.food_id')
                        ->join('orders','orders.id','=','food_order.order_id')
                        ->join('users','users.id','=','orders.user_id')
                        ->select('food_order.order_id','orders.isChanged','food_order.order_made_by', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'users.id','food.name','users.lastname','users.firstname')
                        ->groupBy('order_id','food_order.order_made_by','orders.created_at','users.lastname','users.firstname','users.id','food.name')
                        ->where('food.price','>','0')
                        ->whereBetween('food_order.created_at',[$end,$start]);
                }
                else {
                    $user = Auth::user()->id;
                    $query3 = DB::table('food_order')
                        ->join('food','food.id','=','food_order.food_id')
                        ->join('orders','orders.id','=','food_order.order_id')
                        ->join('users','users.id','=','orders.user_id')
                        ->select('food_order.order_id','orders.isChanged','food_order.order_made_by', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'users.id','food.name','users.lastname','users.firstname')
                        ->groupBy('order_id','food_order.order_made_by','orders.created_at','users.lastname','users.firstname','users.id','food.name')
                        ->where('food.price','>','0')
                        ->where('users.id','=',$user)
                        ->whereBetween('food_order.created_at',[$end,$start]);
                }


                 try {
                     return datatables($query3)->make(true);
                 } catch (\Exception $e) {

                 }
             }

        }
        }



public function foodItems(Request $request){
   // $userID = Auth::user()->id;

    if ( $request->ajax()){


       if (!empty($_GET['orderID'])){

        $orderID = $_GET['orderID'];
        $email = $_GET['email'];

            $query = DB::table('food_order')
            ->join('food','food.id','=','food_order.food_id')
            ->join('orders','orders.id','=','food_order.order_id')
            ->join('users','users.id','=','orders.user_id')
            ->select('food.name','food_order.order_id')
            ->where('order_id',$orderID)
            ->where('users.email',$email)->get();
//           dd($query);
        return response()->json($query, 200);

               //return view('auth.login');


         }
         else {
                echo("empty order");
         }
   }


        }

}

