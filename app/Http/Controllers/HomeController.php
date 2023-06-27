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
            ->select('food_order.order_id','orders.isChanged', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d/%m/%Y") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
            ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')

            ->where('food.price','>','0')

            ->whereMonth('food_order.created_at', date('m'))
                ->orderBy('orders.created_at','desc')

            ->limit(10)->get();

//            dd($queryadmin);
        return view('new-views.admin.admin', ["queryadmin" => $queryadmin]);

}

    public function prev()

    {

        $userID = Auth::user()->id;

        $queryadmin = DB::table('food_order')
            ->join('food', 'food.id', '=', 'food_order.food_id')
            ->join('orders', 'orders.id', '=', 'food_order.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),DB::raw('DATE_FORMAT(orders.created_at,"%d/%m/%Y at %h:%m:%s") as created_at'),'users.lastname','food.name','users.firstname','food_order.order_made_by')
            ->groupBy('order_id','orders.created_at','users.lastname','food_order.order_made_by','users.firstname','food.name')

            ->where('food.price','>','0')

            ->whereMonth('food_order.created_at', date('m'))

            ->limit(10)->get();

        return view('adminBlades.adminHome', ["queryadmin" => $queryadmin]);

    }
    public function fetchOrders(Request $request){
        $all_results = [];
        $other = [3,4,5,6];
//        $q = DB::table('orders')->select('YEAR(created_at) as year','MONTHNAME(created_at) as month',DB::raw('count(*) as count)'))
//            ->groupBy('YEAR(created_at)','MONTHNAME(created_at)')
//            ->orderBy('YEAR(created_at)','desc')
//            ->orderBy('MONTHNAME(created_at)')->get();

        if ( $request->ajax()){

            $result = DB::select(' SELECT YEAR(created_at) AS year, MONTHNAME(created_at) AS month, COUNT(*) AS count
                                FROM orders GROUP BY YEAR(created_at), MONTHNAME(created_at)
                                            ORDER BY YEAR(created_at), MONTHNAME(created_at) DESC');

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

            sumt($total);
           $arr = $total[3];
            $sum = 0;

//           $sum = 0;
//

//            var_dump($sum);
//            echo($sum);
            $arry = [$arr];

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
            array_push($all_results,$order_count,$changed_count,$deleted_count,$arry);

            return response()->json($all_results, 200);

        }

    }

    public function sumt(Collection $i){
        foreach ($arr as $item){

            $sum += $item->total;
        }
    }

public function userHome(){
    $userID = Auth::user()->id;

    $queryuser = DB::table('food_order')
    ->join('food', 'food.id', '=', 'food_order.food_id')
    ->join('orders', 'orders.id', '=', 'food_order.order_id')
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->select('food_order.order_id', 'orders.id', DB::raw('SUM(food.price) as total'),'orders.created_at', 'food.name','users.firstname','users.lastname')
    ->groupBy('order_id','orders.id','orders.created_at','users.firstname','food.name','users.lastname')
    ->where('users.id', $userID)
    ->where('food.price','>','0')
    ->whereMonth('food_order.created_at', date('m'))

    ->limit(10)->get();

return view('userBlades.userHome', ["queryuser" => $queryuser]);
}

}
