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
use Illuminate\Support\Facades\Auth;

class adminReportController extends Controller
{
    public function currentMonth()
    {
        if (Auth::user()->is_admin == 1) {
            $query = DB::table('food_order')
                ->join('food', 'food.id', '=', 'food_order.food_id')
                ->join('orders', 'orders.id', '=', 'food_order.order_id')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select('food_order.order_id', DB::raw('SUM(food.price) as total'), 'orders.created_at', 'users.firstname', 'users.lastname')
                ->groupBy('order_id')
                ->whereMonth('food_order.created_at', date('m'))->get();

            return view('reports.adminReport', ["query" => $query]);
        }
        else {
            $userID = Auth::user()->id;

            $query = DB::table('food_order')
                ->join('food', 'food.id', '=', 'food_order.food_id')
                ->join('orders', 'orders.id', '=', 'food_order.order_id')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select('food_order.order_id', DB::raw('SUM(food.price) as total'), 'orders.created_at', 'users.firstname', 'users.lastname')
                ->groupBy('order_id')
                ->where('users.id', $userID)
                ->whereMonth('food_order.created_at', date('m'))->get();

            return view('reports.userReport', ["query" => $query]);
        }



    }
    public function recentOrders()
    {

        $userID = Auth::user()->id;
        $query = DB::table('food_order')
            ->join('food', 'food.id', '=', 'food_order.food_id')
            ->join('orders', 'orders.id', '=', 'food_order.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('food_order.order_id', 'orders.id', DB::raw('SUM(food.price) as total'), 'orders.created_at', 'users.firstname')
            ->groupBy('order_id')
            ->where('users.id', $userID)

            ->whereMonth('food_order.created_at', date('m'))

            ->limit(10)->get();

        return view('userBlades.userHome', ["query" => $query]);
    }
    // return view ('user.userHome');    }


    public function index(Request $request)
    {

        if ($request->ajax()) {


            if (!empty($_GET['endDate']) && !empty($_GET['startDate'])) {
                $end = $_GET['endDate'];
                $start = $_GET['startDate'];

                $query = DB::table('food_order')
                    ->join('food', 'food.id', '=', 'food_order.food_id')
                    ->join('orders', 'orders.id', '=', 'food_order.order_id')
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->select('food_order.order_id', DB::raw('SUM(food.price) as total'), 'orders.created_at', 'users.firstname')
                    ->groupBy('order_id')
                    ->whereBetween('food_order.created_at', [$end, $start]);


                return datatables($query)->make(true);

            }

        }



    }
    public function foodItems(Request $request)
    {
        // $userID = Auth::user()->id;
        if (Auth::user()->is_admin == 1) {
            if ($request->ajax()) {

                if (!empty($_GET['orderID'])) {

                    $orderID = $_GET['orderID'];
                    $firstname = $_GET['firstname'];

                    $query = DB::table('food_order')
                        ->join('food', 'food.id', '=', 'food_order.food_id')
                        ->join('orders', 'orders.id', '=', 'food_order.order_id')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('food.name')
                        ->where('order_id', $orderID)
                        ->where('users.firstname', $firstname)->get();
                    return response()->json($query, 200);
                // // echo ($data);
                //  dd($query);

                }
            }
        }
        else {
            $userID = Auth::user()->id;

            if ($request->ajax()) {

                if (!empty($_GET['orderID'])) {

                    $orderID = $_GET['orderID'];

                    //echo($orderID);
                    $query = DB::table('food_order')
                        ->join('food', 'food.id', '=', 'food_order.food_id')
                        ->join('orders', 'orders.id', '=', 'food_order.order_id')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('food.name')
                        ->where('order_id', $orderID)
                        ->where('users.id', $userID)->get();
                    return response()->json($query, 200);

                }

            }

        
}    }
}



