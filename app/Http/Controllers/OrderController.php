<?php

namespace App\Http\Controllers;

use App\Models\ChangedOrders;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\food;
use App\Models\food_order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menuTable = food::all();
        $users = User::all();

        return view('adminBlades.order', ['menuTable' => $menuTable], ['users' => $users]);
    }

    public function createMenuItem(Request $request)
    {
        $request->validate(['name' => 'required', 'string', 'max:255', 'unique:food', 'price' => 'required', 'numeric',]);
        $name = $request['name'];
        try {

            food::create($request->all());

            return redirect()->route('admin.home')->with('success', $name . " " . 'added successfully to the menu.');

        } catch (Throwable $th) {
            return redirect()->route('admin.home')->with('fail', 'Food already exists!! Search first before opting to create');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $total = $_POST['total'];
        $food_IDS = $_POST['food_ids'];

        if (Auth::user()->is_admin == 1) {

            $checked = $_POST['isForStaff'];

            //if empty, then user was admin making an order for themselves

            $userID = Auth::user()->id;
            $staff_Name = Auth::user()->username;


            if ($total == null) {

                return redirect()->route('order.index')->with('danger', 'Order can not be empty');

            } else {

                $ordered_by_id = Auth::user()->lastname . " " . Auth::user()->firstname;

                $orderDetailsRecord = $this->getOrderDetailsRecord($userID, $ordered_by_id, $food_IDS);

                if ($orderDetailsRecord) {
                    if ($checked == "isForStaff") {

                        return redirect()->route('order.index')->with('success', 'Order on behalf of ' . $staff_Name . ' was successfully recorded');

                    } else {
                        return redirect()->route('order.index')->with('success', 'Order for ' . $staff_Name . ' was successfully recorded');

                    }

                } else {
                    return redirect()->route('order.index')->with('danger', 'Something went wrong');
                }
            }

        }
        else {

            if ($total == null) {

                return redirect()->route('order.index')->with('danger', 'Order can not be empty');

            } else {
                $userID = Auth::user()->id;
                $first = Auth::user()->firstname;
                $lastname = Auth::user()->lastname;
                $madeBy = $first . " " . $lastname;
                $orderDetailsRecord = $this->getOrderDetailsRecord($userID, $madeBy, $food_IDS);


                if ($orderDetailsRecord) {
                    return redirect()->route('order.index')->with('success', 'Your Order was successfully recorded');

                } else {
                    return redirect()->route('order.index')->with('danger', 'Something went wrong');
                }
            }

        }

    }

    /**
     * @param $userID
     * @param string $madeBy
     * @param $food_IDS
     * @return mixed
     */
    public function getOrderDetailsRecord($userID, string $madeBy, $food_IDS)
    {
        $orderRecord = order::create(['user_id' => $userID, 'made_by' => $madeBy]);

        $lastId = $orderRecord->id;
        $lastMadeBy = $orderRecord->made_by;
        $food_ids_string = json_decode($food_IDS, true);

        foreach ($food_ids_string as $value) {

            $orderDetailsRecord = food_order::create(['order_id' => $lastId, 'food_id' => $value, 'order_made_by' => $lastMadeBy]);
        }
        return $orderDetailsRecord;
    }

    public function showMenuItems()
    {
        $menuTable = food::all();

        return view('adminBlades.menuDisplay', ['menuTable' => $menuTable]);
    }

    public function show($id)
    {
        $foodItem = food::find($id);
        return view('adminBlades.editMenu', compact('foodItem'), ["foodItem" => $foodItem]);
    }

    public function edit($id)
    {
        $orderDetails = DB::table('food_order')->join('food', 'food.id', '=', 'food_order.food_id')->join('orders', 'orders.id', '=', 'food_order.order_id')->join('users', 'users.id', '=', 'orders.user_id')->select('food_order.order_id', 'orders.isChanged', 'food.id', DB::raw('SUM(food.price) as total'), DB::raw('DATE_FORMAT(orders.created_at,"%d/%m/%Y") as created_at'), 'users.lastname', 'food.name', 'users.firstname', 'food_order.order_made_by')->groupBy('order_id', 'orders.created_at', 'users.lastname', 'food_order.order_made_by', 'users.firstname', 'food.name')->where('orders.id', '=', $id)->get();
        $foodItems = DB::table('food')->select('*')->get();
//        dd($foodItems);
        return view('new-views.editOrder', compact('orderDetails'), ["orderDetails" => $orderDetails, "foodItems" => $foodItems]);
    }

    public function updateOrder(Request $request, $id)
    {

        $user = Auth::user()->is_admin;

        $changed_by = $request['changed_by'];
        $reason = $request['reason'];
        $food_name = $request['food_name'];
        $f = 0;
        $new_food_id = DB::table('food')->select('id')->where('name', '=', $food_name)->get();
        foreach ($new_food_id as $item) {
            $f = $item->id;
        }

        DB::table("food_order")->where('order_id', '=', $id)->update(['food_id' => $f, 'reason' => $reason, 'changed_by' => $changed_by]);

        DB::table("orders")->where('id', '=', $id)->update(['isChanged' => "YES"]);
        if ($user) {

            return redirect()->route('admin.home')->with('success', 'Order Changed successfully');
        } else {
            return redirect()->route('userhome')->with('success', 'Order Changed successfully');

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {

        $foodItem = food::find($id);
        $foodItem->price = request('price');
        $foodItem->name = request('name');

        $request->validate(['name' => 'required', 'string', 'max:255', 'unique:food', 'price' => 'required', 'numeric',

        ]);

        $foodItem->save();


        $foodItem->update($request->all());

        return redirect()->route('showMenuItems')->with('success', $foodItem->name . ' updated successfully');
    }

    public function changedOrder($id)
    {
//        $changedOrder =  DB::select('select * from changed_orders where order_id=?', [$id]);
        $changedOrder = DB::table('changed_orders')->join('food', 'food.id', '=', 'changed_orders.original_food_id')->join('orders', 'orders.id', '=', 'changed_orders.order_id')->join('users', 'users.id', '=', 'orders.user_id')->select('changed_orders.*', 'food.name', 'users.lastname')->where('changed_orders.order_id', '=', $id)->get();
        $modified = DB::table('food')->select('name')->where('id', '=', $changedOrder[0]->new_food_id)->get();

        return view('new-views.auditChangedOrder', ["changedOrder" => $changedOrder, "modified" => $modified]);
    }

    public function deleteOrder($id)
    {
        $deleteOrder = DB::table('food_order')->join('food', 'food.id', '=', 'food_order.food_id')->join('orders', 'orders.id', '=', 'food_order.order_id')->join('users', 'users.id', '=', 'orders.user_id')->select('food_order.*', 'food.name', 'users.lastname', 'users.firstname')->where('food_order.order_id', '=', $id)->get();
        $modified = DB::table('food')->select('name')->where('id', '=', $deleteOrder[0]->food_id)->get();

        return view('new-views.deleteOrder', ["deleteOrder" => $deleteOrder, "modified" => $modified]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        food::find($id)->delete();

        return redirect()->route('order.index')->with('success', 'Food item deleted successfully');
    }

    public function delete($id)
    {
        $query = DB::table('food_order')->where('order_id', '=', $id)->delete();

        if ($query) {
            return redirect()->route('admin.home')->with('success', 'order deleted successfully');
        } else {
            return redirect()->route('admin.home')->with('danger', "Oops!! It's not you, it's us. Something went wrong. Please Try again");
        }


    }
}
