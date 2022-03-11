<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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

        // $deletedOrders = order_management::all();
        // foreach($deletedOrders as $op){
        //     $user = $op->order_for;
        //     $order = $op->order_id;
        // }
        // $userName = User::find($user);
      
        // $orderContent = DB::table('food')
        // ->join('food_order','food.id','=','food_order.food_id')
        // ->join('orders','orders.id','=','food_order.order_id')
        // ->select('food.name')
        // ->where('order_id',$order)
        // ->get();
        // $combined = $userName->merge($orderContent);
         //dd($orderContent);

        // $query = DB::table('order_audit_delete')
        // ->join('orders','orders.id','=','order_audit_delete.order_id')
        // ->join('users','users.id','=','orders.user_id')
        
        
        // ->select('users.username',DB::raw('DATE_FORMAT(order_audit_delete.deletion_time,"%d/%m/Y") as deletion_time'),
        // DB::raw('DATE_FORMAT(order_audit_delete.order_creation_date,"%d/%m/Y") as order_creation_date'))
       
        // ->where('user_id',$user)
        // ->where('order_id',$order)->get();

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
