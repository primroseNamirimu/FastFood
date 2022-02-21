<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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
        $userID = Auth::user()->id;

            $queryadmin = DB::table('food_order')
            ->join('food', 'food.id', '=', 'food_order.food_id')
            ->join('orders', 'orders.id', '=', 'food_order.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('food_order.order_id', 'orders.id', DB::raw('SUM(food.price) as total'), 'orders.created_at', 'food.name','users.firstname')
            ->groupBy('order_id','orders.id','food_order.order_id','orders.created_at','food.name','users.firstname')
            ->where('users.id', $userID)
            ->where('food.price','>','0')

            ->whereMonth('food_order.created_at', date('m'))

            ->limit(10)->get();

        return view('adminBlades.adminHome', ["queryadmin" => $queryadmin]);
  
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
