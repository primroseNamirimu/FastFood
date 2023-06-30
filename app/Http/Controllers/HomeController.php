<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order_management;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        if (Auth::check()) {
            auth::logout();
            return redirect()->route('login');
        //  ->with('success','Succesfuly registered, You can login now');

        }
        else {
            auth::logout();
            return view('auth.login');
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function admin()

    {
            $queryadmin = DB::table('food_order')
            ->join('food', 'food.id', '=', 'food_order.food_id')
            ->join('orders', 'orders.id', '=', 'food_order.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('food_order.order_id','orders.isChanged', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
            ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')

            ->where('food.price','>','0')

            ->whereMonth('food_order.created_at', date('m'))
                ->orderBy('orders.created_at','desc')

            ->limit(10)->get();

//            dd($queryadmin);
        return view('new-views.admin.admin', ["queryadmin" => $queryadmin]);

}


    public function fetchOrders(Request $request){
        $userID = Auth::user()->is_admin;
        $all_results = [];
        $other = [3,4,5,6];

        if ( $request->ajax()){
            if($userID) {
                $result = DB::select(' SELECT YEAR(created_at) AS year, MONTHNAME(created_at) AS month, COUNT(*) AS total
                                FROM orders GROUP BY YEAR(created_at), MONTHNAME(created_at)
                                            ORDER BY YEAR(created_at), MONTHNAME(created_at) DESC');


            } else {
                $userID = Auth::user()->id;
                $result = DB::select("SELECT YEAR(orders.created_at) AS year, MONTHNAME(orders.created_at) AS month,SUM(food.price) as total, COUNT(*) AS count FROM food_order
                                                                          INNER JOIN food ON food.id = food_order.food_id
                                                       INNER JOIN orders ON orders.id = food_order.order_id
                                                       INNER JOIN users ON users.id=orders.user_id WHERE user_id = '$userID'
                                                        GROUP BY YEAR(orders.created_at), MONTHNAME(orders.created_at)
                                                        ORDER BY YEAR(orders.created_at), MONTHNAME(orders.created_at) DESC");
            }


            array_push($all_results,$result,$other);

            return response()->json($all_results, 200);

      }


    }

    public function fetchAnalytics(Request $request){

        $all_results = [];

        if ( $request->ajax()){

            $total = DB::table('food_order')
            ->join('food', 'food.id', '=', 'food_order.food_id')
            ->join('orders', 'orders.id', '=', 'food_order.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select( DB::raw('SUM(food.price) as total'))
            ->where('food.price','>','0')
                ->whereYear('food_order.created_at','=',now())
                ->whereMonth('food_order.created_at','=',now())
            ->orderBy('orders.created_at','desc')
            ->get();

           $arr = $total->toArray();

            $order_count = DB::select(' SELECT YEAR(created_at) AS year, MONTHNAME(created_at) AS month, COUNT(*) AS count
                                FROM orders  WHERE YEAR(created_at)  = YEAR(now()) AND MONTHNAME(created_at) = MONTHNAME(now())
                                            GROUP BY YEAR(created_at), MONTHNAME(created_at)
                                            ORDER BY YEAR(created_at), MONTHNAME(created_at) DESC');

            $changed_count = DB::select(' SELECT YEAR(created_at) AS year, MONTHNAME(created_at) AS month, COUNT(*) AS count
                                FROM changed_orders
                                 WHERE YEAR(created_at) = YEAR(now()) AND MONTHNAME(created_at) = MONTHNAME(now())
                                 GROUP BY YEAR(created_at), MONTHNAME(created_at)
                                            ORDER BY YEAR(created_at), MONTHNAME(created_at) DESC');
            $deleted_count = DB::select(' SELECT YEAR(deleted_on) AS year, MONTHNAME(deleted_on) AS month, COUNT(*) AS count
                                FROM audit_deletes
                                 WHERE YEAR(deleted_on) = YEAR(now()) AND MONTHNAME(deleted_on) = MONTHNAME(now())
                                 GROUP BY YEAR(deleted_on), MONTHNAME(deleted_on)
                                            ORDER BY YEAR(deleted_on), MONTHNAME(deleted_on) DESC');

//            dd($deleted_count);
            array_push($all_results,$order_count,$changed_count,$deleted_count,$arr);

            return response()->json($all_results, 200);

        }

    }

public function userHome(){
    $userID = Auth::user()->id;

    $queryuser = DB::table('food_order')
        ->join('food', 'food.id', '=', 'food_order.food_id')
        ->join('orders', 'orders.id', '=', 'food_order.order_id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->select('food_order.order_id','orders.isChanged', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
        ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')

        ->where('users.id', $userID)
        ->where('food.price','>','0')

        ->whereMonth('food_order.created_at', date('m'))
        ->orderBy('orders.created_at','desc')

        ->limit(10)->get();


    return view('userBlades.userHome', ["queryuser" => $queryuser]);
}

}
