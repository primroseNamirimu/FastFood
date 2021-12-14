<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food_order;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Yajra\DataTables\DataTables;
use phpDocumentor\Reflection\Types\True_;

class adminReportController extends Controller
{
    public function currentMonth(){
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.firstname')
        ->groupBy('order_id')
        ->whereMonth('food_order.created_at',date('m'))->get();

        return view('reports.adminReport',["query"=>$query]);
        
      
        
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
    
            // } 
            // else{
            //     $query = DB::table('food_order')
            //     ->join('food','food.id','=','food_order.food_id')
            //     ->join('orders','orders.id','=','food_order.order_id')
            //     ->join('users','users.id','=','orders.user_id')
            //     ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','orders.user_id','users.firstname')
            //     ->groupBy('order_id');
               
            //     return datatables($query)->make(true);
                
            // }
            $data = array();
        $sub_array = array();
        foreach ($query as $item){
            $sub_array = $item->firstname;
             $sub_array = $item->total;
           
             $sub_array = $item->created_at;
        }
             
                
        $data[] = $sub_array;
        $output = array(
         
              "data"    => $data
             );
             array_multisort($output);
             echo json_encode($output);
    
            return view ('user.adminReport');
           
        }
        
           
       
        }

public function foodItems(Request $request){
   // $userID = Auth::user()->id;
    
    if($request->ajax()){

       if(!empty($_GET['orderID'])){

        $orderID = $_GET['orderID'];
        $firstname = $_GET['firstname'];
        
       //echo($orderID);
            $query = DB::table('food_order')
            ->join('food','food.id','=','food_order.food_id')
            ->join('orders','orders.id','=','food_order.order_id')
            ->join('users','users.id','=','orders.user_id')                
            ->select('food.name')
            ->where('order_id',$orderID)
            ->where('users.firstname',$firstname)->get();
         return response()->json($query, 200);
        // // echo ($data);
        //  dd($query);
      
         } 
   } 

    
        }
       
}

